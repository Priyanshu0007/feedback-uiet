<?php
 
include("includes/config_db.php");
$f_id=$_REQUEST['fac_name'];
$b_id=$_REQUEST['bid'];
$s_id=$_REQUEST['sid'];

$query = "select * from subject_master  where sem_id=".$s_id." and  batch_id=".$b_id." and f_id=".$f_id;
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