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
        //先判斷session的登入狀態
        $session = $this->session->all_userdata();

        if (!isset($session["user"])) {
            $data["Site_Num"] = 3;
            //再判斷cookie的紀錄，如果不為空，填入到input text
            //Base::Test($_COOKIE);
            //Base::Test($_COOKIE["mail"]);
            if(isset($_COOKIE["mail"])&&isset($_COOKIE["password"])){
                $data["mail"]=$_COOKIE["mail"];
                $data["password"]=$_COOKIE["password"];
            }else{
                $data["mail"]="";
                $data["password"]="";
            }
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
        $remember = $_POST["remember"];
        
        $this->load->Model('member');
        $MB = new member();
        //Base::Test($MB->checkIDandPass($mail, $password));
        $userData = $MB->checkIDandPass($mail, $password);
        $result = count($userData) > 0 ? TRUE : FALSE;
        if ($result) {
            //寫入登入的相關資訊到session
            $this->session->set_userdata("user", $userData);
            if ($remember == "true") {
                //紀錄到cookie
                setcookie("mail",$mail, time()+3600*240);
                setcookie("password",$_POST["password"], time()+3600*240);
            }
        }
        echo json_encode($result);
    }

    function sign() {
        $data["Site_Num"] = 3;
        //set_cookie("web", "dickgou.net63", time() + 3600);
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
            "sex" => $sex
        );
        //param1放table名稱，後面放新增欄位之陣列
        $member->AddNew('user', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */