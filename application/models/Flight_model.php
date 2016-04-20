<?php

class Flight_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_flight($flight_id, $flight_type) {
        $out = array();
        if ($flight_type == 1) {
            // Liaison
            $query = $this->db->query("select from_city,to_city,price,fdate,ftime,ltime,class_ghimat,flight_number,airline from flight1 left join flight_extra on (flight1.tflight=flight_extra.tflight) where flight1.tflight = '$flight_id'");
            $out = $query->result_array();
        }
        return $out;
    }

    function get_flight_refrence($refrence_id) {
        $query = $this->db->query("select tflight,id,voucher_id from reserve_tmp where refrence_id = $refrence_id");
        $result = $query->result_array();
        $out = array("flight_info" => array(), "reserve_tmp" => array());
        foreach ($result as $tmp) {
            $out["flight_info"][] = $this->get_flight($tmp['tflight'], 1);
            $out['reserve_tmp'][] = $tmp['id'];
            $out['voucher_id'][] = $tmp['voucher_id'];
        }
        return $out;
    }

    function get_tickets($refrence_id) {
        $out = array();
        $query = $this->db->query("select id from reserve_tmp where refrence_id = $refrence_id");
        $result = $query->result_array();
        if (count($result) > 0) {
            $reserve_tmp_id = $result[0]['id'];
            $query = $this->db->query("select * from ticket where reserve_tmp_id = $reserve_tmp_id");
            $result = $query->result_array();
//            var_dump($result);
            $out = $result;
        }
        return $out;
    }

    function add_ticket($refrence_id, $fname, $lname, $fname_en, $lname_en, $nationality, $shomare_melli, $birthdate, $passport, $passport_expire, $passport_origin, $gender, $age, $mobile, $email) {
        $refrence_id = (int) $refrence_id;
        $query = $this->db->query("select id from reserve_tmp where refrence_id = $refrence_id");
        $result = $query->result_array();
        foreach ($result as $res) {
            $reserve_tmp = $res['id'];
            $gender = (int) $gender;
            $this->db->query("insert into ticket (`refrence_id`, `reserve_tmp_id`, `fname`, `lname`, `fname_en`, `lname_en`, `age`, `birthday`, `gender`, `shomare_melli`, `shomare_passport`, `passport_engheza`, `passport_issue_country`, `nationality`, `mobile`, `email`) values ($refrence_id, $reserve_tmp, '$fname', '$lname', '$fname_en', '$lname_en', '$age', '$birthdate', $gender, '$shomare_melli', '$passport', '$passport_expire', '$passport_origin', '$nationality', '$mobile', '$email')");
        }
    }

    function confirm_reserve($refrence_id) {
        $query = $this->db->query("select reserve_tmp.id,flight_number,from_city,to_city,adl+chd pcount,fdate,airline from reserve_tmp left join flight1 on (flight1.tflight=reserve_tmp.tflight) left join flight_extra on (flight1.tflight=flight_extra.tflight) where refrence_id = $refrence_id");
        $result = $query->result_array();
        foreach ($result as $res) {
            $reserve_tmp = $res['id'];
            $req = 'C[{"Id":"' . $reserve_tmp . '", "FlightNo":"' . $res['flight_number'] . '", "From_City":"' . $res['from_city'] . '", "To_City":"' . $res['to_city'] . '", "PCount":"' . $res['pcount'] . '", "Date":"' . date("dM", strtotime($res['fdate'])) . '", "Airline":"' . $res['airline'] . '", "S1":"2", "S2":"4"}]';
            //Test is 5 change into to 0 for real
            $this->db->query("insert into RB_Request (`request`, `source_id`, `stat`) values ('$req',1,0)");
        }
    }

    function confirm_result($refrence_id) {
        $out = array("stat" => array(), "data" => NULL);
        $query = $this->db->query("select Reserve_Id reserve_tmp_id,Result result,Respons_Value response_value from RB_QueueReserve_TBL where Reserve_Id in (select id from reserve_tmp where refrence_id = '$refrence_id')");
        $result = $query->result_array();
        $data = NULL;
        $result_ok = TRUE;
        foreach ($result as $res) {
            if ($res['result'] == 0) {
                $result_ok = FALSE;
            }
            $out["stat"][] = $res;
        }
        if ($result_ok) {
            $data = $this->get_flight_refrence($refrence_id);
            $data['tickets'] = $this->get_tickets($refrence_id);
        }
        $out['data'] = $data;
        return $out;
    }

    function reserve_total($refrence_id) {
        $out = array(
            "error" => 1,
            "total" => 0
        );
        $query = $this->db->query("select total from payment where refrence_id = $refrence_id");
        $result = $query->result_array();
        if (count($result) == 1) {
            $out["error"] = 0;
            $out["total"] = $result[0]['total'];
        }
        return $out;
    }

    public function liaison_payment($refrence_id, $total_price) {
        $query = $this->db->query("SELECT refrence_id FROM payment WHERE refrence_id = '$refrence_id'");
        $check_refrence_id = $query->result_array();
        if (empty($check_refrence_id)) {
            $this->db->query("INSERT INTO payment (refrence_id, total) VALUES ('$refrence_id', '$total_price')");
        } else {
            return TRUE;
        }
    }

}
