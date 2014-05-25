<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        //使用建構子時，要先繼承父類別的建構function
        parent::__construct();
        header("Content-type:text/html;charset=utf-8");
        $this->load->library('session');       
        $this->load->helper('url');
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $data["Site_Num"] = 1;
        $this->load->view('welcome_message', $data);
    }

    public function guestbook() {

        //echo $this->session->userdata('Name')." 歡迎光臨，你好啊!";
        //var_dump($this->session->all_userdata());
        $this->load->Model('guestbook');
        $GB=new guestbook();
        $query=$GB->GetGuestBook();
        //Base::Test($query);
        $data["Site_Num"] = 2;
        $data["guestbookList"]=$query;
        $this->load->view('guestbook', $data);
    }

    public function login($userName = '') {
        $this->load->library('Book');
        $bk = new Book();
        $bk->buyBook(8);
        $data["num"] = $bk->buyNum;
        $data["name"] = $userName;
        $data["Site_Num"] = 3;
        $this->load->view('login', $data);
        $this->session->set_userdata('Name', $userName);
        //var_dump($this->session->all_userdata());
        //redirect("index.php/welcome/test");
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */