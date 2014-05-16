<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Book{
    public  $bookName;
    public  $price;
    public $buyNum;
    public function  buyBook($num){
        $this->buyNum=$num;
    }
}


