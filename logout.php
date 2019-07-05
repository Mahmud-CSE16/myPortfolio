<?php
 session_start();
 session_destroy();
 setcookie('cookie_name', "", time() - 3600);
 header("Location: index.php"); 
 ?>