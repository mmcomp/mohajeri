<?php

class Country_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function load_country() {
        $query = $this->db->query("SELECT * FROM country");
        return $query->result_array();
    }

    public function add_country($en_name, $fa_name) {
        $this->db->query("INSERT INTO country (fa_name,en_name) values ('$fa_name','$en_name')");
        return $this->db->insert_id();
    }

}
