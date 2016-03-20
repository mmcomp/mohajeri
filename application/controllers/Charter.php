<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Charter extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('charter_model');
    }

    public function show_charter_flight() {
        $charter_flight_type = $this->input->get('charter-flight-type');
        $charter_from_city = $this->input->get('charter-from-city');
        $charter_to_city = $this->input->get('charter-to-city');
        $charter_departure_date = $this->input->get('charter-departure-date');
        $charter_return_date = $this->input->get('charter-return-date');
        $charter_adult = $this->input->get('charter-adult');
        $charter_child = $this->input->get('charter-child');
        $charter_infant = $this->input->get('charter-infant');
        $pcount = $charter_adult + $charter_child + $charter_infant;
        if ($charter_flight_type == 0) {
            $data['out'] = $this->charter_model->get_charter_domestic_oneway($charter_from_city, $charter_to_city, $charter_departure_date, $pcount);
            $this->load->view('ajax_result', $data);
        } elseif ($charter_flight_type == 1) {
            $data['out'] = $this->charter_model->get_charter_domestic_roundtrip($charter_from_city, $charter_to_city, $charter_departure_date, $charter_return_date, $pcount);
            $this->load->view('ajax_result', $data);
        }
    }

    public function charter_reserve() {
        $flight_key = $this->input->post('flight-key');
        $data['charter_adult'] = $this->input->post('charter-adult');
        $data['charter_child'] = $this->input->post('charter-child');
        $data['charter_infant'] = $this->input->post('charter-infant');
        $data['flight_cat'] = $this->input->post['flight-cat'];
        $data['flight_info'] = $this->charter_model->get_charter_flight($flight_key);
        $this->load->view('reserve', $data);
    }

}
