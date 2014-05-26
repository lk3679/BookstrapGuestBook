<ul class="nav nav-pills">
    <li <?php echo ($Site_Num==1)?'class="active"':''; ?>><a href="<?php echo "http://" . $_SERVER['HTTP_HOST'];  ?>/chat/welcome/">Home</a></li>
    <li <?php echo ($Site_Num==2)?'class="active"':''; ?>><a href="<?php echo "http://" . $_SERVER['HTTP_HOST'];  ?>/chat/welcome/guestbook">Guestbook</a></li>
    <li <?php echo ($Site_Num==3)?'class="active"':''; ?>><a href="<?php echo "http://" . $_SERVER['HTTP_HOST'];  ?>/chat/welcome/login">Messages</a></li>
</ul>
