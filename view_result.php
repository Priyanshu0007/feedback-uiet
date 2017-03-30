<?php

include("include/config_db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>I2IT Result</title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
</head>

<body>
<table width="727" height="171" border="0" align="center" cellpadding="5" cellspacing="5" bordercolor="#808080" style="border-collapse: collapse">
  <tr>
    <td width="707"  style="padding: 0" height="16">
    <p align="center"><b><font color="#0000FF" size="5">&nbsp;</font><font size="5" color="#CC3300">Examination
    Results</font></b></td>
  </tr>
  <tr>
    <td width="697"  height="126" valign=top>
	<?php
	    $sql="select * from result_master where roll_no='".$_POST['roll_no']."' and b_id='".$_POST['b_id']."'";
		$res=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_array($res);
		if(mysql_num_rows($res)==1)
		{
	?>
    <table width="247" border="0" align="center" bordercolor="#000000">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Roll No </strong></td>
        <td><?php echo $row['roll_no'];?></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
        <td><strong>Student Name </strong></td>
        <td><?php echo $row['f_name'].'&nbsp;'.$row['l_name'];?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Branch</strong></td>
        <td align="left">
          
		  <?php 
		  $sql="select * from branch_master where b_id=".$row['b_id'];
		  $res=mysql_query($sql) or die(mysql_error());
		  $arr=mysql_fetch_array($res);
		  echo $arr['b_name'];
		  ?>           </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Year</strong></td>
        <td align="left">
		<?php
          echo $row['year'];
         ?>		 </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><b>GPA</b></td>
        <td>
		<?php
		echo $row['gpa'];
		?>		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <!--<input type="submit" name="submit" value="Submit" />
          <input type="reset" name="reset" value="Reset" />-->
          <input type="button" name="Back" value="Back"  onclick="javascript: history.go(-1)" />
        </label></td>
      </tr>
    </table>
	<?php
	    }
		else
		{
		?>
		<table width="100%" align="center" border="0">
		<tr><td align="center">Result Not Found!</td></tr>
		<tr>
        <td align="center"><label>
          <!--<input type="submit" name="submit" value="Submit" />
          <input type="reset" name="reset" value="Reset" />-->
          <input type="button" name="Back" value="Back"  onclick="javascript: history.go(-1)" />
        </label></td>
      </tr>
		</table>
		<?php
		}
	?>	</td>
  </tr>
  <tr>
    <td width="697"  height="1">
      <p align="center"></td>
  </tr>
</table>
</body>
</html>
