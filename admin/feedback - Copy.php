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
<script src="php_calendar/scripts.js" type="text/javascript"></script>
<title>Feedback</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
</head>

<body>

<?php
/*if(isset($_POST['Reset']))
{
	$b_name='';
	$fac_nam='';
	$sem_name='';
	$sub_name='';
}*/
if(isset($_POST['Submit']) || isset($_POST['xls_file']))
{	$query_string='';
	if(isset($_POST['b_name']))
	{
		$query_string.=" b_id='".$_POST['b_name']."' and";
		$b_name=$_POST['b_name'];
	}
	if(isset($_POST['batch_name']))
	{
		$query_string.=" batch_id='".$_POST['batch_name']."' and";
		$batch_name=$_POST['batch_name'];
	}
	if(isset($_POST['division']))
	{
		$query_string.=" division_id='".$_POST['division']."' and";
		$division=$_POST['division'];
	}
	if(isset($_POST['feedback_no']))
	{
		$query_string.=" feedback_no='".$_POST['feedback_no']."' and";
		$feedback_no=$_POST['feedback_no'];
	}
	if(isset($_POST['fac_name']))
	{
		$query_string.=" f_id='".$_POST['fac_name']."' and";
		$fac_name=$_POST['fac_name'];
	}
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
	//echo $slq_search;exit; 	
	$res_search=mysql_query($slq_search) or die(mysql_error());
	if($_POST['query_set']=='1')
	{
		$file_name=write_xls($slq_search);				
	}
}
else
{
	$slq_search="select * from feedback_master order by feed_date asc";
	//echo $sql_search;
	$res_search=mysql_query($slq_search) or die(mysql_error());
}

?>
<table width="67%" align="center" border="0" cellpadding="0" cellspacing="1">
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="14%" bgcolor="#FFFFFF" valign="top">
<?php include('left_side.php');?>
</td>

<td width="86%" align="center" valign="top">
<table align="center" width="100%">
<tr><td colspan="3">
<form name="feedback_form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" onsubmit="return chkForm();">
<table width="100%" cellpadding="2" cellspacing="6">
        <!--<tr>
		  <td width="116">Date</td>
          <td width="166"><label>
            <input type="text" name="date" id="date" readonly tabindex="2"/><a href="javascript:viewcalendar()">cal</a>
          </label></td>
          <td width="118">&nbsp;</td>
          <td width="95">&nbsp;</td>
          <td width="166">&nbsp;</td>
        </tr>-->
        <tr>
          <td align="left">Branch </td>
          <td align="left"><label>
            <?
			$sel_b="select * from branch_master";
			$res=mysql_query($sel_b) or die(mysql_error());
			
			 while($b_combo=mysql_fetch_array($res))
			 {							
				$branch_combo[] = array('id' => $b_combo['b_id'],
									    'text' => $b_combo['b_name']);								  
			 }
			 if(isset($b_name))
			  $default=$b_name;
			 else
			 	$default='';
			 
			 //echo tep_draw_pull_down_menu('b_name',$branch_combo,$default,' tabindex="3" ');
			 
    	    $sel_para="select * from feedback_para";
			$res_para=mysql_query($sel_para) or die(mysql_error());
			$result_para=mysql_fetch_array($res_para);
			?>
			<input type="hidden" name="b_name" value="<?php echo $result_para['b_id']?>"/>
			<?php echo branch_name($result_para['b_id']);?>
            
          </label></td>
          <td>&nbsp;</td>
          <td align="left">Semester</td>
          <td align="left">
		  <?
			 $sel_sem="select * from semester_master ";
			 $res_sem=mysql_query($sel_sem) or die(mysql_error());
			
			 while($sem_combo=mysql_fetch_array($res_sem))
			 {							
				$sem_array[] = array('id' => $sem_combo['sem_id'],
									  'text' => $sem_combo['sem_name']);								  
			 }
			 if(isset($sem_name))
			  $default=$sem_name;
			 else
			  $default='';
			 //echo tep_draw_pull_down_menu('sem_name',$sem_array,$default,' tabindex="4" ');
	      ?>	
		  <input type="hidden" name="sem_name" value="<?php echo $result_para['sem_id']?>"/>
		  <?php echo sem_name($result_para['sem_id']);?>
		  </td>
        </tr>
        <tr>
          <td align="left">Batch</td>
          <td align="left"><?
			$sel_batch="select * from batch_master";
			$res_batch=mysql_query($sel_batch) or die(mysql_error());
			
			 while($batch_combo=mysql_fetch_array($res_batch))
			 {							
				$bat_combo[] = array('id' => $batch_combo['batch_id'],
									   'text' => $batch_combo['batch_name']);								  
			 }
			 if(isset($batch_name))
			  $default=$batch_name;
			 else
			 	$default='';
			 
			 //echo tep_draw_pull_down_menu('batch_name',$bat_combo,$default,' tabindex="3" ');
			 
			?>
			<input type="hidden" name="batch_name" value="<?php echo $result_para['batch_id']?>"/>
			<?php echo batch_name($result_para['batch_id']);?>
			</td>
			<td>&nbsp;</td>
			<td align="left">Division</td>
          <td align="left"><?
			$sel_div="select * from division_master";
			$res_div=mysql_query($sel_div) or die(mysql_error());
			
			 while($div_combo=mysql_fetch_array($res_batch))
			 {							
				$division_combo[] = array('id' => $div_combo['id'],
									      'text' => $div_combo['division']);								  
			 }
			 if(isset($division))
			  $default=$division;
			 else
			 	$default='';
			 
			 //echo tep_draw_pull_down_menu('division',$division_combo,$default,' tabindex="3" ');
			 
			?>
			<input type="hidden" name="division" value="<?php echo $result_para['division_id']?>"/>
			<?php echo division_name($result_para['division_id']);?>
			</td>                    
        </tr>
		<tr>
		<td align="left">Feedback Number</td>
          <td align="left">
		  <?
			if(isset($feedback_no) && $_POST['feedback_no']==1)
			{	$one='selected="selected"';$two='';}
			elseif(isset($feedback_no) && $_POST['feedback_no']==2)
			{	$two='selected="selected"';$one='';}
			else
			{	$one='';$two='';}
		 ?>
		  <select name="feedback_no">
		  <option value="1" <?php echo $one?>>1</option>
		  <option value="2" <?php echo $two?>>2</option>
		  </select></td>
		</tr>
        <tr>
          <td align="left">Faculty Name </td>
          <td align="left"><label>
            <?
			 //$sel_fac="select * from faculty_master where b_id='".$result_para['b_id']."'";
			 $sel_fac="select distinct fm.f_id, fm.f_name,fm.l_name from faculty_master as fm, subject_master as sm where fm.b_id='".$result_para['b_id']."' and fm.f_id=sm.f_id and sm.sem_id=".$result_para['sem_id'];
			 $res_fac=mysql_query($sel_fac) or die(mysql_error());
			
			 while($fac_combo=mysql_fetch_array($res_fac))
			 {							
				$fac_array[] = array('id' => $fac_combo['f_id'],
									  'text' => $fac_combo['f_name'].'&nbsp;'.$fac_combo['l_name']);								  
			 }
			 if(isset($fac_name))
			  $default=$fac_name;
			 else
			 	$default='';
			 echo tep_draw_pull_down_menu('fac_name',$fac_array,$default,' tabindex="5" onChange="AjaxFunction(this.value);"');
	      ?>
          </label></td>
          <td>&nbsp;</td>
          <td align="left">Subject Taught </td>
          <td align="left"><label>
            <?
			 //$sel_sub="select * from subject_master ";
			 $sel_sub="select * from subject_master as sm , faculty_master as fm where fm.b_id='".$result_para['b_id']."' and fm.f_id=sm.f_id";
			 $res_sub=mysql_query($sel_sub) or die(mysql_error());
			
			 while($sub_combo=mysql_fetch_array($res_sub))
			 {							
				$sub_array[] = array('id' => $sub_combo['sub_id'],
									  'text' => $sub_combo['sub_name']);								  
			 }
			// print_r($sub_array);// $sub_name;
			 if(isset($sub_id))
			 { $def=$sub_id;}
			 else
			 {	$def='';}
			 //echo $def;
			 echo tep_draw_pull_down_menu_sub('sub_name', $sub_array, $def, ' tabindex="6" ');
	      ?>
		  <!--<select name=sub_name>

          </select>-->
          </label></td></tr>
		  <tr><td colspan="5">&nbsp;</td></tr>
		  <tr>
		  <td colspan="5" align="left">
		  		<input class="button" type="submit" name="Submit" value="Submit" />
		  		<input class="button" type="button" value="Reset" onclick="location.href='<?php echo $_SERVER['PHP_SELF']?>'"> 			
		 
			  <script language="javascript" type="text/javascript">
				function call_overall_graph(encoded_sql_query)
				{	
					url = "graph_img_n_data.php?str=" + encoded_sql_query;
					var win=window.open(url, '_blank');
					win.focus();
				}
				
				function call_que_rating_student_graph(encoded_sql_search_para)
				{
					url = "graph_rating_student_count.php?str=" + encoded_sql_search_para;
					var win=window.open(url, '_blank');
					win.focus();
				}				
			  </script>			 			  	
		  		
			<!--  <input type="submit" name="xls_file" class="button" value="Generate xls file" onclick="javascript: create_xls();" />
					<?php 
					if(isset($_REQUEST['query_set']))
					{
						if($_REQUEST['query_set']=='1')
						{
							echo '<a href="excel_report/'.$file_name.'" target="_blank" class="button">Click Here</a>';
						}
					}
					else
						$file_name='';
			  ?> -->
			  
			  <?php 
			  if(isset($_POST['Submit'])) 
			  { 
			  	echo '<br/>';		  	
				$encoded_sql_query = base64_encode($slq_search); 
		  		$encoded_sql_search_para = base64_encode($query_string);		  
			  ?>
			  	
				
			 <!--  <input class="button" type="button" id="id_overall_graph_button" name="overall_graph_button" value="Avg. report" onclick="javascript:call_overall_graph('<?php echo $encoded_sql_query?>');"/>	-->
			<!--  <input class="button" type="button" id="id_que_rating_student" name="que_rating_student" value="Overall Rating" onclick="javascript:call_que_rating_student_graph('<?php echo $encoded_sql_search_para?>');"/>	-->		  		  
			  <?php } ?>
			  
			<input type="hidden" name="query" value="<?php echo $slq_search?>" />
			<input type="hidden" name="query_set" value="" />
	  	</td>
		</tr>
		<tr><td colspan="5">&nbsp;</td></tr>
</table>
</form>
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
			  
			  //echo "<br><a href=\"read_more.php?newsid=$myrow[newsid]\">Read More...</a>
			  //  || <a href=\"edit_news.php?newsid=$myrow[newsid]\">Edit</a>
			  //   || <a href=\"delete_news.php?newsid=$myrow[newsid]\">Delete</a><br><hr>";
			 }//end of loop
			 
			 
			 echo '<tr><td colspan=11>Total</td></tr>';
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
			 echo '<td align=center>&nbsp;</td>';
			 echo '<td align=center>&nbsp;</td>';
			 echo '</tr>';
		 }
		 else
		 {
		 	 echo '<tr>';
			  echo "<td align=center colspan=11>No Record Found!</td></tr>";
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
		if (RefForm.b_name.value == 0 )
		{
			alert("Select Branch");
			RefForm.b_name.focus();			
			return false;
		}
		if (RefForm.batch_name.value == 0 )
		{
			alert("Select Batch");
			RefForm.batch_name.focus();			
			return false;
		}
		if (RefForm.sem_name.value  == 0 )
		{
			alert("Select Semester");			
			RefForm.sem_name.focus();
			return false;
		}
		if (RefForm.fac_name.value == 0 )
		{
			alert("Select Faculty Name.");			
			RefForm.fac_name.focus();
			return false;
		}
		if (RefForm.sub_name.value == 0 )
		{
			alert("Select Subject");
			RefForm.sub_name.focus();			
			return false;
		}
}
</script>
<script language="javascript" type="text/javascript">
function create_xls()
{
	document.feedback_form.query_set.value='1';	
	return true;
}
</script>
<?
//echo $sql_credit_debit;
 
    function write_xls($sql)
	{
		$sql=str_replace('\\','',$sql);
		$excel=new ExcelWriter('excel_report/'.date('m_d_Y_s').'_feedback_report.xls');
    
		$file_name=date('m_d_Y_s').'_feedback_report.xls';
		
    	 if($excel==false)    
       	 echo $excel->error;
		 
		 $result1=mysql_query($sql) or die(mysql_error());
		 $arr1=mysql_fetch_array($result1);
		
		if(mysql_num_rows($result1)!=0)
		{
			 $myArr=array("Branch",branch_name($arr1['b_id']),"","Semester",sem_name($arr1['sem_id']));
			 $excel->writeLine($myArr);
			 
			 $myArr=array("","","","","","");
			 $excel->writeLine($myArr);
			 
			 $myArr=array("Batch",batch_name($arr1['batch_id']),"","Division",division_name($arr1['division_id']),"","Feedback No",$arr1['feedback_no']);
			 $excel->writeLine($myArr);
			 
			 $myArr=array("","","","","","");
			 $excel->writeLine($myArr);
			 
			 $myArr=array("Faculty Name:",faculty_name($arr1['f_id']),"","Subject:",subject_name($arr1['sub_id']));
			 $excel->writeLine($myArr);
			 
			 $myArr=array("","","","","","");
			 $excel->writeLine($myArr);
			 $myArr=array("","","","","","");
			 $excel->writeLine($myArr);
			 			 			 			
			/*$myArr=array("Remark(s)");//"Ans1","Ans2","Ans3","Ans4","Ans5","Ans6","Ans7","Ans8","Ans9"
			$excel->writeLine($myArr);
			$myArr=array("","","","","","");
			$excel->writeLine($myArr);*/
			
			$myArr=array("Ans1","Ans2","Ans3","Ans4","Ans5","Ans6","Ans7","Ans8","Ans9","Remark");
   		    $excel->writeLine($myArr);
			
			$result=mysql_query($sql) or die(mysql_error());
			$total_ids="0";
						
			$r_id=1;
				
			while($arr=mysql_fetch_array($result))
			{							
					/*if($arr['remark']!=NULL)
					{	
						$myArr=array(strtolower($arr['remark']));				
						$excel->writeLine($myArr);
						$r_id++;			
					}*/
									 
					$myArr=array($arr['ans1'],$arr['ans2'],$arr['ans3'],$arr['ans4'],$arr['ans5'],$arr['ans6'],$arr['ans7'],$arr['ans8'],$arr['ans9'],$arr['remark']);
					$excel->writeLine($myArr);
					$r_id++;						
			}			
			
			$myArr=array("","","","","","");
			$excel->writeLine($myArr);	
					
			$excel->close();
			return $file_name;	
		}
		else
		{
			echo '<p align=center>No Record Found!.</p>';
		}
	}

?>
