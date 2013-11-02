<?php
session_start();
session_destroy();
unset($_SESSION['login']);
unset($_SESSION['status']);

header("Location:login.php");
?>