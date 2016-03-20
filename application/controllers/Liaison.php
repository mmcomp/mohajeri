<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Liaison extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('liaison_model');
//        $this->load->library('Curl');
        $this->load->library('Jdf');
    }

    public function show_liaison_flight() {
        $flight_type = $_REQUEST['liaison-flight-type'];
        $from_city = $_REQUEST['liaison-from-city'];
        $to_city = $_REQUEST['liaison-to-city'];
        $adult_count = (int) $_REQUEST['liaison-adult'];
        $child_count = (int) $_REQUEST['liaison-child'];
        $infant_count = (int) $_REQUEST['liaison-infant'];
        $pcount = $adult_count + $child_count;
        if ((int) $flight_type == 0) {
            $departure_date = $this->set_date($_REQUEST['liaison-direct-date']);

            $arriaval_date = '';
        } else {
            $departure_date = $this->set_date($_REQUEST['liaison-departure-date']);
            $arriaval_date = $this->set_date($_REQUEST['liaison-arrival-date']);
        }
        $data['out'] = $this->liaison_model->get_liaison_flight($from_city, $to_city, $departure_date, $arriaval_date, $pcount);
        $this->load->view('ajax_result', $data);
    }

    public function show_liaison_result() {
        $out = array(
            "result_ok" => FALSE,
            "result" => array()
        );
        $id = $_REQUEST['ids'];
        if (is_array($id)) {
            $from_city = array();
            $to_city = array();
            $fdate = array();
            $query = $this->db->query("SELECT * FROM source_update WHERE Id IN (" . implode(',', $id) . ") ");
            $id_result = $query->result_array();
            $result_ok = TRUE;
            foreach ($id_result as $row) {
                $from_city[] = $row['from_city'];
                $to_city[] = $row['to_city'];
                $fdate[] = $row['tarikh'];
                if ($row['stat'] == 2) {
                    $result_ok = FALSE;
                }
            }
            $out['result_ok'] = $result_ok;
            if ($result_ok) {
                foreach ($from_city as $i => $from) {
                    $query = $this->db->query("select flight1.tflight id, from_city from_city_iata,to_city to_city_iata,airline airline_iata,flight_number,fdate departure_time,ltime landing_time,class_ghimat class,capacity,price from flight1 left join flight_extra on (flight1.tflight=flight_extra.tflight) where capacity!= 0 and flight1.source_id = 1 and from_city = '$from' and to_city = '" . $to_city[$i] . "' and date(fdate) = '" . date("Y-m-d", strtotime($fdate[$i])) . "'");
                    $tmp = $query->result_array();
                    foreach ($tmp as $t) {
                        $out['result'][] = $t;
                    }
                }
            }
        }
        $data['out'] = $out;
        $this->load->view('ajax_result', $data);
    }

    public function set_date($pdate) {
        $tmp = explode('/', $pdate);
        $gregorian_date = $this->jdf->jalali_to_jgregorian($tmp[0], $tmp[1], $tmp[2]);
        $gregorian_date = implode('/', $gregorian_date);
        return $gregorian_date;
    }

}
