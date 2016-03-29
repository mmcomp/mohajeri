<?php

class Liaison_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_liaison_flight($from_city, $to_city, $departuer_date, $arrival_date, $pcount) {
        $from_city = trim($from_city);
        $to_city = trim($to_city);
        $out = array(-1);
        $request_id = strtotime(date("Y-m-d H:i:s"));
        $departuer_date = date("Y-m-d", strtotime($departuer_date));
        $one_way = ($arrival_date == '');
        if (!$one_way) {
            $arrival_date = date("Y-m-d", strtotime($arrival_date));
        }
        $out[0] = $this->sendRequest($request_id, $from_city, $to_city, $departuer_date, $pcount);
        if (!$one_way) {
            $request_id = strtotime(date("Y-m-d H:i:s"));
            $out[] = $this->sendRequest($request_id, $to_city, $from_city, $arrival_date, $pcount);
        }
        return($out);
    }

    public function sendRequest($request_id, $from_city, $to_city, $date, $pcount, $airline = 'IR') {
        $id = -1;
        $q = $this->db->query("SELECT id,TIME_TO_SEC(TIMEDIFF(last_update,NOW()))/60 tdif FROM source_update where from_city = '$from_city' and to_city = '$to_city' and date(tarikh) = '$date'");
        $result = $q->result_array();
        if (count($result) > 0) {
            $id = $result[0]['id'];
        }
        if (count($result) > 0 ){//&& $result[0]['tdif'] > 5) {
            $this->db->query("delete from flight1 where from_city = '$from_city' and to_city = '$to_city' and date(fdate) = '$date'");
            $this->db->query("UPDATE source_update set stat = 2 , last_update = NOW() where id = " . $result[0]['id']);
            $this->db->query("INSERT INTO RB_Request (request,source_id,stat) values ('A[{\"ID\":\"$id\"}]',1,0)");
        } else {//if (count($result) == 0) {
            $this->db->query("delete from flight1 where from_city = '$from_city' and to_city = '$to_city' and date(fdate) = '$date'");
            $this->db->query("INSERT INTO source_update (from_city,to_city,tarikh,last_update,stat,source_id) values ('$from_city','$to_city','$date',NOW(),2,1)");
            $id = $this->db->insert_id();
            $this->db->query("INSERT INTO RB_Request (request,source_id,stat) values ('A[{\"ID\":\"$id\"}]',1,0)");
        }
        return($id);
    }

    public function insert_reserve($liaison_adult, $liaison_child, $liaison_infant, $flight_key, $refrence_id) {
        $this->db->query("INSERT INTO reserve_tmp (tflight,adl,chd,inf,refrence_id,source_id) VALUES ('$flight_key', '$liaison_adult', '$liaison_child', '$liaison_infant',$refrence_id,1)");
        return $this->db->insert_id();
    }

}
