<!DOCTYPE html>
<head>	
    <title>登入頁面</title>	
    <?php include 'header.php'; ?>
    <style type="text/css">	
        ::selection{ background-color: #E13300; color: white; }	
        ::moz-selection{ background-color: #E13300; color: white; }	
        ::webkit-selection{ background-color: #E13300; color: white; }	
        body {		background-color: #fff;		margin: 0px;		font: 13px/20px normal Helvetica, Arial, sans-serif;		color: #4F5155;	}	a {		color: #003399;		background-color: transparent;		font-weight: normal;	}	h1 {		color: #444;		background-color: transparent;		border-bottom: 1px solid #D0D0D0;		font-size: 19px;		font-weight: normal;		margin: 0 0 14px 0;		padding: 14px 15px 10px 15px;	}	code {		font-family: Consolas, Monaco, Courier New, Courier, monospace;		font-size: 12px;		background-color: #f9f9f9;		border: 1px solid #D0D0D0;		color: #002166;		display: block;		margin: 14px 0 14px 0;		padding: 12px 10px 12px 10px;	}	#body{		margin: 0 15px 0 15px;	}		p.footer{		text-align: right;		font-size: 11px;		border-top: 1px solid #D0D0D0;		line-height: 32px;		padding: 0 10px 0 10px;		margin: 20px 0 0 0;	}		#container{		margin: 10px;		border: 1px solid #D0D0D0;		-webkit-box-shadow: 0 0 8px #D0D0D0;	}	
    </style>
    <script type="text/javascript">

        $().ready(function() {
            $("#dialog-message").dialog({
                autoOpen: false,
                modal: true,
                buttons: {
                    Ok: function() {
                        $(this).dialog("close");
                    }
                }
            });

            $("#sign").click(function() {
                window.location.href = "sign";
            });

            $("#login").click(function() {
                var email = $("#inputEmail").val();
                var password = $("#inputPassword").val();

                if ($("#inputEmail").val() === "") {
                    $("#msg").html("信箱不可為空");
                    $('#dialog-message').dialog('open');
                } else if ($("#inputPassword").val() === "") {
                    $("#msg").html("密碼不可為空");
                    $('#dialog-message').dialog('open');
                } else {
                    send(email, password);
                }

            });

            $("#inputEmail").change(function() {
                //alert("Handler for .change() called.");
                var email = $("#inputEmail").val();
                if (validateEmail(email) === true) {
                    $(this).css("border-color", "");
                } else {
                    $("#msg").html("信箱格式錯誤");
                    $('#dialog-message').dialog('open');
                    $(this).css("border-color", "red");
                }

            });

        });


        function send(email, password) {
            var check=$("#remember").prop("checked");
            //alert(check);return false;
            $.ajax({
                url: "../welcome/loginStatus",
                data: {email: email, password: password,remember:check},
                type: 'POST',
                dataType: "json", async: true,
                success: function(data) {
                    if (data === true) {
//                        $("#msg").html("登入成功!");
//                        $('#dialog-message').dialog('open');
                        window.location.href="../chat/chatroom";

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



        function validateEmail(email) {
            var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            var valid = emailReg.test(email);
            if (!valid) {
                return false;
            } else {
                return true;
            }
        }

    </script>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div id="container" style="margin: 10%;margin-top: 5%">	
        <h1>使用者你好，請登入你的帳號</h1>
        <div id="body">	

            <form class="form-horizontal">
                <div class="control-group">
                    <label class="control-label" for="inputEmail">Email</label>
                    <div class="controls">
                        <input type="text" id="inputEmail" placeholder="Email" value="<?php echo $mail; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputPassword">密碼</label>
                    <div class="controls">
                        <input type="password" id="inputPassword" placeholder="密碼" value="<?php echo $password; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <label class="checkbox">
                            <input id="remember" type="checkbox"> 記住我
                        </label>
                        <input type="button" id="login"  class="btn btn-primary " value="登入">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="button" id="sign" class="btn btn-primary " value="註冊">
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