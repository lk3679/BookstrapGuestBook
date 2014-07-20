<?php

//

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ChatRoom {

    function __construct() {
        $this->checkFile();
    }

    function checkFile() {
        $dir = dirname($_SERVER['SCRIPT_FILENAME']) . "/xml";
        //如果目錄不存在，建立目錄
        if (!file_exists($dir))
            mkdir($dir);

        //建立聊天內容和人員清單
        $fileChat = $dir . "/chat.txt";
        $this->AddNewFile($fileChat, 0);
        $fileChatMemList = $dir . "/chatMemList.txt";
        $this->AddNewFile($fileChatMemList, 1);
    }

    function AddNewFile($filename, $type) {
        if (!file_exists($filename)) {
            if ($handle = fopen($filename, "wt")) {
                if (is_writable($filename)) {
                    $type == 0 ? fwrite($handle, $this->InsertDefaultJSON()) : fwrite($handle, $this->InsertDefaultMember());
                }
            }
        }
    }

    function ReadChatroomContent() {
        $dir = dirname($_SERVER['SCRIPT_FILENAME']) . "/xml";
        $filename = $dir . "/chat.txt";
        $handle = fopen($filename, "r");
        $contents = '';
        if ($handle) {
            while (!feof($handle)) {
                $contents = fread($handle, 8192);
                if (!empty($contents)) {
                    //$data = json_decode($contents);
                    echo $contents;
                } else {
                    return InsertDefaultJSON();
                }
                exit;
            }
            fclose($handle);
        }
    }

    function ReadMemberList() {
        $dir = dirname($_SERVER['SCRIPT_FILENAME']) . "/xml";
        $filename = $dir . "/chatMemList.txt";
        $handle = fopen($filename, "r");
        $contents = '';
        if ($handle) {
            while (!feof($handle)) {
                $contents = fread($handle, 8192);
                if (!empty($contents)) {
                    echo $contents;
                } else {
                    return InsertDefaultMember();
                }
                exit;
            }
            fclose($handle);
        }
    }

    function UpdateChatRoom($name, $color, $who, $speech, $sex) {
        //find file path
        $dir = dirname($_SERVER['SCRIPT_FILENAME']) . "/xml";
        if (!file_exists($dir))
            mkdir($dir);
        $filename = $dir . "/chat.txt";
        $handle = fopen($filename, "r");
        $contents = '';

        if ($handle) {
            while (!feof($handle)) {
                $contents = fread($handle, 8192);
                //if result is empty ,create a new array to save the chat record
                $result = empty($contents) ? array() : json_decode($contents);
                $handle = fopen($filename, "wt");

                if (is_writable($filename)) {
                    $content = array(
                        "name" => $name,
                        "color" => $color,
                        "who" => $who,
                        "speech" => $speech,
                        "time" => date("Y-m-d H:i:s"),
                        "sex" => $sex
                    );

                    array_push($result, $content);
                    //Base::Test($result);
                    fwrite($handle, json_encode($result));
                    //Base::Test($result);
                    exit;
                }
                fclose($handle);
            }
        }
    }

    function UpdateMemberList($uid, $name, $sex, $num) {

        $dir = dirname($_SERVER['SCRIPT_FILENAME']) . "/xml";
        $filename = $dir . "/chatMemList.txt";
        $handle = fopen($filename, "r");

        //如果數量>0，增加名單，如果數量<0，在清單中移除名單
        $contents = fread($handle, 8192);
        $data = json_decode($contents);
        //Base::Test($data);
        if ($num > 0) {
            $handle = fopen($filename, "wt");
            if (!empty($contents)) {
                
                $memberList = $data->MemberList;
                $isLoging = FALSE;
                //無相同之uid，則加入到清單
                foreach ($memberList as $key => $value) {
                    if ($value->uid == $uid) {
                        $isLoging = TRUE;
                    }
                }
                if ($isLoging == FALSE) {
                    $data->total+=1;
                    $sex == "male" ? $data->men+=1 : $data->women+=1;
                    $member = array("uid" => $uid, "name" => $name, "sex" => $sex);
                    array_push($data->MemberList, $member);
                }
                //Base::Test($data);
                //Base::Test(json_encode($data));
                fwrite($handle, json_encode($data));
            }
            fclose($handle);
        } else {
            $handle = fopen($filename, "wt");
            if (!empty($contents)) {
                $data->total-=1;
                $sex == "male" ? $data->men-=1 : $data->women-=1;
                //找出uid，把他移除
                $memberList = $data->MemberList;
                foreach ($memberList as $key => $value) {
                    if ($value->uid == $uid) {
                        unset($memberList[$key]);
                    }
                }
                $data->MemberList = $memberList;
                fwrite($handle, json_encode($data));
            }
            fclose($handle);
        }
    }

    function InsertDefaultJSON() {
        $result = array();
        $content = array(
            "name" => "管理員",
            "color" => 3,
            "who" => "所有人",
            "speech" => "歡迎大家進入聊天室，請盡情聊天吧!",
            "time" => date("Y-m-d H:i:s"),
            "sex" => "male"
        );

        array_push($result, $content);
        return json_encode($result);
    }

    function InsertDefaultMember() {
        $MemberList = array();
        $content = array(
            "men" => 0,
            "women" => 0,
            "total" => 0,
            "MemberList" => $MemberList
        );
        return json_encode($content);
    }

}
