<?php
require('session_chk.php');

	$branch = $_REQUEST['branch'];
	$faculty = $_REQUEST['faculty'];
	$sem = $_REQUEST['sem'];
	$sub = $_REQUEST['sub'];

	$query = "SELECT `roll_no` FROM `feedback_master` WHERE `b_id` = $branch AND `sub_id` = $sub AND `sem_id` = $sem AND `f_id` = $faculty	 ORDER BY `roll_no` ASC";
    $res = mysql_query($query) or die(mysql_error());
    ?>
    <!DOCTYPE html>
    <html>
    <head>
    	<title>Submitted Roll No</title>
    	<style>
			table {
			    font-family: arial, sans-serif;
			    border-collapse: collapse;
			    width: 100%;
			}

			td, th {
			    border: 1px solid #dddddd;
			    text-align: left;
			    padding: 8px;
			}

			tr:nth-child(even) {
			    background-color: #dddddd;
			}
		</style>
    </head>
    <body>
    	<table>
		  <tr>
		    <th>Submitted Roll</th>
		  </tr>
		   <?php
				while($row_roll=mysql_fetch_array($res))
				{
					echo "<tr>";
					echo "<td>".strtoupper($row_roll['roll_no'])."<td>";
					echo "</tr>";
				}
			?>
		</table>
    	
    </body>
    </html>
   
