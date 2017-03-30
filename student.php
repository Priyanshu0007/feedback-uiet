<?php
include("includes/config_db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Student Feedback System</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
<link rel="icon" type="image/png" href="images/uiet.png" />
<style type="text/css">
	body{
		background-color: #c3e8ba;
	}
	#heading{
		font-size: 50px;
		font-family: helvetica;
	}
	#rollno{
		width: 300px;
	    padding: 12px 20px;
	    margin: 8px 0;
	    box-sizing: border-box;
	    border-radius: 10px;
	    background-color: #ffffff;
	    font-size: 20px;
	}
	#submit{
		width: 100px;
	    padding: 12px 20px;
	    margin: 8px 0;
	    box-sizing: border-box;
	    border-radius: 10px;
	    background-color: #53d482;
	    font-family: helvetica;
	    font-size: 20px;
	}
	#submit:hover{
		background-color: #2cb35d;
	}
	#Error{
		font-family: helvetica;
		font-size: 30px;
	}
</style>
</head>
<body>
<center>
<p id="heading"><u>IT FEEDBACK SYSTEM</u></p>

<form name="roll_form" method="post" action="feedback.php" onkeyup="return valid_roll();" onsubmit="show_alert();">

	<input id="rollno" type="text" name="roll" placeholder="Enter Roll no." autocomplete="off">
	<input id="submit" type="submit" name="submit">
	
</form>
<p id="Error"></p>
</center>


<script type="text/javascript">
function valid_roll(){
	var roll = document.roll_form.roll.value;
	var err = document.getElementById("Error");
	if(roll.match(/^([U,u][E,M,e,m][1][3,4,5,6][1,3,4,5,8,9][0,1]\d\d)$/g))
	{
		err.style.color = "rgb(37, 158, 26)";
		err.innerHTML = "&#10004; Hit Submit &#10004;";
		return true;
	}
	else
	{
		err.style.color = "red";
		err.innerHTML = "&#10008; Invalid Roll No. &#10008;";
		return false;
	}
}

function show_alert(){

	if(!valid_roll())
		{alert("Invalid Roll No.");
		 document.roll_form.roll.value = "";
		}
	}

</script>
	
</body>
</html>