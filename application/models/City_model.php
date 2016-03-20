<?php

class City_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function load_city() {
        $query = $this->db->query("SELECT * FROM city LEFT JOIN iata ON iata.city_id = city.id");
        return $query->result_array();
    }

}
