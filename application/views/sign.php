<!DOCTYPE html>
<head>	
    <title>註冊頁面</title>	
    <?php include 'header.php'; ?>
    <style type="text/css">	
        ::selection{ background-color: #E13300; color: white; }	
        ::moz-selection{ background-color: #E13300; color: white; }	
        ::webkit-selection{ background-color: #E13300; color: white; }	
        body {		background-color: #fff;		margin: 0px;		font: 13px/20px normal Helvetica, Arial, sans-serif;		color: #4F5155;	}	a {		color: #003399;		background-color: transparent;		font-weight: normal;	}	h1 {		color: #444;		background-color: transparent;		border-bottom: 1px solid #D0D0D0;		font-size: 19px;		font-weight: normal;		margin: 0 0 14px 0;		padding: 14px 15px 10px 15px;	}	code {		font-family: Consolas, Monaco, Courier New, Courier, monospace;		font-size: 12px;		background-color: #f9f9f9;		border: 1px solid #D0D0D0;		color: #002166;		display: block;		margin: 14px 0 14px 0;		padding: 12px 10px 12px 10px;	}	#body{		margin: 0 15px 0 15px;	}		p.footer{		text-align: right;		font-size: 11px;		border-top: 1px solid #D0D0D0;		line-height: 32px;		padding: 0 10px 0 10px;		margin: 20px 0 0 0;	}		#container{		margin: 10px;		border: 1px solid #D0D0D0;		-webkit-box-shadow: 0 0 8px #D0D0D0;	}	
    </style>
    <script type="text/javascript">
        var MailFormat = false;
        var rigisterSuccess = false;
        var Sex = "";

        $(function() {

            $("input[name='sex']").click(function() {
                Sex = $(this).val();
                //alert(Sex);
            });

            $("#inputPassword,#inputPasswordCheck").focus(function() {
                $(this).next("p").css("display", "inline").fadeOut(3000);
            });

            $("#dialog-message").dialog({
                autoOpen: false,
                modal: true,
                buttons: {
                    Ok: function() {
                        $(this).dialog("close");
                        if (rigisterSuccess === true) {
                            email = $("#inputEmail").val();
                            password = $("#inputPassword").val();
                            send(email,password);
                        }
                    }
                }
            });
            $("#inputEmail").change(function() {
                //alert("Handler for .change() called.");
                var email = $("#inputEmail").val();
                if (validateEmail(email) === true) {
                    $(this).css("border-color", "")
                    MailFormat = true;
                } else {
                    $("#msg").html("信箱格式錯誤");
                    $('#dialog-message').dialog('open');
                    $(this).css("border-color", "red");
                }

            });
            $("#inputPasswordCheck").change(function() {
                var pass = $("#inputPassword").val();
                var passCheck = $("#inputPasswordCheck").val();

                if ($("#inputPassword").val().length < 6 || $("#inputPasswordCheck").val().length < 6) {
                    $("#msg").html("密碼長度需大於6碼");
                    $('#dialog-message').dialog('open');
                } else if ($("#inputPassword").val().length > 12 || $("#inputPasswordCheck").val().length > 12) {
                    $("#msg").html("密碼長度需小於12碼");
                    $('#dialog-message').dialog('open');
                } else if (pass !== passCheck) {
                    $("#msg").html("密碼不一致，請重新輸入");
                    $('#dialog-message').dialog('open');
                    $("#inputPassword").val('');
                    $("#inputPasswordCheck").val('');
                }
            });
            $("#send").click(function() {
                email = $("#inputEmail").val();
                password = $("#inputPassword").val();
                user = $("#inputNickName").val();
                if (email.length<1) {
                    $("#msg").html("信箱不可為空");
                    $('#dialog-message').dialog('open');
                } else if (MailFormat === false) {
                    $("#msg").html("信箱格式錯誤");
                    $('#dialog-message').dialog('open');
                } else if ($("#inputPassword").val() === "" || $("#inputPasswordCheck").val() === "") {
                    $("#msg").html("密碼不可為空");
                    $('#dialog-message').dialog('open');
                } else if ($("#inputNickName").val() === "") {
                    $("#msg").html("暱稱不可為空");
                    $('#dialog-message').dialog('open');
                } else if (Sex.length < 1) {
                    $("#msg").html("請選擇性別");
                    $('#dialog-message').dialog('open');
                } else {
                    //post data to singUp
                    postData(email, password, user);
                }
            });
        });

        function postData(email, password, user) {
            var jqxhr = $.post("../welcome/signUser", {email: email, password: password, user: user, sex: Sex}, function() {
            })
                    .done(function() {
                        $("#msg").html("註冊成功");
                        rigisterSuccess = true;
                        $('#dialog-message').dialog('open');
                    })
                    .fail(function() {
                        $("#msg").html("註冊失敗");
                    });
        }

        function validateEmail(email) {
            var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            var valid = emailReg.test(email);
            if (!valid) {
                return false;
            } else {
                return true;
            }
        }


        function send(email, password) {
            $.ajax({
                url: "../welcome/loginStatus",
                data: {email: email, password: password},
                type: 'POST',
                dataType: "json", async: true,
                success: function(data) {
                    if (data === true) {
//                        $("#msg").html("登入成功!");
//                        $('#dialog-message').dialog('open');
                        window.location.href = "../chat/chatroom";

                    } else {
                        $("#msg").html("登入失敗!");
                        $('#dialog-message').dialog('open');

                    }
                },
                error: function(xhr) {
                    alert("Error!!");
                }
            });
        }
    </script>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div id="container" style="margin: 10%;margin-top: 5%">	
        <h1>使用者你好，請輸入電子郵件信箱、個人密碼和暱稱</h1>
        <div id="body">	

            <form class="form-horizontal">

                <div class="control-group">
                    <label class="control-label">Email</label>
                    <div class="controls">
                        <input type="text" id="inputEmail" placeholder="Email" >
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">密碼</label>
                    <div class="controls">
                        <input type="password" id="inputPassword" placeholder="密碼">
                        <p class="text-warning" style="display: none">密碼請輸入英數字，長度介於6到12之間</p>
                    </div>


                </div>
                <div class="control-group">
                    <label class="control-label" >確認密碼</label>
                    <div class="controls">
                        <input type="password" id="inputPasswordCheck" placeholder="密碼">
                        <p class="text-warning" style="display: none">密碼請輸入英數字，長度介於6到12之間</p>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">暱稱</label>
                    <div class="controls">
                        <input type="text" id="inputNickName" placeholder="暱稱">
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label">性別</label>
                    <div class="controls">
                        <input type="radio" name="sex" value="male">男 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="sex" value="female">女
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="button" id="send" class="btn btn-primary " value="送出">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="button" class="btn btn-primary " value="返回" onclick="javascript:history.back();">
                    </div>
                </div>

            </form>

        </div>	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
    </div>

    <div id="dialog-message" title="通知" style="display:none">
        <p>
            <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
            <span id="msg"></span>
        </p>

    </div>
</body>
</html>
