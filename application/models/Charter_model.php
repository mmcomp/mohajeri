<?php

class Charter_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_charter_oneway($charter_from_city, $charter_to_city, $charter_departure_date, $pcount) {
        $query = $this->db->query("SELECT `flight_number`,`airplane_id`,`airline_iata`,`from_city_iata`,`to_city_iata`,`flight_detail`.`id`,`class`,`ghimat`,`departure_date`,`return_date`,`departure_time`,`return_time`,`capacity` FROM flight LEFT JOIN flight_detail ON flight_detail.flight_id = flight.id WHERE from_city_iata = '$charter_from_city' AND to_city_iata = '$charter_to_city' AND departure_date = '$charter_departure_date' AND capacity >= '$pcount'");
        return $query->result_array();
    }

    public function get_charter_roundtrip($charter_from_city, $charter_to_city, $charter_departure_date, $charter_return_date, $pcount) {
        $query = $this->db->query("SELECT `flight_number`,`airplane_id`,`airline_iata`,`from_city_iata`,`to_city_iata`,`flight_detail`.`id`,`class`,`ghimat`,`departure_date`,`return_date`,`departure_time`,`return_time`,`capacity` FROM flight LEFT join flight_detail ON flight_detail.flight_id = flight.id WHERE (from_city_iata = '$charter_from_city' AND to_city_iata = '$charter_to_city' AND departure_date = '$charter_departure_date' AND capacity >= '$pcount') OR (from_city_iata = '$charter_to_city' AND to_city_iata = '$charter_from_city' AND departure_date = '$charter_return_date' AND capacity >= '$pcount')");
        $result = $query->result_array();
        $out = array();
        foreach ($result as $row) {
            if ($row['from_city_iata'] == $charter_from_city) {
                $out['departure_flight'][] = $row;
            } elseif ($row['from_city_iata'] == $charter_to_city) {
                $out['return_flight'][] = $row;
            }
        }
        return $out;
    }
    
    public function get_charter_flight($flight_key) {
        $query = $this->db->query("SELECT * FROM flight LEFT join flight_detail ON (flight_detail.flight_id = flight.id) WHERE flight_detail.id = '$flight_key'");
        return $query->result_array();
    }

    public function insert_reserve($adl,$chd,$inf,$flight_detail_id,$refrence_id){
        $user_id = -1;
        $summery = 5;
        $count = $adl+$chd+$inf;
        if($count>1)
        {
            $summery += ($count-1)*3;
        }
        $this->db->query("insert into `tmp_reserve` (`flight_detail_id`, `adl`, `chd`, `inf`, `fase`, `last_modified`, `summery_minutes`, `start_date`, `refrence_id`, `user_id`) values ($flight_detail_id,$adl,$chd,$inf,1,'".date("Y-m-d H:i:s")."',$summery,'".date("Y-m-d H:i:s")."',$refrence_id,$user_id)");
        $this->db->query("INSERT INTO reserve_tmp (tflight,adl,chd,inf,refrence_id,source_id,state) VALUES ('$flight_detail_id',$adl,$chd,$inf,$refrence_id,1,1)");
        return $this->db->insert_id();
    }
    
    function getFase($refrence_id){
        $fase = -1;
        $query = $this->db->query("SELECT fase from `tmp_reserve` where `refrence_id` = $refrence_id and `en` = 1");
        $result = $query->result_array();
        if(count($result)==1)
        {
            $fase = (int)$result[0]['fase'];
        }
        return $fase;
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
}
