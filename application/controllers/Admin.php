<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('country_model');
        $this->load->model('city_model');
        $this->load->model('iata_model');
        $this->load->model('masir_model');
        $this->load->model('flight_model');
    }

    public function loadData($error = '') {
        $data = array();
        $data['country'] = $this->country_model->load_country();
        $data['city'] = $this->city_model->load_city();
        $data['flight'] = $this->flight_model->load_flight();
        $data['masir'] = $this->masir_model->load_masir();
        $data['error'] = $error;
        return $data;
    }

    public function index() {
        if(isset($_SESSION['user_id']) && (int)$_SESSION['user_id']>0)
        {
            $data = $this->loadData();
            $this->load->view('admin', $data);
        }
        else{
            $data["error"] = "لطفا ابتدا وارد شوید";
            $this->load->view('entry', $data);     
        }
    }

    public function add_country() {
        $fa_name = $this->input->post('country-fa');
        $en_name = $this->input->post('country-en');
        $country_id = $this->country_model->add_country($en_name, $fa_name);
        $data = $this->loadData();
        $data['added_id'] = $country_id;
        $this->load->view('admin', $data);
    }

    public function add_city() {
        $fa_name = $this->input->post('city-fa');
        $en_name = $this->input->post('city-en');
        $country_id = $this->input->post('country-id');
        $city_id = $this->city_model->add_city($en_name, $fa_name, $country_id);
        $data = $this->loadData();
        $data['added_id'] = $city_id;
        $this->load->view('admin', $data);
    }

    public function add_iata() {
        $city_id = $this->input->post('city-id');
        $airport_name = $this->input->post('airport-name');
        $iata = $this->input->post('iata');
        $iata_id = $this->iata_model->add_iata($city_id, $airport_name, $iata);
        $data = $this->loadData();
        $data['added_id'] = $iata_id;
        $this->load->view('admin', $data);
    }

    public function add_flight() {
        $flight_number = $this->input->post('flight-number');
        $departure_time = $this->input->post('departure-time');
        $return_time = $this->input->post('return-time');
        $airline_iata = $this->input->post('airline-iata');
        $from_city_iata = $this->input->post('from-city-iata');
        $to_city_iata = $this->input->post('to-city-iata');
        $flight_id = $this->flight_model->add_flight($flight_number, $departure_time, $return_time, $airline_iata, $from_city_iata, $to_city_iata);
        $data = $this->loadData();
        $data['added_id'] = $flight_id;
        $this->load->view('admin', $data);
    }

    public function add_masir() {
        $flight_id = $this->input->post('flight-id');
        $class = $this->input->post('class');
        $ghimat = $this->input->post('ghimat');
        $departure_date = $this->input->post('departure-date');
        $return_date = $this->input->post('return-date');
        $capacity = $this->input->post('capacity');
        $masir_id = $this->masir_model->add_masir($flight_id, $class, $ghimat, $departure_date, $return_date, $capacity);
        $data = $this->loadData();
        $data['added_id'] = $masir_id;
        $this->load->view('admin', $data);
    }

    public function auth() {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');
        $captcha = $this->input->post('captcha');
        $user = $this->user_model->load_user($user, $pass);
        $data = $this->loadData();
        if($captcha!=$_SESSION['captcha'])
        {
            $data["error"] = "کد امنیتی اشتباه است";
            $this->load->view('entry', $data);           
        }
        else {
            if ($user['id'] > 0) {
                $data['user'] = $user;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['is_admin'] = ($user['typ']==1);
                $data['is_admin'] = ($user['typ']==1);
                $this->load->view('result', $data);
            } else {
                $data["error"] = "نام کاربری و یا رمز عبور اشتباه است";
                $this->load->view('entry', $data);
            }
        }
    }

//    public function auth_tmp() {
//        if (isset($_POST['captcha']) && $_SESSION['captcha'] == $_POST['captcha'] && $_REQUEST['username'] == 'admin' && $_REQUEST['password'] == 'admin') {
//            $data['cities'] = $this->city_model->load_city();
//            $data['tmp'] = 1;
//            $this->load->view('result', $data);
//        } else {
//            $this->load->view('entry');
//        }
//    }

}
