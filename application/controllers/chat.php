<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class chat extends CI_Controller {

    function __construct() {
        parent::__construct();
        header("Content-type:text/html;charset=utf-8");
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('cookie');
        date_default_timezone_set("Asia/Taipei");
    }

    function chatroom() {
        $session=$this->session->all_userdata();
        $data=$session["user"][0];
        //Base::Test($data);
        $this->load->library("Chat");
        $chatroom = new ChatRoom();
        $chatroom->UpdateMemberList($data->uid,$data->user, $data->sex, 1);
        $this->load->view("chatroom",$data);
    }

    function Read() {
        $this->load->library("Chat");
        $chatroom = new ChatRoom();
        $chatroom->ReadChatroomContent();
    }
    
    function ReadList() {
        $this->load->library("Chat");
        $chatroom = new ChatRoom();
        $chatroom->ReadMemberList();
    }

    function Write() {
        $this->load->library("Chat");
        $name = $_POST["name"];
        $color = $_POST["color"];
        $who = $_POST["who"];
        $speech = $_POST["speech"];
        $sex=$_POST["sex"];

        $chatroom = new ChatRoom();
        $chatroom->UpdateChatRoom($name, $color, $who, $speech,$sex);
    }
    
    function logout(){
        $this->load->library("Chat");
        $session=$this->session->all_userdata();
        $data=$session["user"][0];
        $chatroom = new ChatRoom();
        $chatroom->UpdateMemberList($data->uid,$data->user, $data->sex, -1);
        $this->session->sess_destroy();
        header("location:../welcome/login");
    }

}
