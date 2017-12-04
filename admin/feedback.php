<?php 
	
	  include('session_chk.php');
	  include("includes/config_db.php");
	  include("xls.php");
	  include("ajax_script.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Feedback</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
<link rel="icon" type="image/png" href="../images/uiet.png" />
</head>

<body>
<?php
	$query = "select * from faculty_master where mem_id=".$mem_id;
	//echo $query;
	$res = mysql_query($query) or die(mysql_error());
	$result = mysql_fetch_array($res);

	if(isset($_POST['sub_name']))
		  	{
		  		$default_sub=$_POST['sub_name'];
				$sel_sub="select * from subject_master where sub_id=".$default_sub;
			    $res_sub=mysql_query($sel_sub) or die(mysql_error());
			    $sub_combo=mysql_fetch_array($res_sub); 

			    $sel_b="select * from branch_master where b_id=".$result['b_id'];
				$res_b=mysql_query($sel_b) or die(mysql_error());
				$b_combo=mysql_fetch_array($res_b);

				$default_sem=$_POST['sem_name'];
				$sel_sem="select * from semester_master where sem_id=".$default_sem;
			    $res_sem=mysql_query($sel_sem) or die(mysql_error());
			    $sem_comb=mysql_fetch_array($res_sem);

			    $b_s = $b_combo['b_name']." - ".$sem_comb['sem_name'];
		  	}
?>
<script type="text/javascript">
	function hide_button(branch,faculty,sem,sub){
		var x = document.getElementById('submit_button');
		var y = document.getElementById('gen_pdf');
		var z = document.getElementById('link_pdf');
		var roll_but = document.getElementById('gen1_pdf');
		var roll = document.getElementById('link_roll');
		x.setAttribute("hidden",true); 
		roll_but.removeAttribute('hidden',true);
		y.removeAttribute("hidden",true);
		var roll_url = "submitted_roll.php";
		roll_url=roll_url+"?branch="+branch;
		roll_url=roll_url+"&faculty="+faculty;
		roll_url=roll_url+"&sem="+sem;
		roll_url=roll_url+"&sub="+sub;
		var hit_url = "f_pdf.php";
		hit_url=hit_url+"?branch="+branch;
		hit_url=hit_url+"&faculty="+faculty;
		hit_url=hit_url+"&sem="+sem;
		hit_url=hit_url+"&sub="+sub;
		hit_url=hit_url+"&f_name="+<?php echo '"'.$result['f_name'].'"'; ?>;
		hit_url=hit_url+"&l_name="+<?php echo '"'.$result['l_name'].'"'; ?>;
		hit_url=hit_url+"&sub_name="+<?php echo '"'.$sub_combo['sub_name'].'"'; ?>;
		hit_url=hit_url+"&b_s="+<?php echo '"'.$b_s.'"'; ?>;
		z.setAttribute("href",hit_url);
		roll.setAttribute("href",roll_url);
}
</script>




<table width="67%" align="center" border="0" cellpadding="0" cellspacing="1">
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="14%" bgcolor="#FFFFFF" valign="top">
<?php include('left_side.php');?>
</td>

<td width="86%" align="center" valign="top">
<table align="center" width="100%">
<tr><td colspan="3">
<form name="feedback_form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">

<table width="100%" cellpadding="2" cellspacing="6">
        
        <tr>
          <td align="left">Branch </td>
          <td align="left"><label>
			<input type="hidden" name="b_name" value="<?php echo $result['b_id'];?>"/>
			<?php echo $b_combo['b_name'];?>
            
          </label></td>
          <td>&nbsp;</td>
          <td align="left">Semester</td>
          <td align="left">
		  <?php
			 $sel_sem="select * from semester_master order by sem_name ASC";
			 $res_sem=mysql_query($sel_sem) or die(mysql_error());
			
			 while($sem_combo=mysql_fetch_array($res_sem))
			 {							
				$sem_array[] = array('id' => $sem_combo['sem_id'],
									  'text' => $sem_combo['sem_name']);								  
			 }
			 if(isset($_POST['sem_name']))
			    echo $sem_comb['sem_name'];
			 else
			  {$default='';
			    echo tep_draw_pull_down_menu('sem_name',$sem_array,$default,' tabindex="4" onChange="AjaxFunction(this.value,'.$result["f_id"].');"');
			}
	      ?>	
		  </td>
        </tr>
        <tr>
          <td align="left">Faculty Name </td>
          <td align="left">
          <input type="hidden" name="fac_name" value="<?php echo $result['f_id'] ?>">
          	<?php echo strtoupper($result['f_name'])." ".strtoupper($result['l_name']); ?>
          </td>
          <td>&nbsp;</td>
          <td align="left">Subject Taught </td>
          <td align="left"><label>
           <?php 
           if(isset($_POST['sub_name']))
		  		echo $sub_combo['sub_name'];
		   else
		   	echo '<select name=sub_name></select>';
          ?>
          </label></td></tr>
		  <tr><td colspan="5">&nbsp;</td></tr>
		  <tr>
		  <td colspan="5" align="left">
		  		<input id="submit_button" class="button" type="submit" name="Submit" value="Submit"  onclick="return chkForm();"/>
		  		<input class="button" type="button" value="Reset" onclick="location.href='<?php echo $_SERVER['PHP_SELF']?>'"> 			
		 		<a id="link_pdf" target="_blank"><input id="gen_pdf" type="button" name="pdf_file" class="button" value="Generate PDF file" hidden /></a>
		 		<a id="link_roll" target="_blank"><input id="gen1_pdf" type="button" name="pdf_file" class="button" value="Submitted Feedback" hidden /></a>
		 		
	  	</td>
		</tr>
		<tr><td colspan="5">&nbsp;</td></tr>
</table>
</form>
<?php
if(isset($_POST['Submit']))
{	$query_string='';
	if(isset($_POST['b_name']))
	{
		$query_string.=" b_id='".$_POST['b_name']."' and";
		$b_name=$_POST['b_name'];
	}
	
	$query_string.=" f_id='".$result['f_id']."' and";
	
	if(isset($_POST['sem_name']))
	{
		$query_string.=" sem_id='".$_POST['sem_name']."' and";
		$sem_name=$_POST['sem_name'];
	}
	if(isset($_POST['sub_name']))
	{
		$query_string.=" sub_id='".$_POST['sub_name']."' ";
		$sub_id=$_POST['sub_name'];
	}
	$slq_search="select * from feedback_master where (".$query_string.")";
	$res_search=mysql_query($slq_search) or die(mysql_error());

	echo '<script>window.onload=hide_button('.$_POST['b_name'].','.$result['f_id'].','.$_POST['sem_name'].','.$_POST['sub_name'].');</script>';
}
else
{
	$slq_search="select * from feedback_master where f_id=".$result['f_id']." order by feed_date asc";
	//echo $sql_search;
	$res_search=mysql_query($slq_search) or die(mysql_error());
}

?>
</td>
</tr></table>
<table width="480px"><tr><td align=right>Number of Records:- <?php echo mysql_num_rows($res_search);?></td></tr></table>
<table id="rounded-corner"  border="0" align="center" cellpadding="0" cellspacing="0" >
<thead>
<tr>
	<!--<th scope="col" class="rounded-company" align="center">Roll No</th>-->
	<th scope="col" class="rounded-company" align="center">Ans1</th>
	<th scope="col" class="rounded-q1" align="center">Ans2</th>
	<th scope="col" class="rounded-q2" align="center">Ans3</th>
	<th scope="col" class="rounded-q3" align="center">Ans4</th>
	<th scope="col" class="rounded-q3" align="center">Ans5</th>
	<th scope="col" class="rounded-q3" align="center">Ans6</th>
	<th scope="col" class="rounded-q3" align="center">Ans7</th>
	<th scope="col" class="rounded-q3" align="center">Ans8</th>
	<th scope="col" class="rounded-q3" align="center">Ans9</th>
	<th scope="col" class="rounded-q3" align="center">Ans10</th>
	<th scope="col" class="rounded-q3" align="center">Ans11</th>
	<th scope="col" class="rounded-q3" align="center">Ans12</th>
	<th scope="col" class="rounded-q3" align="center">Ans13</th>
	<th scope="col" class="rounded-q3" align="center">Ans14</th>
	<th scope="col" class="rounded-q3" align="center">Ans15</th>
	<th scope="col" class="rounded-q3" align="center">Ans16</th>
	<th scope="col" class="rounded-q3" align="center">&nbsp;</th>
	<th scope="col" class="rounded-q4" align="center">Subject</td>
	<!--<th scope="col" class="rounded-q4" align="center">Edit / Delete</th>-->
</tr>
</thead>

<?php
		if(mysql_num_rows($res_search)!=0)
		{
			$total_ans1=0;
			$total_ans2=0;
			$total_ans3=0;
			$total_ans4=0;
			$total_ans5=0;
			$total_ans6=0;
			$total_ans7=0;
			$total_ans8=0;
			$total_ans9=0;
			$total_ans10=0;
			$total_ans11=0;
			$total_ans12=0;
			$total_ans13=0;
			$total_ans14=0;
			$total_ans15=0;
			$total_ans16=0;
		    $i=0; 
			 while($myrow = mysql_fetch_array($res_search))
			 {
			   //now print the results:
			   echo '<tr>';
			   echo "<!--<td align=center>".$myrow['roll_no']."</td>-->";
			   $i++;
			   echo "<td align=center>".$myrow['ans1']."</td>";
			   echo "<td align=center>".$myrow['ans2']."</td>";
			   echo "<td align=center>".$myrow['ans3']."</td>";
			   echo "<td align=center>".$myrow['ans4']."</td>";
			   echo "<td align=center>".$myrow['ans5']."</td>";
			   echo "<td align=center>".$myrow['ans6']."</td>";
			   echo "<td align=center>".$myrow['ans7']."</td>";
			   echo "<td align=center>".$myrow['ans8']."</td>";
			   echo "<td align=center>".$myrow['ans9']."</td>";
			   echo "<td align=center>".$myrow['ans10']."</td>";
			   echo "<td align=center>".$myrow['ans11']."</td>";
			   echo "<td align=center>".$myrow['ans12']."</td>";
			   echo "<td align=center>".$myrow['ans13']."</td>";
			   echo "<td align=center>".$myrow['ans14']."</td>";
			   echo "<td align=center>".$myrow['ans15']."</td>";
			   echo "<td align=center>".$myrow['ans16']."</td>";
			   echo "<td align=center>".($myrow['remark']!=''?'<a href="javascript: void(0)" 
	onclick="window.open(\'popup.php?feed_id='.$myrow['feed_id'].'\',\'windowname1\',\'width=200, height=77\');return false;" class="button">Remark</a>':'&nbsp;')."</td>";
			   echo "<td align=center>".subject_name($myrow['sub_id'])."</td>";
			   echo "<!--<td align=center>"."<a href=\"edit_branch.php?b_id=$myrow[b_id]\">edit</a> /"."<a href=\"delete_branch.php?b_id=$myrow[b_id]\">delete</a>"."</td>-->";
			  echo '</tr>';  
			  
			  $total_ans1=$total_ans1 + $myrow['ans1'];
			  $total_ans2=$total_ans2 + $myrow['ans2'];
			  $total_ans3=$total_ans3 + $myrow['ans3'];
			  $total_ans4=$total_ans4 + $myrow['ans4'];
			  $total_ans5=$total_ans5 + $myrow['ans5'];
			  $total_ans6=$total_ans6 + $myrow['ans6'];
			  $total_ans7=$total_ans7 + $myrow['ans7'];
			  $total_ans8=$total_ans8 + $myrow['ans8'];
			  $total_ans9=$total_ans9 + $myrow['ans9'];
			  $total_ans10=$total_ans10 + $myrow['ans10'];
			  $total_ans11=$total_ans11 + $myrow['ans11'];
			  $total_ans12=$total_ans12 + $myrow['ans12'];
			  $total_ans13=$total_ans13 + $myrow['ans13'];
			  $total_ans14=$total_ans14 + $myrow['ans14'];
			  $total_ans15=$total_ans15 + $myrow['ans15'];
			  $total_ans16=$total_ans16 + $myrow['ans16'];
			  
			  //echo "<br><a href=\"read_more.php?newsid=$myrow[newsid]\">Read More...</a>
			  //  || <a href=\"edit_news.php?newsid=$myrow[newsid]\">Edit</a>
			  //   || <a href=\"delete_news.php?newsid=$myrow[newsid]\">Delete</a><br><hr>";
			 }//end of loop
			 
			 
			 echo '<tr><td colspan=18>Total</td></tr>';
			 echo '<tr>';
			 echo '<td align=center>'.$total_ans1.'</td>';
			 echo '<td align=center>'.$total_ans2.'</td>';
			 echo '<td align=center>'.$total_ans3.'</td>';
			 echo '<td align=center>'.$total_ans4.'</td>';
			 echo '<td align=center>'.$total_ans5.'</td>';
			 echo '<td align=center>'.$total_ans6.'</td>';
			 echo '<td align=center>'.$total_ans7.'</td>';
			 echo '<td align=center>'.$total_ans8.'</td>';
			 echo '<td align=center>'.$total_ans9.'</td>';
			 echo '<td align=center>'.$total_ans10.'</td>';
			 echo '<td align=center>'.$total_ans11.'</td>';
			 echo '<td align=center>'.$total_ans12.'</td>';
			 echo '<td align=center>'.$total_ans13.'</td>';
			 echo '<td align=center>'.$total_ans14.'</td>';
			 echo '<td align=center>'.$total_ans15.'</td>';
			 echo '<td align=center>'.$total_ans16.'</td>';
			 echo '<td align=center>&nbsp;</td>';
			 echo '<td align=center>&nbsp;</td>';
			 echo '</tr>';
		 }
		 else
		 {
		 	 echo '<tr>';
			  echo "<td align=center colspan=18>No Record Found!</td></tr>";
		 }
?>
</table>
</td>
</tr>
</table>
</body>
</html>
<script language="javascript" type="text/javascript">
function chkForm(form)
{
		var RefForm = document.feedback_form;				
		
		
		if (RefForm.sem_name.value  == 0 )
		{
			alert("Select Semester");			
			RefForm.sem_name.focus();
			return false;
		}
		
		if (RefForm.sub_name.value == 0 )
		{
			alert("No Subject for this Semester.");
			RefForm.sub_name.focus();			
			return false;
		}
}
</script>