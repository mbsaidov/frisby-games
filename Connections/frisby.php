<?php
session_start(); 
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_frisby = "localhost";
$database_frisby = "frisby_oyun";
$username_frisby = "frisby_frisby";
$password_frisby = "359msb359";
$frisby = mysql_pconnect($hostname_frisby, $username_frisby, $password_frisby) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db("$database_frisby");

mysql_query("SET NAMES 'utf8'"); 
mysql_query("SET CHARACTER SET utf8"); 
mysql_query("SET COLLATION_CONNECTION = 'utf8_turkish_ci'"); 
?>