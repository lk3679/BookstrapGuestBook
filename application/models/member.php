<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class member extends CI_Model{

    function GetUser() {
        $query = $this->db->query("SELECT * FROM user")->result();
        return $query;
    }
    
    function AddNew($TableNmae,$data){
//        $str = $this->db->insert_string('test',$data);
//        Base::Test($str);
        $this->db->insert($TableNmae,$data);
    }

}

