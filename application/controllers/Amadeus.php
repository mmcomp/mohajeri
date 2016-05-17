<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Amadeus extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('amadeus_model');
        $this->load->model('tax_model');
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
        $data['out'] = $this->amadeus_model->get_amadeus_flight($amadeus_from_city, $amadeus_to_city, $amadeus_departure_date, $amadeus_return_date, $amadeus_airline_iata,$this->input->get('amadeus-departure-date'),$this->input->get('amadeus-return-date'));
        $this->load->view('ajax_result', $data);
    }
    public function check_amadeus_result(){
        $out = array(
            "result_ok" => FALSE,
            "result" => array()
        );
        $g = $_REQUEST['ids'];
        $rd_ids = array($g[0]["id"],$g[1]["id"]);
        $s_ids = array($g[0]["sid"],$g[1]["sid"]);
        if (is_array($rd_ids)) {
            $query = $this->db->query("SELECT stat FROM RB_Request WHERE id IN (" . implode(',', $rd_ids) . ") ");
            $id_result = $query->result_array();
            $result_ok = TRUE;
            foreach ($id_result as $row) {
                if ($row['stat'] == 0 || $row['stat'] == 3) {
                    $result_ok = FALSE;
                }
            }
            $out['result_ok'] = $result_ok;
            if ($result_ok) {
                $takhfif = $this->tax_model->getTakhfifAmadeus();
//                echo "SELECT `flight_number`, `airplane_id`, `fdate`, `departure_time`, `landing_time`, `am_flight_a`.`airline_iata`, `from_city_iata`, `to_city_iata`, `class`, `stop_id`, `Rd_Id`,FLOOR((ghimat)*$takhfif) `ghimat`,`ghimat` `unchanged_ghimat` FROM am_flight_a left join class_ghimat1 on (class_ghimat1.from_city=from_city_iata and class_ghimat1.to_city = to_city_iata and  class_ghimat1.airline_iata = am_flight_a.airline_iata and am_flight_a.class like concat(class_ghimat1.name,'%'))  WHERE   Rd_Id IN (" . implode(',', $s_ids) . ") order by Rd_Id <br/>\n";
//                echo "SELECT `flight_number`, `airplane_id`, `fdate`, `departure_time`, `landing_time`, `am_flight_a`.`airline_iata`, `from_city_iata`, `to_city_iata`, `class`, `stop_id`, `Rd_Id`,FLOOR((`price`)*$takhfif) `ghimat`,`ghimat` `unchanged_ghimat` FROM am_flight_a   WHERE   Rd_Id IN (" . implode(',', $s_ids) . ") order by Rd_Id<br/>\n";
                $query = $this->db->query("SELECT `flight_number`, `airplane_id`, `fdate`, `departure_time`, `landing_time`, `am_flight_a`.`airline_iata`, `from_city_iata`, `to_city_iata`, `class`, `stop_id`, `Rd_Id`,FLOOR((`price`)*$takhfif) `ghimat`,`price` `unchanged_ghimat` FROM am_flight_a   WHERE   Rd_Id IN (" . implode(',', $s_ids) . ") order by Rd_Id");
                $out['result'] = $query->result_array();
            }
        }
        $data['out'] = $out;
        $this->load->view('ajax_result', $data);
    }
    
}
