<?php
$connect = mysql_connect('localhost', 'root', '$K9kxrAa');

mysql_select_db('bulksms', $connect) or die('Error:Database connection failed !');
mysql_set_charset('utf8',$connect);
ini_set('error_reporting',~E_NOTICE); 
?>

