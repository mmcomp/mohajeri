<?php

class City_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function load_city() {
        $query = $this->db->query("SELECT * FROM city LEFT JOIN iata ON iata.city_id = city.id");
        return $query->result_array();
    }
    
    public function load_just_city() {
        $query = $this->db->query("SELECT * FROM city order by country_id");
        return $query->result_array();
    }
    
    public function add_city($en_name,$fa_name,$country_id){
        $this->db->query("INSERT INTO city (fa_name,en_name,country_id) values ('$fa_name','$en_name','$country_id')");
        return $this->db->insert_id();
    }
    
}
