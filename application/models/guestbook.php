<?php

class guestbook extends CI_Model{

    function GetGuestBook() {
        $query = $this->db->query("SELECT * FROM guestbook order by createdate DESC")->result();
        return $query;
    }
    
    function AddNew($TableNmae,$data){
//        $str = $this->db->insert_string('test',$data);
//        Base::Test($str);
        $this->db->insert($TableNmae,$data);
    }

}

