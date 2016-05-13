<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Flight extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('liaison_model');
        $this->load->model('amadeus_model');
        $this->load->model('charter_model');
        $this->load->model('flight_model');
        $this->load->model('tax_model');
    }

    public function create_refrence() {
        $this->db->query("INSERT INTO refrence (`tarikh`, `user_id`, `source_id`, `status`, `total`) values ('" . date("Y-m-d H:i:s") . "',-1,1,2,0)");
        $refrence_id = $this->db->insert_id();
        return $refrence_id;
    }

    public function start_reserve() {
//        var_dump($_REQUEST);
        $flights = $this->input->post('flight_key');
        $flight_types = $this->input->post('flight_cat');
        $adl = $this->input->post('adult');
        $chd = $this->input->post('child');
        $inf = $this->input->post('infant');
        if (isset($_SESSION['refrence_id'])) {
            $refrence_id = $_SESSION['refrence_id'];
            $data['test'] = $tmp = $this->flight_model->get_flight_refrence($refrence_id);
            $data['flight_info'] = $tmp['flight_info'];
            $data['reserve_tmp'] = $tmp['reserve_tmp'];
            $data['adult'] = $adl;
            $data['child'] = $chd;
            $data['infant'] = $inf;
            $data['refrence_id'] = $refrence_id;
        } else {

            $refrence_id = $this->create_refrence();
            $_SESSION['refrence_id'] = $refrence_id;
            $data['adult'] = $adl;
            $data['child'] = $chd;
            $data['infant'] = $inf;
            foreach ($flights as $i => $flight_id) {

                if ($flight_types[$i] == 1) {
                    //Liason
                    $reserve_tmp = $this->liaison_model->insert_reserve($adl, $chd, $inf, $flight_id, $refrence_id);
                    $data['refrence_id'] = $refrence_id;
                    $data['reserve_tmp'][] = $reserve_tmp;
                    $data['flight_info'][] = $this->flight_model->get_flight($flight_id, $flight_types[$i]);
                } elseif ($flight_types[$i] == 2) {
                    //Amadeus
                    $reserve_tmp = $this->amadeus_model->insert_reserve($adl, $chd, $inf, $flight_id, $refrence_id);
                    $data['refrence_id'] = $refrence_id;
                    $data['reserve_tmp'][] = $reserve_tmp;
                    $data['flight_info'][] = $this->flight_model->get_flight($flight_id, $flight_types[$i]);
                } elseif ($flight_types[$i] == 3) {
                    //Charter
                    $reserve_tmp = $this->charter_model->insert_reserve($adl, $chd, $inf, $flight_id, $refrence_id);
                    $data['refrence_id'] = $refrence_id;
                    $data['reserve_tmp'][] = $reserve_tmp;
                    $data['flight_info'][] = $this->flight_model->get_flight($flight_id, $flight_types[$i]);
                }            }
        }
        $flight_info = $data['flight_info'];
        $total_price = 0;
        foreach ($flight_info as $row) {
            $price = $row[0]['price'];
            $adl_price = $adl * $price;
            $child_price = $chd * $price * 0.5;
            $infant_price = $inf * $price * 0.1;
            $total_price += $adl_price + $child_price + $infant_price;
        }
        $this->flight_model->payment($refrence_id, $total_price);
        $this->load->view('reserve', $data);
    }

    public function ticket_info() {
        //Single
        $refrence_id = $_REQUEST['refrence_id']; //$this->input->post('refrence_id');
        $mobile = $_REQUEST['cell-number']; //$this->input->post('cell-number');
        $email = $_REQUEST['email']; //$this->input->post('email');
        //Array
        $age = $_REQUEST['age']; //$this->input->post('age');
        $gender = $_REQUEST['gender']; //$this->input->post('gender');
        $fname = $_REQUEST['first-name']; //$this->input->post('first-name');
        $lname = $_REQUEST['last-name']; //$this->input->post('last-name');
        $fname_en = $_REQUEST['first-name-en']; //$this->input->post('first-name-en');
        $lname_en = $_REQUEST['last-name-en']; //$this->input->post('last-name-en');
        $nationality = $_REQUEST['nationality']; //$this->input->post('nationality');
        $shomare_melli = $_REQUEST['nid-number']; //$this->input->post('nid-number');
        $birthdate = $_REQUEST['birthdate']; //$this->input->post('birthdate');
        $passport = $_REQUEST['passport-number']; //$this->input->post('passport-number');
        $passport_expire = $_REQUEST['passport-expire']; //$this->input->post('passport-expire');
        $passport_origin = $_REQUEST['passport-origin']; //$this->input->post('passport-origin');
        foreach ($fname as $i => $fn) {
            $this->flight_model->add_ticket($refrence_id, $fn, $lname[$i], $fname_en[$i], $lname_en[$i], $nationality[$i], $shomare_melli[$i], $birthdate[$i], $passport[$i], $passport_expire[$i], $passport_origin[$i], $gender[$i], $age[$i], $mobile, $email);
        }
        $data['out'] = array("refrence_id" => $refrence_id);
        $this->load->view('ajax_result', $data);
    }

    public function confirm_etebari() {
        $refrence_id = $_REQUEST['refrence_id'];
        $user = $_REQUEST['user'];
        $pass = $_REQUEST['pass'];
        $status = FALSE;
        if ($user == 'admin' && $pass == 'admin1') {
            $status = TRUE;
            $this->flight_model->confirm_reserve($refrence_id);
        }
        $data['out'] = array("refrence_id" => $refrence_id, "status" => $status);
        $this->load->view("ticket", $data);
    }

    public function confirm_etebari_result() {
        $refrence_id = $_REQUEST['refrence_id'];
        $out = $this->flight_model->confirm_result($refrence_id);
        $data['out'] = $out;
        $data['bank'] = TRUE;
        if (isset($_SESSION['bank']) && $_SESSION['bank'] == 'saman' && trim($_SESSION['BankRefrenceNumber']) != '') {
            //Is Cash and is from saman port 
            $BankRefrenceNumber = $_SESSION['BankRefrenceNumber'];
            $soapClient = new SoapClient("https://acquirer.samanepay.com/payments/referencepayment.asmx?WSDL");
            $out = $soapClient->verifyTransaction($BankRefrenceNumber, $_SESSION['MID']);
//            var_dump($out);
            if ($out <= 0) {
                //Verification Successful
                $data['bank'] = FALSE;
            }
        }
        $this->load->view("ajax_result", $data);
    }

}
