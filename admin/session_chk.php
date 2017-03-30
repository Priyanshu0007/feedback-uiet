<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'Ashiv2424$';//password

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'feedback';
mysql_select_db($dbname) or die("database not available");
session_start();
if(!isset($_SESSION['myusername']))
{
	header("location:index.php");
}
else{
	$query = "select id from members where username='".$_SESSION['myusername']."'";
	//echo $query;
	$res = mysql_query($query) or die(mysql_error());
	$result = mysql_fetch_array($res);
	$mem_id = $result['id'];
}
//if(!session_is_registered("myusername")){
//header("location:index.php");
//}
?>
