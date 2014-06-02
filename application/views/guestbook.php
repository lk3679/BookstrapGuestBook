<!DOCTYPE html>
<head>	
    <title>留言板</title>	
    <?php include 'header.php'; ?>
    <style type="text/css">	
        ::selection{ background-color: #E13300; color: white; }	
        ::moz-selection{ background-color: #E13300; color: white; }	
        ::webkit-selection{ background-color: #E13300; color: white; }	
        body {		background-color: #fff;		margin: 0px;		
                font: 13px/20px normal Helvetica, Arial, sans-serif;		
                color: #4F5155;	}	
        a {		color: #003399;		
             background-color: transparent;		
             font-weight: normal;	}	
        h1 {		color: #444;		background-color: transparent;		border-bottom: 1px solid #D0D0D0;		font-size: 19px;		font-weight: normal;		margin: 0 0 14px 0;		padding: 14px 15px 10px 15px;	}	code {		font-family: Consolas, Monaco, Courier New, Courier, monospace;		font-size: 12px;		background-color: #f9f9f9;		border: 1px solid #D0D0D0;		color: #002166;		display: block;		margin: 14px 0 14px 0;		padding: 12px 10px 12px 10px;	}	#body{		margin: 0 15px 0 15px;	}		p.footer{		text-align: right;		font-size: 11px;		border-top: 1px solid #D0D0D0;		line-height: 32px;		padding: 0 10px 0 10px;		margin: 20px 0 0 0;	}		#container{		margin: 10px;		border: 1px solid #D0D0D0;		-webkit-box-shadow: 0 0 8px #D0D0D0;	}	
    </style>
    <script type="text/javascript">
       
        $().ready(function() {
            $("#bookContent").slideToggle(1000);

            $("#dialog-message").dialog({
                autoOpen: false,
                modal: true,
                buttons: {
                    Ok: function() {
                        $(this).dialog("close");
                    }
                }
            });
        });

        function getData() {

            $.ajax({
                url: "../welcome/guestbookJSON",
                type: 'GET',
                dataType: "json", async: true,
                success: function(data) {
                    setBook(data);
                },
                error: function(xhr) {
                    alert("Error!!");
                }
            });
        }

        function setBook(data) {
            //陣列反轉，新的在前
            //data.reverse();
            var div = '';
                div += '<table width="100%" border="1" class="table table-bordered table-condensed">';
                div += '<tr><td id="color"><strong>' + data[0].user;
                div += '</strong></td><td style="text-align:right;color: #942a25">時間：' + data[0].createdate + '</td></tr>';
                div += '<tr><td colspan="2" style="height: 50px"><p style="font-family:Microsoft JhengHei"><big>' + data[0].content + '</big></p></td></tr> ';
                div += '</table>';
            var old=$("#bookContent").html();
            $("#bookContent").html(div+old);
         
        }

        // Modal Link
        function submit() {
            var user = $("#user").val();
            var content = $("#content").val();
            if (user.length > 0 && content.length > 0) {
                var jqxhr = $.post("../welcome/InsertGuestBook", {user: user, content: content}, function() {
                })
                        .done(function() {
                            $("#msg").html("留言成功");
                            $('#dialog-message').dialog('open');
                            //$("#bookContent").html('');
                            getData();
                        })
                        .fail(function() {
                            $("#msg").html("留言失敗");
                            alert("error");
                        });

                $("#user").val('');
                $("#content").val('');
            } else {
                $("#msg").html("請填寫姓名和留言內容");
                $('#dialog-message').dialog('open');
            }

        }




//每秒固定執行
//        setInterval(function(){
//            a();
//        } ,1000);
    </script>
</head>
<body>
    <?php include 'menu.php'; ?>
</div>
<div id="container" style="margin: 10%;margin-top: 5%">

    <p align="center"><h2 align="center"><strong>留言板</strong></h2></p>

<table width="100%" border="1"  class="table table-bordered table-condensed">
    <tr>
        <td id="color"><div id="heig"><strong>留言人:</strong>
                <input type="text" name="user" id="user" />

            </div>
        </td>
        <td id="color"><div align="center">
                <input type="button"  class="btn"  value="留言" onclick="submit();">
            </div></td>
    </tr>
    <tr>
        <td colspan="2"><label>
                <div align="center">
                    <textarea name="content" id="content" rows="8" class="span10" style="width:90%"></textarea>
                </div>
            </label></td>
    </tr>
</table>
<div id="bookContent" style="display:none">
    <?php
    foreach ($guestbook as $row) {
        ?>
        <table width="100%" border="1" class="table table-bordered table-condensed">
            <tr><td id="color"><strong><?php echo $row->user; ?></strong></td>
                <td style="text-align:right;color: #942a25">時間：<?php echo $row->createdate; ?></td></tr>
            <tr><td colspan="2" style="height: 50px"><p style="font-family:Microsoft JhengHei"><big><?php echo $row->content; ?></big></p>
        </td></tr>
        </table>
    
<?php } ?>
    
    </div>
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<div id="dialog-message" title="通知" style="display:none">
    <p>
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        <span id="msg">留言成功！！</span>
    </p>

</div>

</body>
</html>
