<?php 
	
      include('session_chk.php');
	  include("includes/config_db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Remark</title>
</head>

<body>
<?php
$sql="select remark from feedback_master where feed_id=".$_GET['feed_id'];
$res=mysql_query($sql) or die(mysql_error());
$row=mysql_fetch_array($res);
echo $row['remark'];
?>
</body>
</html>
