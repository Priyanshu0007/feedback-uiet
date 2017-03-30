<?php




$dbhost="localhost";  #SQL Database Hostname (Most is: localhost)
$dbusername="root";   #SQL Username
$dbpassword="Ashiv2424$";   #SQL Password
$dbname="feedback"; #SQL Database Name




$connect = mysql_connect($dbhost, $dbusername, $dbpassword);
//Select the correct database.
$db = mysql_select_db($dbname,$connect) or die ("Could not select database");
?> 


