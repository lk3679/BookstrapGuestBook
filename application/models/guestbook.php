<?php

class guestbook extends CI_Model{

    function __construct() {
    
        
    }

    function GetGuestBook() {
        $query = $this->db->query("SELECT * FROM guestbook")->result();
        return $query;
    }

}

