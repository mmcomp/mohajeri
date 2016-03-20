<?php

class Amadeus_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_amadeus_flight($amadeus_from_city, $amadeus_to_city, $amadeus_departure_date, $amadeus_return_date) {
        $R_ids = array(0, 0);
        $qurey = $this->db->query("SELECT `R_id` FROM `RB_AD_Request` WHERE `Fr` = '$amadeus_from_city' AND `To` = '$amadeus_to_city' AND `RTime` = '$amadeus_departure_date' AND TIMESTAMPDIFF(MINUTE,`C_Time`,'" . date("Y-m-d H:i:s") . "') <= 10");
        $direct = $qurey->result_array();
        $tmp_r_id = strtotime(date("Y-m-d H:i:s"));
        if (count($direct) == 0) {
            $R_ids[0] = $tmp_r_id;
            $this->db->query("INSERT INTO `RB_AD_Request` (`R_id`, `Fr`, `To`, `RTime`, `C_Time`) VALUES ('".$R_ids[0]."','$amadeus_from_city','$amadeus_to_city','$amadeus_departure_date','".date("Y-m-d H:i:s")."')");
        } else {
            $R_ids[0] = $direct[0]['R_id'];
        }
        $qurey = $this->db->query("SELECT `R_id` FROM `RB_AD_Request` WHERE `Fr` = '$amadeus_to_city' AND `To` = '$amadeus_from_city' AND `RTime` = '$amadeus_return_date' AND TIMESTAMPDIFF(MINUTE,`C_Time`,'" . date("Y-m-d H:i:s") . "') <= 10");
        $retuen = $qurey->result_array();
        if (count($retuen) == 0) {
            $R_ids[1] = $tmp_r_id+1;
            $this->db->query("INSERT INTO `RB_AD_Request` (`R_id`, `Fr`, `To`, `RTime`, `C_Time`) VALUES ('".$R_ids[1]."','$amadeus_to_city','$amadeus_from_city','$amadeus_return_date','".date("Y-m-d H:i:s")."')");
        } else {
            $R_ids[1] = $retuen[0]['R_id'];
        }
        return $R_ids;
    }

}
