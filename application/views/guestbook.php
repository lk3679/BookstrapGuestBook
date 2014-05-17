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
</head>
<body>
    <?php include 'menu.php'; ?>
    <div id="container">
        <p align="center"><h2 align="center"><strong>留言板</strong></h2></p>

    <table width="1200" border="1"  class="table table-bordered table-condensed">
      <tr>
        <td id="color"><div id="heig"><strong>留言人:</strong>
            <input type="text" name="user" id="user" />
            <input name="time" type="hidden" id="time" value="<?=date('Y/m/d');?>" />
            </div>
        </td>
        <td id="color"><div align="center">
          <button id="modal_link" class="btn">留言</button>
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
        <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
    </div>

     <div id="dialog-message" title="通知">
                    <p>
                        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;">
                            留言成功！！
                        </span>
                        
                    </p>

                </div>
    <?php include 'footer.php'; ?>
</body>
</html>
