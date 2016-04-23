<?php

class Amadeus_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function sendRequest($request_id, $from_city, $to_city, $date , $airline ,$rdate) {
        $sid = -1;
        $q = $this->db->query("SELECT id,TIME_TO_SEC(TIMEDIFF(NOW(),last_update))/60 tdif FROM source_update where from_city = '$from_city' and to_city = '$to_city' and date(tarikh) = '$date'");
        $result = $q->result_array();
        if (count($result) > 0) {
            $sid = $result[0]['id'];
            $q = $this->db->query("SELECT id from RB_Request where request = 'A[{\"ID\":\"$sid\"}]' order by id desc limit 1");
            $result = $q->result_array();
            $id = $result[0]['id'];
        }
        if (count($result) > 0 && $result[0]['tdif'] > 5) {
            $this->db->query("delete from am_flight_a where Rd_Id = $sid");
            $this->db->query("UPDATE source_update set stat = 2 , last_update = NOW() where id = $sid" );
            $this->db->query("INSERT INTO RB_Request (request,source_id,stat,Type) values ('A[{\"ID\":\"$sid\"}]',99,0,2)");
            $id = $this->db->insert_id();
        } else if (count($result) == 0) {
//            $this->db->query("delete from flight1 where from_city = '$from_city' and to_city = '$to_city' and date(fdate) = '$date'");
            $this->db->query("INSERT INTO source_update (from_city,to_city,tarikh,last_update,stat,source_id,airline_iata) values ('$from_city','$to_city','$rdate',NOW(),2,99,'$airline')");
            $sid = $this->db->insert_id();
            $this->db->query("INSERT INTO RB_Request (request,source_id,stat,Type) values ('A[{\"ID\":\"$sid\"}]',99,0,2)");
            $id = $this->db->insert_id();
        }
        return(array("id"=>$id,"sid"=>$sid));
    }
    
    public function get_amadeus_flight($amadeus_from_city, $amadeus_to_city, $amadeus_departure_date, $amadeus_return_date, $amadeus_airline_iata,$amadeus_departure_rdate, $amadeus_return_rdate) {
        $R_ids = array(NULL, NULL);
//        $tmp_r_id = strtotime(date("Y-m-d H:i:s"));
        if (count($amadeus_airline_iata) > 0) {
            
            $R_ids[0]=$this->sendRequest(NULL, $amadeus_from_city, $amadeus_to_city, $amadeus_departure_date, implode(',', $amadeus_airline_iata),$amadeus_departure_rdate);
            
            $R_ids[1]=$this->sendRequest(NULL, $amadeus_to_city, $amadeus_from_city, $amadeus_return_date, implode(',', $amadeus_airline_iata),$amadeus_return_rdate);
            
//            $R_ids[0] = $tmp_r_id;
//            $tmp_r_id = strtotime(date("Y-m-d H:i:s"));
//            $this->db->query("INSERT INTO `RB_AD_Request` (`R_id`, `Fr`, `To`, `RTime`, `C_Time`,`airline_iata`) VALUES ('" . $R_ids[0] . "','$amadeus_from_city','$amadeus_to_city','$amadeus_departure_date','" . date("Y-m-d H:i:s") . "','" . implode(',', $amadeus_airline_iata) . "')");
//            $R_ids[1] = $tmp_r_id + 1;
//            $tmp_r_id = strtotime(date("Y-m-d H:i:s"));
//            $this->db->query("INSERT INTO `RB_AD_Request` (`R_id`, `Fr`, `To`, `RTime`, `C_Time`,`airline_iata`) VALUES ('" . $R_ids[1] . "','$amadeus_to_city','$amadeus_from_city','$amadeus_return_date','" . date("Y-m-d H:i:s") . "','" . implode(',', $amadeus_airline_iata) . "')");
        }


//        $qurey = $this->db->query("SELECT `R_id` FROM `RB_AD_Request` WHERE `Fr` = '$amadeus_from_city' AND `To` = '$amadeus_to_city' AND `RTime` = '$amadeus_departure_date' AND TIMESTAMPDIFF(MINUTE,`C_Time`,'" . date("Y-m-d H:i:s") . "') <= 10");
//        $direct = $qurey->result_array();
//        $tmp_r_id = strtotime(date("Y-m-d H:i:s"));
//        if (count($direct) == 0) {
//            $R_ids[0] = $tmp_r_id;
//            $this->db->query("INSERT INTO `RB_AD_Request` (`R_id`, `Fr`, `To`, `RTime`, `C_Time`) VALUES ('".$R_ids[0]."','$amadeus_from_city','$amadeus_to_city','$amadeus_departure_date','".date("Y-m-d H:i:s")."')");
//        } else {
//            $R_ids[0] = $direct[0]['R_id'];
//        }
//        $qurey = $this->db->query("SELECT `R_id` FROM `RB_AD_Request` WHERE `Fr` = '$amadeus_to_city' AND `To` = '$amadeus_from_city' AND `RTime` = '$amadeus_return_date' AND TIMESTAMPDIFF(MINUTE,`C_Time`,'" . date("Y-m-d H:i:s") . "') <= 10");
//        $retuen = $qurey->result_array();
//        if (count($retuen) == 0) {
//            $R_ids[1] = $tmp_r_id+1;
//            $this->db->query("INSERT INTO `RB_AD_Request` (`R_id`, `Fr`, `To`, `RTime`, `C_Time`) VALUES ('".$R_ids[1]."','$amadeus_to_city','$amadeus_from_city','$amadeus_return_date','".date("Y-m-d H:i:s")."')");
//        } else {
//            $R_ids[1] = $retuen[0]['R_id'];
//        }
        return $R_ids;
    }
    public function insert_reserve($liaison_adult, $liaison_child, $liaison_infant, $flight_key, $refrence_id) {
        $this->db->query("INSERT INTO reserve_tmp (tflight,adl,chd,inf,refrence_id,source_id,state) VALUES ('$flight_key', '$liaison_adult', '$liaison_child', '$liaison_infant',$refrence_id,99,1)");
        return $this->db->insert_id();
    }

}
