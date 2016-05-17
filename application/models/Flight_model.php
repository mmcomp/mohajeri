<?php

class Flight_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_flight($flight_id, $flight_type) {
        $out = array();
        if ($flight_type == 1) {
            // Liaison
            $takhfif = $this->tax_model->getTakhfifLiaison();
            $query = $this->db->query("select from_city,to_city,FLOOR((price - get_tax(class_ghimat,airline))*$takhfif + get_tax(class_ghimat,airline)) price,fdate,ftime,ltime,class_ghimat,flight_number,airline from flight1 left join flight_extra on (flight1.tflight=flight_extra.tflight) where flight1.tflight = '$flight_id'");
            $out = $query->result_array();
        } else if ($flight_type == 2) {
            // Amadeus
            $takhfif = $this->tax_model->getTakhfifAmadeus();
            $query = $this->db->query("select from_city_iata from_city,to_city_iata to_city,FLOOR((ghimat)*$takhfif) price,fdate,departure_time ftime,landing_time ltime,class class_ghimat,flight_number,am_flight_a.airline_iata airline from am_flight_a left join class_ghimat1 on (class_ghimat1.from_city=from_city_iata and class_ghimat1.to_city = to_city_iata and  class_ghimat1.airline_iata = am_flight_a.airline_iata and am_flight_a.class like concat(class_ghimat1.name,'%')) where am_flight_a.id = $flight_id order by class_ghimat1.id desc limit 1");
            $out = $query->result_array();
        } else if ($flight_type == 3) {
            // Charter
            $query = $this->db->query("SELECT `ghimat` `price`,`flight_number`,`airplane_id`,`airline_iata`,`from_city_iata` `from_city`,`to_city_iata` `to_city`,`flight_detail`.`id`,`class` `class_ghimat`,`ghimat`,`departure_date` `fdate`,`return_date`,`capacity` FROM flight LEFT JOIN flight_detail ON flight_detail.flight_id = flight.id WHERE `flight_detail`.`id` = $flight_id");
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
        $this->db->query("update tmp_reserve set last_modified = '".date("Y-m-d H:i:s")."',summery_minutes=20 where refrence_id = $refrence_id");
        $query = $this->db->query("select id from reserve_tmp where refrence_id = $refrence_id");
        $result = $query->result_array();
        foreach ($result as $res) {
            $reserve_tmp = $res['id'];
            $gender = (int) $gender;
            $this->db->query("insert into ticket (`refrence_id`, `reserve_tmp_id`, `fname`, `lname`, `fname_en`, `lname_en`, `age`, `birthday`, `gender`, `shomare_melli`, `shomare_passport`, `passport_engheza`, `passport_issue_country`, `nationality`, `mobile`, `email`) values ($refrence_id, $reserve_tmp, '$fname', '$lname', '$fname_en', '$lname_en', '$age', '$birthdate', $gender, '$shomare_melli', '$passport', '$passport_expire', '$passport_origin', '$nationality', '$mobile', '$email')");
        }
    }

    function confirm_reserve($refrence_id) {
        $query = $this->db->query("select `type` from reserve_tmp where refrence_id = $refrence_id");
        $result = $query->result_array();
        if ($result[0]['type'] == 2) {
            $query = $this->db->query("select reserve_tmp.id,flight_number,from_city_iata from_city,to_city_iata to_city,adl+chd pcount,fdate,aiarline_iata airline from reserve_tmp left join am_flight_a on (am_flight_a.id=reserve_tmp.tflight)  where refrence_id = $refrence_id");
            $result = $query->result_array();
            foreach ($result as $res) {
                $reserve_tmp = $res['id'];
                $req = 'C[{"Id":"' . $reserve_tmp . '", "FlightNo":"' . $res['flight_number'] . '", "From_City":"' . $res['from_city'] . '", "To_City":"' . $res['to_city'] . '", "PCount":"' . $res['pcount'] . '", "Date":"' . date("dM", strtotime($res['fdate'])) . '", "Airline":"' . $res['airline'] . '", "S1":"2", "S2":"4"}]';
                //Test is 5 change into to 0 for real
                $this->db->query("insert into RB_Request (`request`, `source_id`, `stat`) values ('$req',1,0)");
            }
        } elseif ($result[0]['type'] == 1) {
            $query = $this->db->query("select reserve_tmp.id,flight_number,from_city,to_city,adl+chd pcount,fdate,airline from reserve_tmp left join flight1 on (flight1.tflight=reserve_tmp.tflight) left join flight_extra on (flight1.tflight=flight_extra.tflight) where refrence_id = $refrence_id");
            $result = $query->result_array();
            $reserve_tmp = array();
            $flightNo = array();
            $from_city = array();
            $to_city = array();
            $date = array();
            $airline = array();
            foreach ($result as $res) {
                $reserve_tmp[] = $res['id'];
                $flightNo[] = $res['flight_number'];
                $from_city[] = $res['from_city'];
                $to_city[] = $res['to_city'];
                $date[] = date("dM", strtotime($res['fdate']));
                $airline[] = $res['airline'];
            }
            $req = 'C[{"Id":"' . implode(',',$reserve_tmp) . '", "FlightNo":"' . implode(',',$flightNo) . '", "From_City":"' . implode(',',$from_city) . '", "To_City":"' . implode(',',$to_city) . '", "PCount":"' . $res['pcount'] . '", "Date":"' . implode(',',$date) . '", "Airline":"' . implode(',',$airline) . '", "S1":"2", "S2":"4"}]';
            $this->db->query("insert into RB_Request (`request`, `source_id`, `stat`) values ('$req',5,0)");
        } elseif ($result[0]['type'] == 3) {
            $query = $this->db->query("select reserve_tmp.id,flight_number,from_city,to_city,adl+chd pcount,fdate,airline from reserve_tmp left join flight1 on (flight1.tflight=reserve_tmp.tflight) left join flight_extra on (flight1.tflight=flight_extra.tflight) where refrence_id = $refrence_id");
            $result = $query->result_array();
            foreach ($result as $res) {
                $reserve_tmp = $res['id'];
                //Confirm Charter
            }
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

    public function payment($refrence_id, $total_price) {
        $query = $this->db->query("SELECT refrence_id FROM payment WHERE refrence_id = '$refrence_id'");
        $check_refrence_id = $query->result_array();
        if (empty($check_refrence_id)) {
            $this->db->query("INSERT INTO payment (refrence_id, total) VALUES ('$refrence_id', '$total_price')");
        } else {
            return TRUE;
        }
    }

}
