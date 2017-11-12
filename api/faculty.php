<?php
	include("../admin/includes/common_functions.php");
	include("../ajax_script.php");
	if((isset($_REQUEST['roll']))&&(!empty($_REQUEST['roll'])))
{
	$roll  = $_REQUEST['roll'];
	$sem  =  $_REQUEST['sem'];
	$branch= $_REQUEST['branch'];
	$batch = 2014+intval(substr($roll, 3,1));
	if($batch==2018)
		$sem = 7;
	elseif ($batch==2019)
		$sem = 5;
	elseif ($batch==2020)
		$sem = 3;
	elseif ($batch==2021)
		$sem = 1;
	$br = intval(substr($roll, 4,1));
	if($br == 8)
		$branch = "IT";
	elseif($br == 3)
		$branch = "CSE";
	elseif($br == 1)
		$branch = "BIO";
	elseif($br == 4)
		$branch = "EEE";
	elseif($br == 5)
		$branch = "ECE";
	elseif($br == 9)
		$branch = "MECH";
	//echo $branch." ".$sem." ".$batch;
	$stbatch = $batch - 4;
	$batch = $stbatch."-".$batch;

	/*$sel_batch="select * from batch_master where batch_name='".$batch."'";
			$res_batch=mysql_query($sel_batch) or die(mysql_error());
			$batch_combo=mysql_fetch_array($res_batch);

	$sel_sem="select * from semester_master where sem_name='".$sem."'";
			 $res_sem=mysql_query($sel_sem) or die(mysql_error());
			 $sem_combo=mysql_fetch_array($res_sem);

	$sel_b="select * from branch_master where b_name='".$branch."'";
			$res=mysql_query($sel_b) or die(mysql_error());
			$b_combo=mysql_fetch_array($res);

	$sel_fac="select distinct fm.f_id, fm.f_name, fm.l_name from faculty_master as fm, subject_master as sm where fm.b_id='".$b_combo['b_id']."' and sm.batch_id='".$batch_combo['batch_id']."' and fm.f_id=sm.f_id and sm.sem_id=".$sem_combo['sem_id'];
			 $res_fac=mysql_query($sel_fac) or die(mysql_error());

			 echo json_encode(mysql_fetch_assoc($res_fac));*/

	$sel_b="select * from branch_master where b_name='".$branch."'";
			$res=mysql_query($sel_b) or die(mysql_error());
			$b_combo=mysql_fetch_array($res);
			//echo $b_combo[0];

	/*$sel_fac = "select * from faculty_master where `b_id`=".$b_combo[0];
		$res_fac = mysql_query($sel_fac) or die(mysql_error());
		$fac_combo=mysql_fetch_array($res_fac);

		echo json_encode($fac_combo);
*/


}else{
	echo json_encode(['status'=>FALSE]);
}

?>