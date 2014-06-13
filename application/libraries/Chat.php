<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ChatRoom {

    function __construct() {
        $this->checkFile();
    }

    function checkFile() {
        $dir = dirname($_SERVER['SCRIPT_FILENAME']) . "/xml";
        if (!file_exists($dir))
            mkdir($dir);
        $filename = $dir . "/chat.txt";
        if (!file_exists($filename)) {
            if ($handle = fopen($filename, "wt")) {
                if (is_writable($filename)) {
                    fwrite($handle, $this->InsertDefaultJSON());
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
                }else{
                    return InsertDefaultJSON();
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

}
