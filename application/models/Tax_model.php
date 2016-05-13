<?php

class Tax_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getTakhfifLiaison()
    {
        return('.97');
    }

    public function getTakhfifAmadeus()
    {
        return('.94');
    }
    
    public function load_tax($class,$airline) {
        $out = 0;
        $query = $this->db->query("SELECT tax+airport_service t FROM class_tax where class = '$class' and airline = '$airline");
        $result = $query->result_array();
        if(count($result)==1)
        {
            $out = (int)$result[0]['t'];
        }
        return $out;
    }

}
