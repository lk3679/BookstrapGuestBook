
<!DOCTYPE html>
<head>	
    <title>聊天室</title>	
    <?php include 'header.php'; ?>
    <style type="text/css">	
        ::selection{ background-color: #E13300; color: white; }	
        ::moz-selection{ background-color: #E13300; color: white; }	
        ::webkit-selection{ background-color: #E13300; color: white; }	
        body {		background-color: #fff;		margin: 0px;		font: 13px/20px normal Helvetica, Arial, sans-serif;		color: #4F5155;	}	a {		color: #003399;		background-color: transparent;		font-weight: normal;	}	h1 {		color: #444;		background-color: transparent;		border-bottom: 1px solid #D0D0D0;		font-size: 19px;		font-weight: normal;		margin: 0 0 14px 0;		padding: 14px 15px 10px 15px;	}	code {		font-family: Consolas, Monaco, Courier New, Courier, monospace;		font-size: 12px;		background-color: #f9f9f9;		border: 1px solid #D0D0D0;		color: #002166;		display: block;		margin: 14px 0 14px 0;		padding: 12px 10px 12px 10px;	}	#body{		margin: 0 15px 0 15px;	}		p.footer{		text-align: right;		font-size: 11px;		border-top: 1px solid #D0D0D0;		line-height: 32px;		padding: 0 10px 0 10px;		margin: 20px 0 0 0;	}		#container{		margin: 10px;		border: 1px solid #D0D0D0;		-webkit-box-shadow: 0 0 8px #D0D0D0;	}	
    </style>
    <script type="text/javascript">
        var usernemae = '<?= $user ?>';

        $(function() {
            //postData("剛剛進入聊天室，大家來跟我聊天喔!");
            getMsg();

        })

        function getMsg() {
            $.ajax({
                url: "../chat/Read",
                type: 'GET',
                dataType: "json", async: true,
                success: function(data) {
                    setMsg(data);
                },
                error: function(xhr) {
                    alert("Error!!");
                }
            });
        }

        function setMsg(data) {
            //data.reverse();
            var div = "";
            console.log(data)
            $.each(data, function(key, value) {
                content = value.name + "對[" + value.who + "]說:" + value.speech + "  時間：" + value.time + "<br/>";
                div += content;
            });

            $("#record").html(div);
        }

        function submit() {
            content = $("#content").val();
            postData(content);
        }
        
        function logout(){
            window.location.href="../chat/logout";
        }

        function postData(speech) {
            var jqxhr = $.post("../chat/Write", {name: usernemae, color: 3, who: "所有人", speech: speech}, function() {
            })
                    .done(function() {
                        console.log("success!");
                        $("#content").val('');
                    })
                    .fail(function() {
                        console.log("faile!");
                    });
        }

        setInterval(function() {
            getMsg();
        }, 1000);

    </script>
</head>
<body>
    <div id="record" style="height:400px;width: 100%"></div>
    <div style="margin-left: 20%;width: 60%;margin-bottom: 5%;position: fixed">	
         <div>暱稱：<?= $user ?>　　　性別：<?= $sex=="male"?"男":"女" ?></div>
        <div><textarea name="content" id="content" rows="8" class="span10" style="width:90%"></textarea></div>
        <input type="button"  class="btn"  value="送出" onclick="submit();">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" class="btn btn-danger" value="登出" onclick="logout();">
    </div>
</body>
</html>
