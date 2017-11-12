<?php
include("includes/config_db.php");
include("ajax_script.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Student Feedback System</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
<link rel="icon" type="image/png" href="images/uiet.png" />
</head>

<body class="body">
<?php
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
}
else{
	header("Location: index.php");
}

?>
<table width="650" height="561"  border="0" align="center" cellpadding="5" cellspacing="5" >
  
  <tr>
    <td width="650"  valign="bottom" align="center"><p><b><font size="5" >Student Feedback System</font></b></p></td>
  </tr>
  <tr>
    <td width="650" height="126" valign=top>
	<form action="submit_feedback.php" method="post" name="feedback_form" onsubmit="return chkForm();">
      <table width="711" border="0" align="center">       
        <tr>
		  <td width="161"><b>Batch</b></td>
		  <td width="173"><label>
            <?php
			$sel_batch="select * from batch_master where batch_name='".$batch."'";
			$res_batch=mysql_query($sel_batch) or die(mysql_error());
			$batch_combo=mysql_fetch_array($res_batch);
	    //////////////////////////////To be remove
			$sel_para="select * from feedback_para";
			$res_para=mysql_query($sel_para) or die(mysql_error());
			$result_para=mysql_fetch_array($res_para);
		/////////////////////////////	
			?>
            <input type="hidden" name="batch_name" value="<?php echo $batch_combo['batch_id']?>"/>
			<?php echo $batch_combo['batch_name'];?>
          </label>
		</td>
		  <td>&nbsp;</td>
          <td><b>Branch</b> </td>
          <td><label>
            <?php
			$sel_b="select * from branch_master where b_name='".$branch."'";
			$res=mysql_query($sel_b) or die(mysql_error());
			$b_combo=mysql_fetch_array($res);
			?>
            <input type="hidden" name="b_name" value="<?php echo $b_combo['b_id']?>"/>
			<?php echo $b_combo['b_name'];?>
          </label></td>
          
          			          
        </tr>
		
		<tr>
		<td><b>Semester</b></td>
          <td>
		  <?php
			 $sel_sem="select * from semester_master where sem_name='".$sem."'";
			 $res_sem=mysql_query($sel_sem) or die(mysql_error());
			 $sem_combo=mysql_fetch_array($res_sem);
	      ?>
		  <input type="hidden" name="sem_name" value="<?php echo $sem_combo['sem_id']?>"/>
			<?php echo $sem_combo['sem_name'];?>
		  	</td>
		<td>&nbsp;</td>
		<td><b>Student ID</b></td>
        <td>
		  <?php
			 $sel_div="select * from division_master ";
			 $res_div=mysql_query($sel_div) or die(mysql_error());
			
			 while($div_combo=mysql_fetch_array($res_div))
			 {							
				$div_array[] = array('id' => $div_combo['id'],
									  'text' => $div_combo['division']);								  
			 }
			 
			// echo tep_draw_pull_down_menu('division',$div_array, $default,' tabindex="4" ');
	      ?>
	      <input type="hidden" name="roll_no" value="<?php echo $roll; ?>">
		  <input type="hidden" name="division" value="1"/>
			<?php echo strtoupper($roll);?>
		</td>
		</tr>
        <tr>
          <td><b>Faculty Name</b> </td>
          <td><label>
            <?php
			 $sel_fac="select distinct fm.f_id, fm.f_name, fm.l_name from faculty_master as fm, subject_master as sm where fm.b_id='".$b_combo['b_id']."' and sm.batch_id='".$batch_combo['batch_id']."' and fm.f_id=sm.f_id and sm.sem_id=".$sem_combo['sem_id'];
			 $res_fac=mysql_query($sel_fac) or die(mysql_error());
			
			 while($fac_combo=mysql_fetch_array($res_fac))
			 {							
				$fac_array[] = array('id' => $fac_combo['f_id'],
									 'text' => strtoupper($fac_combo['f_name']).'&nbsp;'.strtoupper($fac_combo['l_name']));								  
			 }
			 $default = 1;
			 echo tep_draw_pull_down_menu('fac_name', $fac_array, $default,' tabindex="5" onChange="AjaxFunction(this.value,'.$batch_combo['batch_id'].','.$sem_combo['sem_id'].');"');
	      ?>
          </label></td>
          <td>&nbsp;</td>
          <td><b>Subject Taught </b></td>
          <td><label>
		  <select name=sub_name>

          </select>
          </label></td>
        </tr>
		<tr><td>&nbsp;</td></tr>
		
		<tr>
          <td colspan="5">
		  <table width="100%" id="rounded-corner" cellpadding="10" cellspacing="0" border="0" align="center">
		  <thead>
		  <tr >
		     <th width="8%" class="rounded-company" align="center">ID</th>			 
			 <th width="86%" class="rounded-q1" align="center">Questions</th>
			 <th width="6%" class="rounded-q4">&nbsp;</th>
		  </tr>
		  <tr>
          <td colspan="5" align="center"><b><font size="3.5" color="green" >Note: Enter Rating from 1 to 5 (1-strongly disagree, 2-disagree, 3-neither agree nor disagree, 4-agree, 5-strongly agree) </b></font></td>
        	</tr>
		  </thead>
		  <tbody>
		  <?php
		  	$sql_que="select * from feedback_ques_master";
			$res_que=mysql_query($sql_que) or die(mysql_error());
			$i=1;
			$tab_ind=7;
			while($row_que=mysql_fetch_array($res_que))
			{
				echo "<tr class='question'>";
				echo "<td align=\"center\">".$i."</td>";
				echo "<td>".$row_que['ques']."</td>";
				echo "<td> <input type=\"number\" name=\"ans_$i\" size=\"3\" onkeypress=\"return isNumberOnly(event);\" maxlength=\"1\" tabindex=\"$tab_ind\" min=\"1\" max=\"5\" required/></td>";$tab_ind++;
				echo "</tr>";$i++;
			}
		  ?>	
		  
		  <tr>
				<td align="center"></td>
		
				<td><br><strong><font size="3.5" color="green">Note : Choose options from 1-4 and fill the text box with the appropriate option</strong><br><br>
				
			
			</td><td></td>
		</tr>
			<tr class='question'>
				<td align="center">11</td>
		
				<td><br><strong>Course Content :</strong><br><br>
				
				1. Can be covered in 1 semester<br><br>
				2. Too much to be adequately covered in one semester <br><br>
				3. Not enough for one semester<br><br>
				4. Difficult to comment<br>
				<br><td><input type="number" min="1" max="4" required name="ans_11" size="3" onkeypress="return isNumberOnly1(event);" maxlength="1"></td>
				
			</td>
		</tr>
		
		<tr class='question'>
				<td align="center">12</td>
		
				<td><br><strong>Relevance of the course in the overall structure of program :</strong><br><br>
				
				1. Very relevant<br><br>
				2. Reasonably relevant <br><br>
				3. Not at all relevant<br><br>
				4. Difficult to comment<br>
				<br><td><input type="number" min="1" max="4" required name="ans_12" size="3" onkeypress="return isNumberOnly1(event);" maxlength="1"></td>
				
			</td>
		</tr>
		
				<tr class='question'>
				<td align="center">13</td>
		
				<td><br><strong>Overlap with other courses :</strong><br><br>
				
				1. No overlap<br><br>
				2. Some overlap  <br><br>
				3. Repetition of several topics<br><br>
				4. Difficult to comment<br>
				<br><td><input type="number" min="1" max="4" required name="ans_13" size="3" onkeypress="return isNumberOnly1(event);" maxlength="1"></td>
				
			</td>
		</tr>
		
		<tr class='question'>
				<td align="center">14</td>
		
				<td><br><strong>Recommended reading material was:</strong><br><br>
				
				1. Adequate and relevant<br><br>
				2. To some extent adequate and relevant  <br><br>
				3. Mostly inadequate<br><br>
				4. Cannot comment<br>
				<br><td><input type="number" min="1" max="4" required name="ans_14" size="3" onkeypress="return isNumberOnly1(event);" maxlength="1"></td>
				
			</td>
		</tr>
		
		<tr class='question'>
				<td align="center">15</td>
		
				<td><br><strong>Class tests/mid-semester tests were conducted:</strong><br><br>
				
				1. As per schedule and satisfactory<br><br>
				2. Never  <br><br>
				3. In an unsatisfactory manner<br><br>
				4. But were inadequate<br>
				<br><td><input type="number" min="1" max="4" required name="ans_15" size="3" onkeypress="return isNumberOnly1(event);" maxlength="1"></td>
				
			</td>
		</tr>
		
		<tr class='question'>
				<td align="center">16</td>
		
				<td><br><strong>The class tests/mid-semester tests were:</strong><br><br>
				
				1. Difficult<br><br>
				2. Easy  <br><br>
				3. Balanced<br><br>
				4. Out of syllabus<br>
				<br><td><input type="number" min="1" max="4" required name="ans_16" size="3" onkeypress="return isNumberOnly1(event);" maxlength="1"></td>
				
			</td>
		</tr>
		
		<!--
		<tr>
				<td align="center">12</td>
				<td><br>Course Content<br><br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<br><td> <input type=\"text\" name=\"ans_$i\" size="3" onkeypress=\"return isNumberOnly(event);\" maxlength=\"2\" tabindex=\"$tab_ind\" /></td>
			
			</td>
		</tr>
		<tr>
				<td align="center">13</td>
				<td><br>Course Content<br><br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<br><td> <input type=\"text\" name=\"ans_$i\" size="3" onkeypress=\"return isNumberOnly(event);\" maxlength=\"2\" tabindex=\"$tab_ind\" /></td>
			
			</td>
		</tr>
		<tr>
				<td align="center">14</td>
				<td><br>Course Content<br><br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<br><td> <input type=\"text\" name=\"ans_$i\" size="3" onkeypress=\"return isNumberOnly(event);\" maxlength=\"2\" tabindex=\"$tab_ind\" /></td>
			
			</td>
		</tr>
		<tr>
				<td align="center">15</td>
				<td><br>Course Content<br><br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<br><td> <input type=\"text\" name=\"ans_$i\" size="3" onkeypress=\"return isNumberOnly(event);\" maxlength=\"2\" tabindex=\"$tab_ind\" /></td>
			
			</td>
		</tr>
		<tr>
				<td align="center">16</td>
				<td><br>Course Content<br><br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<input type="radio" name="option">Can be covered in 1 semester<br>
				<br><td> <input type=\"text\" name=\"ans_$i\" size="3" onkeypress=\"return isNumberOnly(event);\" maxlength=\"2\" tabindex=\"$tab_ind\" /></td>
			
			</td>
		</tr>-->
		  <tr class='question'>
		  <td>Remark:</td>
		  <td colspan="2"><textarea name="remark" style="width:900px; height:80px;" onkeypress="return isCharOnly(event);" tabindex="16"></textarea></td>
		  </tr>		  
		  	<tr class='question'>
				<td colspan="2"  class="rounded-foot-left" align="center"><input class="button" type="submit" name="submit" value="Submit" tabindex="17"/>&nbsp;<input type="reset" name="reset" value="Reset" tabindex="18" class="button"/></td>
				<td align="center" class="rounded-foot-right"></td>
			</tr>
			</tbody>			
		  </table>
		  </td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td width="697"  height="1"> 
    <?php include("footer.php");?>
     </td>
  </tr>
  
</table>
</body>
</html>


<SCRIPT LANGUAGE="JavaScript">
<!-- Original:  Mikhail Esteves (miks80@yahoo.com) -->
<!-- Web Site:  http://www.freebox.com/jackol -->

<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->

<!-- Begin
var mikExp = /[$\\@\\!\\\#%\^\&\*\(\)\[\]\+\_\{\}\`\~\=\|]/;
function dodacheck(val) {
var strPass = val.value;
var strLength = strPass.length;
var lchar = val.value.charAt((strLength) - 1);
if(lchar.search(mikExp) != -1) {
var tst = val.value.substring(0, (strLength) - 1);
val.value = tst;
   }
}

//  End -->
</script>

<script language="javascript" type="text/javascript">
function isCharOnly(e)
{
	var unicode=e.charCode? e.charCode : e.keyCode
	//if (unicode!=8 && unicode!=9)
	//{ //if the key isn't the backspace key (which we should allow)
		 //disable key press
		if (unicode==45)
			return true;
		if (unicode>48 && unicode<57) //if not a number
			return false
	//}
}
function isNumberOnly(e)
{
	var unicode=e.charCode? e.charCode : e.keyCode
	if (unicode!=8 && unicode!=9)
	{ //if the key isn't the backspace key (which we should allow)
		 //disable key press
		//if (unicode==45)
		//	return true;
		if (unicode<49||unicode>53) //if not a number
			return false
	}
}
function isNumberOnly1(e) // for 11-16 Question
{
	var unicode=e.charCode? e.charCode : e.keyCode
	if (unicode!=8 && unicode!=9)
	{ //if the key isn't the backspace key (which we should allow)
		 //disable key press
		//if (unicode==45)
		//	return true;
		if (unicode<49||unicode>52) //if not a number
			return false
	}
}
function chkForm(form)
{

		var RefForm = document.feedback_form;
		if (RefForm.roll_no.value.length !=8 )
		{
			alert("Enter Roll Number");	
			RefForm.roll_no.focus();				
			return false;
		}
		
		/*if (RefForm.date.value == '' )
		{
			alert("Enter Date");
			RefForm.date.focus();			
			return false;
		}
		if (RefForm.batch_name.value == 0 )
		{
			alert("Select Batch");
			RefForm.batch_name.focus();			
			return false;
		}
		if (RefForm.b_name.value == 0 )
		{
			alert("Select Branch");
			RefForm.b_name.focus();			
			return false;
		}
		if (RefForm.sem_name.value  == 0 )
		{
			alert("Select Semester");			
			RefForm.sem_name.focus();
			return false;
		}*/
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
		
		for(i=1;i<=9;i++)
		{
			if(eval("document.feedback_form.ans_"+i).value == '')
			{
				alert("Enter rating.");
				eval("document.feedback_form.ans_"+i).focus();	
				return false;
			}
			if(eval("document.feedback_form.ans_"+i).value > 5)
			{
				alert("Enter rating from 1 to 5.");
				eval("document.feedback_form.ans_"+i).focus();	
				return false;
			}
			if(eval("document.feedback_form.ans_"+i).value ==0)
			{
				alert("Enter rating from 1 to 5.");
				eval("document.feedback_form.ans_"+i).focus();	
				return false;
			}
				
		}
		
}
</script>