<?php

class Masir_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function load_masir() {
        $query = $this->db->query("SELECT * FROM flight_detail LEFT JOIN flight ON flight_detail.flight_id = flight.id");
        return $query->result_array();
    }

    public function add_masir($flight_id, $class, $ghimat, $departure_date, $return_date, $capacity) {
        $this->db->query("INSERT INTO flight_detail (flight_id,class,ghimat,departure_date,return_date,capacity) values ('$flight_id','$class','$ghimat','$departure_date','$return_date','$capacity')");
        return $this->db->insert_id();
    }

}
