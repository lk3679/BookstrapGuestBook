<html>
    <head>
        <?php include 'header.php'; ?>
        <title>圖片縮圖</title>
        <link href="~/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
        <link href='http://mybidrobot.allalla.com/jquery/jquery-ui-timepicker-addon.css' rel='stylesheet'>
        <script type="text/javascript" src="http://mybidrobot.allalla.com/jquery/jquery-ui-timepicker-addon.js"></script>
        <script type='text/javascript' src='http://mybidrobot.allalla.com/jquery/jquery-ui-sliderAccess.js'></script>
    </head>
    <script language="JavaScript">
        var StartTime;
        var EndTime;
        $(document).ready(function() {
            $("#dialog-message").dialog({
                autoOpen: false,
                modal: true,
                buttons: {
                    Ok: function() {
                        $(this).dialog("close");
                    }
                }
            });



            var opt = {dateFormat: 'yy/mm/dd',
                showSecond: true,
                timeFormat: 'HH:mm:ss'
            };
            $('#datetimepicker1').datetimepicker(opt);
            $('#datetimepicker2').datetimepicker(opt);
            $('#datetimepicker1').change(function() {
                StartTime = new Date($('#datetimepicker1').val());
                console.log(StartTime);
            });
            $('#datetimepicker2').change(function() {
                EndTime = new Date($('#datetimepicker2').val());
                console.log(EndTime);
            });

        });
        function send() {
            if (EndTime < StartTime) {
                $("#msg").html("結束時間須大於開始時間");
                $('#dialog-message').dialog('open');
            }else{
                $("#msg").html("設定成功!!");
                $('#dialog-message').dialog('open');
            }
        }
    </script>
    <body>


        <div style="margin-left: 20%;margin-top: 10%">
            <p>請輸入圖片網址：</p>
<!--            <form method="post" action="../ConvertPIC/result" >
                <input type="text" name="file" style="width: 500px;height: 25px" /></br>
                <input type="submit" value="送出" class="btn btn-primary " /></br></br>


            </form>-->

            <input type="text" id="datetimepicker1" style="width: 250px;height: 25px" /></br></br>
            <input type="text" id="datetimepicker2" style="width: 250px;height: 25px" /></br></br>
            <input type="button" value="送出" class="btn btn-primary " onclick="send();">
        </div>
        <div id="dialog-message" title="通知" style="display:none">
            <p>
                <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
                <span id="msg"></span>
            </p>
    </body>
</html>
