<?php
   
class Base{
    
    function __construct() {
        
    }
    
    static function Test($data){
        echo "<pre>";
        var_dump($data);
        die;
    }
}

