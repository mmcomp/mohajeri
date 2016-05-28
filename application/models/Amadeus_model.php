<?php

class Amadeus_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function sendRequest($request_id, $from_city, $to_city, $date , $airline ,$rdate,$s_tarikh) {
        $rs_tarikh = date("Y-m-d",  strtotime($s_tarikh));
        $sid = -1;
//        $q = $this->db->query("SELECT id,TIME_TO_SEC(TIMEDIFF(NOW(),last_update))/60 tdif FROM source_update where from_city = '$from_city' and to_city = '$to_city' and date(tarikh) = '$date' and date(s_tarikh) = '$rs_tarikh'");
//        $result = $q->result_array();
//        if (count($result) > 0) {
//            $sid = $result[0]['id'];
//            $q = $this->db->query("SELECT id from RB_Request where request = 'A[{\"ID\":\"$sid\"}]' order by id desc limit 1");
//            $result = $q->result_array();
//            $id = $result[0]['id'];
//        }
//        if (count($result) > 0 && $result[0]['tdif'] > 0) {
//            $this->db->query("delete from am_flight_a where Rd_Id = $sid");
//            $this->db->query("UPDATE source_update set stat = 2 , last_update = NOW() where id = $sid" );
//            $this->db->query("INSERT INTO RB_Request (request,source_id,stat,Type) values ('A[{\"ID\":\"$sid\"}]',99,0,2)");
//            $id = $this->db->insert_id();
//        } else if (count($result) == 0) {
//            $this->db->query("INSERT INTO source_update (from_city,to_city,tarikh,last_update,stat,source_id,airline_iata,s_tarikh) values ('$from_city','$to_city','$rdate',NOW(),2,99,'$airline','$s_tarikh')");
//            $sid = $this->db->insert_id();
//            $this->db->query("INSERT INTO RB_Request (request,source_id,stat,Type) values ('A[{\"ID\":\"$sid\"}]',99,0,2)");
//            $id = $this->db->insert_id();
//        }
        
        $this->db->query("INSERT INTO source_update (from_city,to_city,tarikh,last_update,stat,source_id,airline_iata,s_tarikh) values ('$from_city','$to_city','$rdate',NOW(),2,99,'$airline','$s_tarikh')");
        $sid = $this->db->insert_id();
        $this->db->query("INSERT INTO RB_Request (request,source_id,stat,Type) values ('A[{\"ID\":\"$sid\"}]',99,0,2)");
        $id = $this->db->insert_id();
        
        return(array("id"=>$id,"sid"=>$sid));
    }
    
    public function get_amadeus_flight($amadeus_from_city, $amadeus_to_city, $amadeus_departure_date, $amadeus_return_date, $amadeus_airline_iata,$amadeus_departure_rdate, $amadeus_return_rdate) {
        $R_ids = array(NULL);
//        $R_ids = NULL;
        if (count($amadeus_airline_iata) > 0) {
            $R_ids[0]=$this->sendRequest(NULL, $amadeus_from_city, $amadeus_to_city, $amadeus_departure_date, implode(',', $amadeus_airline_iata),$amadeus_departure_rdate,$amadeus_return_rdate);
//            $R_ids[1]=$this->sendRequest(NULL, $amadeus_to_city, $amadeus_from_city, $amadeus_return_date, implode(',', $amadeus_airline_iata),$amadeus_return_rdate);
        }
        return $R_ids;
    }
    
    public function insert_reserve($liaison_adult, $liaison_child, $liaison_infant, $flight_key, $refrence_id) {
        $this->db->query("INSERT INTO reserve_tmp (tflight,adl,chd,inf,refrence_id,source_id,state) VALUES ('$flight_key', '$liaison_adult', '$liaison_child', '$liaison_infant',$refrence_id,99,1)");
        return $this->db->insert_id();
    }

}
