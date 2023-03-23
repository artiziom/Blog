<?php
session_start();
 $login = false;
 $nick = null;
 unset($_SESSION['login']);
 $_SESSION['loginName'] = $nick;
 echo "<div onclick=history.go(-1);>Wylogowano</div>";
 header("Location: http://localhost/Blog/blog.php");

?>
