<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ConvertPIC extends CI_Controller {

    function __construct() {
        parent::__construct();
        header("Content-type:text/html;charset=utf-8");
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('cookie');
        date_default_timezone_set("Asia/Taipei");
    }

    function index() {
         $this->load->view('convert');
    }
    
    function result(){
        
        $file=$_POST["file"];
//        Base::Test(empty($file));
        if(empty($file)){
           $file = "http://claire-chang.com/wp-content/uploads/2011/11/DSW-3009.jpg";
        }
        
        $quality = 100;
        //Base::Test(exif_imagetype($file));
        switch (exif_imagetype($file)) {

            case IMAGETYPE_PNG :
                $img = imagecreatefrompng($file);
                break;
            case IMAGETYPE_JPEG :
                $img = imagecreatefromjpeg($file);
                break;
            default:
                throw new InvalidArgumentException("錯誤發生");
                exit();
                break;
        }

        //印在畫面上
        header('Content-Type: image/jpeg');
        $src_w = imagesx($img);     //取得來源圖檔長寬
        $src_h = imagesy($img);
        $new_w = $src_w*0.3;               //新圖檔長寬
        $new_h = $src_h*0.3;
        $thumb = imagecreatetruecolor($new_w, $new_h);
        $bg = imagecolorallocate($thumb, 255, 0, 255);       //空白縮圖的背景顏色
        imagefilledrectangle($thumb, 0, 0, $src_w, $src_h, $bg); //將顏色填入縮圖
        imagecopyresampled($thumb, $img, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
        imagejpeg($thumb , NULL, $quality);
        //釋放記憶體
        imagedestroy($img);
    }

}
