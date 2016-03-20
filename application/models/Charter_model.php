<?php

class Charter_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_charter_domestic_oneway($charter_from_city, $charter_to_city, $charter_departure_date, $pcount) {
        $query = $this->db->query("SELECT * FROM flight LEFT JOIN flight_detail ON flight_detail.flight_id = flight.id WHERE from_city_iata = '$charter_from_city' AND to_city_iata = '$charter_to_city' AND departure_date = '$charter_departure_date' AND capacity >= '$pcount'");
        return $query->result_array();
    }

    public function get_charter_domestic_roundtrip($charter_from_city, $charter_to_city, $charter_departure_date, $charter_return_date, $pcount) {
        $query = $this->db->query("SELECT * FROM flight LEFT join flight_detail ON flight_detail.flight_id = flight.id WHERE (from_city_iata = '$charter_from_city' AND to_city_iata = '$charter_to_city' AND departure_date = '$charter_departure_date' AND capacity >= '$pcount') OR (from_city_iata = '$charter_to_city' AND to_city_iata = '$charter_from_city' AND departure_date = '$charter_return_date' AND capacity >= '$pcount')");
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
        $query = $this->db->query("SELECT * FROM flight LEFT join flight_detail ON flight_detail.flight_id = flight.id WHERE flight.id = '$flight_key'");
        return $query->result_array();
    }

}
