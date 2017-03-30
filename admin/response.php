<?php
 
include("includes/config_db.php");
$s_id=$_REQUEST['sem_id'];
$f_id=$_REQUEST['f_id'];

$query = "select * from subject_master  where sem_id=".$s_id." and f_id=".$f_id;
$q=mysql_query($query) or die(mysql_error());
$myarray=array();

while($result = mysql_fetch_assoc($q))
{
	$str = array('sub_id' => $result['sub_id'],'sub_name' => $result['sub_name']);
	array_push($myarray, $str);
}

echo json_encode($myarray);
return json_encode($myarray);

?>