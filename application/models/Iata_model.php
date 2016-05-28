<?php

class Iata_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function load_iata() {
        $query = $this->db->query("SELECT * FROM iata LEFT JOIN city ON iata.city_id = city.id");
        return $query->result_array();
    }
    
    public function add_iata($city_id,$airport_name,$iata){
        $this->db->query("INSERT INTO iata (city_id,airport_name,iata) values ('$city_id','$airport_name','$iata')");
        return $this->db->insert_id();
    }
    
}
