<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('flight_model');
        $this->config->set_item('MID', '10430551');
    }

    public function index() {
        $data['MID'] = $this->config->item('MID');
        if (isset($_SESSION['refrence_id']) && (int) $_SESSION['refrence_id'] > 0) {
            $refrence_id = (int) $_SESSION['refrence_id'];
            $tot = $this->flight_model->reserve_total($refrence_id);
            if ($tot['error'] == 0) {
                $data['Amount'] = $tot['total'];
                $data['ResNum'] = $refrence_id;
                $this->load->view('bank', $data);
            } else {
                //Load a view to show error and send back to default page
                $data['error'] = "رزرو مورد نظر به درستی ثبت نشده است";
                $this->load->view('error_page', $data);
            }
        } else {
            //Load a view to show error and send back to default page
            $data['error'] = "دسترسی غیر مجاز";
            $this->load->view('error_page', $data);
        }
    }

    public function payment_done() {
        $State = $_REQUEST['State'];
        $StateCode = $_REQUEST['StateCode'];
        $refrence_id = $_REQUEST['ResNum'];
        $BankRefrenceNumber = $_REQUEST['RefNum'];
        $MID = $_REQUEST['MID'];
        $_SESSION['refrence_id'] = NULL;
        if ($StateCode == "0") {
            $_SESSION['refrence_id'] = $refrence_id;
            $_SESSION['bank'] = 'saman';
            $_SESSION['MID'] = $MID;
            $_SESSION['BankRefrenceNumber'] = $BankRefrenceNumber;
            $this->flight_model->confirm_reserve($refrence_id);
            $data['out'] = array("refrence_id" => $refrence_id, "status" => TRUE);
            $this->load->view("ticket", $data);
        } else {
            //Load a view to show error and send back to default page
            $data['error'] = $State;
            if ($StateCode == -1) {
                $data['error'] = "انصراف از پرداخت";
            }
            $this->load->view('error_page', $data);
        }
    }

}
