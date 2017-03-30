<?php 
	 
	  include('session_chk.php');
	  include("includes/config_db.php");
?> 	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Feedback Question</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
</head>

<body>
<table width="57%" align="center" border="0" cellpadding="0" cellspacing="1">
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="22%" valign="top">
<?php include('left_side.php');?>
</td>

<td width="78%" align="center" valign="top">
<?php
if(isset($_POST['submit']))
  {//begin of if($submit).
      // Set global variables to easier names
      
     
	    $q_id = $_POST['q_id'];

		$title =stripcslashes($_POST['ques']);
		$one_word =stripcslashes($_POST['one_word']);
			  
		$result = mysql_query("UPDATE feedback_ques_master SET ques='$title', one_word='$one_word' WHERE q_id='$q_id'");
		
		echo "<b>Question updated Successfully!</b><br>You'll be redirected after (1) Seconds";
        echo "<meta http-equiv=Refresh content=1;url=feed_ques.php>";
		
	
  }//end of if($submit).


  // If the form has not been submitted, display it!
else
  {//begin of else
   $q_id = $_GET['q_id'];
    $result = mysql_query("SELECT * FROM feedback_ques_master WHERE q_id='$q_id' ");
        while($myrow = mysql_fetch_assoc($result))
             {
                $title = $myrow["ques"];
				$one_word = $myrow["one_word"];

      ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
<input type="hidden" name="q_id" value="<?php echo $myrow['q_id']?>">
<table width="283" border="0" cellpadding="3" cellspacing="1">
<tr><td colspan="2" align="center" style="font-size:20px">Update Feedback Question</td></tr>
  <tr>
    <td width="92">Que.&nbsp;<?php echo $q_id;?></td>
    <td width="163">
     <textarea name="ques" style="width:250px; height:60px"><?php echo $title;?></textarea>
    </td>
  </tr>
  <tr>
    <td width="92">One word</td>
    <td width="163">
     <input type="text" name="one_word" id="id_one_word" value="<?php echo $one_word;?>">
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table border="0" width="100%">
	<tr><td> <input type="submit" name="submit" value="Update" class="button"></td><td align="right"><input type="button" name="Back" value="Back"  onclick="javascript: history.go(-1)" class="button" /></td></tr></table>
    </td>
  </tr>
</table>
</form>
    
 <?php
 	}//end of while loop
  }//end of else
?>
<p>&nbsp;</p></td>
</tr>
</table>
</body>
</html>
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
</script>