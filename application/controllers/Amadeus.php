<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Amadeus extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('amadeus_model');
    }
    public function search_amadeus_flight() {
        $amadeus_from_city = $this->input->get('amadeus-from-city');
        $amadeus_to_city = $this->input->get('amadeus-to-city');
        $amadeus_departure_date = date("dM",  strtotime($this->input->get('amadeus-departure-date')));
        $amadeus_return_date = date("dM",  strtotime($this->input->get('amadeus-return-date')));
        $amadeus_adult = $this->input->get('amadeus-adult');
        $amadeus_child = $this->input->get('amadeus-child');
        $amadeus_infant = $this->input->get('amadeus-infant');
        $amadeus_airline_iata = $this->input->get('amadeus-airline-iata');
        $data['out'] = $this->amadeus_model->get_amadeus_flight($amadeus_from_city, $amadeus_to_city, $amadeus_departure_date, $amadeus_return_date, $amadeus_airline_iata);
        $this->load->view('ajax_result', $data);
    }
    public function check_amadeus_result(){
        $out = array(
            "result_ok" => FALSE,
            "result" => array()
        );
        $rd_ids = $_REQUEST['ids'];
        if (is_array($rd_ids)) {
//            echo "SELECT stat FROM RB_AD_Request WHERE R_id IN (" . implode(',', $rd_ids) . ") ";
            $query = $this->db->query("SELECT stat FROM RB_AD_Request WHERE R_id IN (" . implode(',', $rd_ids) . ") ");
            $id_result = $query->result_array();
            $result_ok = TRUE;
            foreach ($id_result as $row) {
                if ($row['stat'] != 1) {
                    $result_ok = FALSE;
                }
            }
            $out['result_ok'] = $result_ok;
            if ($result_ok) {
                //--------------TEST--------------------
//                $id = array('63');
                //--------------------------------------
                $query = $this->db->query("SELECT * FROM am_flight_a  WHERE   Rd_Id IN (" . implode(',', $rd_ids) . ") order by Rd_Id");
                $out['result'] = $query->result_array();
            }
        }
        $data['out'] = $out;
        $this->load->view('ajax_result', $data);
    }
    
    public function show_amadeus_flight() {
//        $amadeus_from_city = $this->input->get('amadeus-from-city');
//        $amadeus_to_city = $this->input->get('amadeus-to-city');
//        $amadeus_departure_date = $this->input->get('amadeus-departure-date');
//        $amadeus_return_date = $this->input->get('amadeus-return-date');
//        $amadeus_adult = $this->input->get('amadeus-adult');
//        $amadeus_child = $this->input->get('amadeus-child');
//        $amadeus_infant = $this->input->get('amadeus-infant');
//
//        $data['out'] = $this->amadeus_model->get_amadeus_flight($amadeus_from_city, $amadeus_to_city);
//        $this->load->view('ajax_result', $data);
    }

}
