<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Entry extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('city_model');
    }

    public function index() {
        $this->load->view('entry');
    }

    public function creat_captcha() {
        $char = array();
        $font_dir = '/home/admin/public_html/gh/website/assets/fonts/LatoMedium.ttf';
        for ($i = 0; $i < 4; $i++) {
            do {
                $ascii = rand(48, 90);
            } while ($ascii > 57);
            $char[$i] = chr($ascii);
        }
        $code = $char[0] . $char[1] . $char[2] . $char[3];
        $_SESSION['captcha'] = $code;
        $image = imagecreate(328, 60);
        $bg_color = imagecolorallocate($image, 250, 250, 250);
        imagecolortransparent($image, $bg_color);
        for ($i = 0; $i < 4; $i++) {
            $angle = rand(-20, 20);
            $size = 45;
            $space = 75;
            $height = 50;
            $color = imagecolorallocate($image, 90, 90, 90);
            imagefttext($image, $size, $angle, $i * $space + 23, $height, $color, $font_dir, $char[$i]);
        }
        imagepng($image);
    }

    public function ctrl_captcha_public_entry() {
        if (isset($_POST['captcha']) && $_SESSION['captcha'] == $_POST['captcha']) {
            $data['cities'] = $this->city_model->load_city();
            $this->load->view('result', $data);
        } else {
            $this->load->view('entry');
        }
    }

}
