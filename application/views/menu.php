
   <div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <!--<a class="brand" href="<?php echo "http://" . $_SERVER['HTTP_HOST'];  ?>/chat/welcome/">首頁</a>-->
    <ul class="nav">
      <li <?php echo ($Site_Num==1)?'class="active"':''; ?>><a href="<?php echo "http://" . $_SERVER['HTTP_HOST'];  ?>/chat/welcome/">Home</a></li>
    <li <?php echo ($Site_Num==2)?'class="active"':''; ?>><a href="<?php echo "http://" . $_SERVER['HTTP_HOST'];  ?>/chat/welcome/guestbook">Guestbook</a></li>
    <li <?php echo ($Site_Num==3)?'class="active"':''; ?>><a href="<?php echo "http://" . $_SERVER['HTTP_HOST'];  ?>/chat/welcome/login">Login</a></li>
    </ul>
  </div>
