<?php
session_start();
unset($_SESSION['User_name']);
//session destroy
session_destroy();
header('Location: login_from.php');
exit;
?>