<?php

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function load_user($user,$pass) {
        $out = array("id"=>-1);
        $query = $this->db->query("SELECT * FROM user where user = '$user'");
        $result = $query->result_array();
        if(count($result)==1)
        {
            if($result[0]['pass']==$pass)
            {
                $out = $result[0];
            }
        }
        return $out;
    }

}
