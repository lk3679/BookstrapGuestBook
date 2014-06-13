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
        $this->load->helper('cookie');
    }

    public function index() {
        $data["Site_Num"] = 1;
        $this->load->view('welcome_message', $data);
    }

    public function guestbook() {

        //echo $this->session->userdata('Name')." 歡迎光臨，你好啊!";
        //var_dump($this->session->all_userdata());
        $this->load->Model('guestbook');
        $GB = new guestbook();
        $query = $GB->GetGuestBook();
        $data["Site_Num"] = 2;
        $data["guestbook"] = $query;
        $this->load->view('guestbook', $data);
    }

    public function guestbookJSON() {
        $this->load->Model('guestbook');
        $GB = new guestbook();
        $query = $GB->GetGuestBook();
        echo json_encode($query);
    }

    public function InsertGuestBook() {
        $user = $_POST["user"];
        $content = $_POST["content"];
        $this->load->Model('guestbook');
        $GB = new guestbook();
        $data = array(
            "user" => $user,
            "content" => $content,
            "createdate" => date("Y-m-d H:i:s")
        );
        //param1放table名稱，後面放新增欄位之陣列
        $GB->AddNew('guestbook', $data);
    }

    public function login() {
        $session = $this->session->all_userdata();
        if (!isset($session["user"])) {
            $data["Site_Num"] = 3;
            $this->load->view('login', $data);
        } else {
            header("location:../chat/chatroom");
        }
        //var_dump($this->session->all_userdata());
        //redirect("index.php/welcome/test");
    }

    function loginStatus() {
        $mail = $_POST["email"];
        $password = md5($_POST["password"]);
        //$this->session->sess_destroy();
        $this->load->Model('member');
        $MB = new member();
        //Base::Test($MB->checkIDandPass($mail, $password));
        $userData = $MB->checkIDandPass($mail, $password);
        $result = count($userData) > 0 ? TRUE : FALSE;
        if ($result) {
            $this->session->set_userdata("user", $userData);
            //寫入登入的相關資訊到cookie和session    
        }
        echo json_encode($result);
    }

    function sign() {
        $data["Site_Num"] = 3;
        set_cookie("web", "dickgou.net63", time() + 3600);
        //$this->session->set_userdata('uid', 'robert');
        $this->load->view('sign', $data);
    }

    function signUser() {
        $user = $_POST["user"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $sex = $_POST["sex"];
        
        $this->load->Model('member');
        $member = new member();
        $data = array(
            "user" => $user,
            "email" => $email,
            "password" => md5($password),
            "createdate" => date("Y-m-d H:i:s"),
            "sex"=>$sex
        );
        //param1放table名稱，後面放新增欄位之陣列
        $member->AddNew('user', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */