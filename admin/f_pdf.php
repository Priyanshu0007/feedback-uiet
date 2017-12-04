<?php
	require('session_chk.php');
	$fname=$_REQUEST['f_name']."_".$_REQUEST['l_name'];
	if((isset($_SESSION['myusername']))&&($_SESSION['myusername']==$fname))
	{
		$branch = $_REQUEST['branch'];
		$faculty = $_REQUEST['faculty'];
		$sem = $_REQUEST['sem'];
		$sub = $_REQUEST['sub'];
		$f_name = $_REQUEST['f_name'];
		$l_name = $_REQUEST['l_name'];
		$sub_name = $_REQUEST['sub_name'];
		$b_s = $_REQUEST['b_s'];

			$query = "SELECT UPPER(roll_no) FROM `feedback_master` WHERE `b_id` = ".$branch." AND `sub_id` = ".$sub." AND `sem_id` = ".$sem." AND `f_id` = ".$faculty. " LIMIT 1,1";
			$res_que=mysql_query($query) or die(mysql_error());
			$base = substr(mysql_fetch_array($res_que)[0],0,5);
	     	?>
	     		<h2> Select Roll No.</h2>
	     		<form action="feedback_pdf.php" method="POST">
	     			<label>Start Roll No : </label>
	     			<select name="str_roll">
	     			<?php
	     				for($i=1;$i<=120;$i++)
	     				{
	     					$val = $base.str_pad($i, 3, "0", STR_PAD_LEFT);
	     					echo "<option value=".$val.">".$val."</option>";
	     				}
	     			?>
	     			</select>
	     			<br>
	     			<br>
	     			<label>End Roll No : </label>
	     			<select name="end_roll">
	     			<?php
	     				for($i=1;$i<=120;$i++)
	     				{
	     					$val = $base.str_pad($i, 3, "0", STR_PAD_LEFT);
	     					echo "<option value=".$val.">".$val."</option>";
	     				}
	     			?>
	     			</select>
	     			<br><br>
	     			<input name="f_name" value="<?=$f_name?>" hidden>
	     			<input name="l_name" value="<?=$l_name?>" hidden>
	     			<input name="branch" value="<?=$branch?>" hidden>
	     			<input name="faculty" value="<?=$faculty?>" hidden>
	     			<input name="sem" value="<?=$sem?>" hidden>
	     			<input name="sub" value="<?=$sub?>" hidden>
	     			<input name="sub_name" value="<?=$sub_name?>" hidden>
	     			<input name="b_s" value="<?=$b_s?>" hidden>
	     			<input type="submit">
	     		</form>
	     	<?php
	}
	else
		header("location:index.php");

?>