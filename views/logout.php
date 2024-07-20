<?php 
session_start();
session_destroy();
session_unset();
$_SESSION["login"] = false;

setcookie("id", "", time() + 3600);
setcookie("key", "", time() + 3600);

header("location: login.php")
?>