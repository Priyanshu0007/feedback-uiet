<?php 
	include('session_chk.php');
?>
<html>
<title><?php
	if(strtolower($_SESSION['myusername'])=='admin')
		echo strtolower("admin");
	else
		echo strtolower($_SESSION['myusername']);
?> | Home</title>
<link rel="stylesheet" type="text/css" href="../includes/style.css" />
<link rel="icon" type="image/png" href="../images/uiet.png" />
<body>
<table width="64%" align="center" border="0" cellpadding="0" cellspacing="1" >
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="22%">
<?php include('left_side.php');?></td>

<td width="78%" valign="top">
<p><br/>
Feedback system:</p>
<?php if(strtolower($_SESSION['myusername'])=='admin') {
	?>
<p>Structure of the institute  </p>
<p>Batch -> Branch -> Faculty -> Subject  </p>
<p>So You can Add/Edit/Delete to Batch, Branch, Semester, Division, Faculty & Subject</p>

<p>Set parameter: Batch -> Brach -> Semester -> Division</p>
<p>To get the result click on &quot;<strong>Feedback</strong>&quot; link.  </p>
<p>Feedback Ques: You can change  by editing it.  </p>
<p>Students will rate the Subject's faculty within the range of 1-5. (1-strongly disagree, 2-disagree, 3-neither agree nor disagree, 4-agree, 5-strongly agree)</p>
<p>You can take backup of your dabatabase.</p></td>
<?php } else { ?>
	<p>To get the result click on &quot;<strong>Feedback</strong>&quot; link.  </p>

<p>Students will rate the Subject's faculty within the range of 1-5. (1-strongly disagree, 2-disagree, 3-neither agree nor disagree, 4-agree, 5-strongly agree)</p>
<p>You can change the password of your account.</p></td>
	<?php } ?>
</tr>
<tr>
  <td>&nbsp;</td>
  <td valign="top">&nbsp;</td>
</tr>
</table>

</body>
</html>