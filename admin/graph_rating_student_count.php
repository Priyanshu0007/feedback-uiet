<?php 
	
      include('session_chk.php');
	  include("includes/config_db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Question vise rating v/s student count Report</title>
    <script language="javascript" type="text/javascript" src="includes/js/jquery.js"></script>	
    <script language="javascript" type="text/javascript" src="includes/js/jquery.flot.js"></script>
	<link rel="stylesheet" type="text/css" href="includes/style.css" />
	<script language="javascript" type="text/javascript">
	function showTooltip(x, y, contents) {
		$('<div id="tooltip">' + contents + '</div>').css( {
			position: 'absolute',
			display: 'none',
			top: y + 5,
			left: x + 5,
			border: '1px solid #fdd',
			padding: '2px',
			'background-color': '#fee',
			opacity: 0.80
		}).appendTo("body").fadeIn(200);
	}
	</script>
</head>

<body>
<table width="85%" align="center" border="0" cellpadding="0" cellspacing="1">
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="14%" bgcolor="#FFFFFF" valign="top">
<?php include('left_side.php');?>
</td>

<td width="86%" align="center" valign="top">

<table align="center" width="100%">
<tr>
<td colspan="3">
<?php
	error_reporting( error_reporting() & ~E_NOTICE );
    $search_para_str = base64_decode( $_GET['str'] ); 
	//echo $search_para_str;	  
	           	  	
	//for question 1 								
	$sql_query_q1 = 'select ans1, count(*), b_id, batch_id, sem_id, division_id, f_id, sub_id from feedback_master where ('. $search_para_str .') group by ans1 order by ans1';		
	//print $sql_query_q1;
	$res = mysql_query($sql_query_q1) or die(mysql_error('sql error'));							  																	
	$i = 0;	
	$data_array = array();			
	while($myrow=mysql_fetch_array($res))
	{	  
		  // $myrow["ans1"] = rating 
		  // $myrow[1] = student count		  	  	
		  $data_array[$myrow["ans1"]] = $myrow[1];		    		 		  		  
		  if($i == 0)
		  {
				$branch_name = branch_name($myrow['b_id']);
				$batch_name = batch_name($myrow['batch_id']);
				$sem_name = sem_name($myrow['sem_id']);
				$division_name = division_name($myrow['division_id']);
				$faculty_name = faculty_name($myrow['f_id']);
				$subject_name = subject_name($myrow['sub_id']);
		  }
		  $i++;						  						  						  
	}																
	?>																						
	<script type="text/javascript">
	/*
	$(function() {
		var previousPoint = null;
		$("#que1_data").bind("plothover", function (event, pos, item) {
			$("#x").text(pos.x.toFixed(2));
			$("#y").text(pos.y.toFixed(2));								
				if (item) {
					if (previousPoint != item.dataIndex) {
						previousPoint = item.dataIndex;
						
						$("#tooltip").remove();
						var x = item.datapoint[0].toFixed(2),
							y = item.datapoint[1].toFixed(2);																	
						showTooltip(item.pageX, item.pageY, parseInt(y) );
					}
				}
				else {
					$("#tooltip").remove();
					previousPoint = null;            
				}					
		});
	});
				
	 $(function() {
		  var que1_data = [<?php echo $que1_data_str ?>];

		  var Options = { 										
			bars: { show: true, align:"center" },
			grid: { hoverable: true, clickable: true, xaxis: false },
		}

		  $.plot($("#que1_data"), [{data: que1_data}], Options);
	
	});*/
	</script>
	<table>
		<tr>
			<td>Batch : <?php echo $batch_name;?> | Branch : <?php echo $branch_name;?> | Semester : <?php echo $sem_name;?> | Division : <?php echo $division_name;?></td> 						
		</tr>
		<tr>
			<td>Faculty : <?php echo $faculty_name;?></td> 											
		</tr>
		<tr>
			<td>Subject : <?php echo $subject_name;?></td> 											
		</tr>
	</table>
	<hr/>			
	<!--If you need graph-->
	<!--<div id="que1_data" style="height:300px;width:1000px;"></div>-->
	
	
	<?php 
	
	$final_table_string_new = '<table border="1" cellpadding="4" cellspacing="0">';
	$final_table_string_new .= '<tr><td align="center"><b>Rating</b></td>';
	for($i=0; $i<10; $i++)
	{
		$final_table_string_new .= "<td align='center'><b>".$i."'s</b></td>";
	}
	$final_table_string_new .= '</tr>';		
		
	$analytic_array = array();
	
	function get_table_string($field_name, $search_para_str, $que_no, $analytic_array)
	{				
		global $analytic_array;						
		$sql_query_q = 'select '.$field_name.', count(*) from feedback_master where ('. $search_para_str .') group by '.$field_name.' order by '.$field_name;				
		$res = mysql_query($sql_query_q) or die(mysql_error('sql error'));							  																		
		$data_array = array();			
		while($myrow=mysql_fetch_array($res))
		{	  
			  // $myrow["ans5"] = rating 
			  // $myrow[1] = student count		  	  	
			  $data_array[$myrow[$field_name]] = $myrow[1];		    		 		  		  		  					  						  						
		}													
		
		$que_table_string_new .= '<tr><td align="center">'.que_one_word($que_no).'</td>';
		for($i=0; $i<10; $i++)
		{
			$val = ($data_array[$i] ? $data_array[$i] : 0 );
			$que_table_string_new .= '<td align="center">'.$val. '</td>';
			$analytic_array[$i] += $val;					
		}
		$que_table_string_new .= '</tr>';
				
		return $que_table_string_new;
	}
	$final_table_string_new .= get_table_string('ans1', $search_para_str, 1, $analytic_array);	
	$final_table_string_new .= get_table_string('ans2', $search_para_str, 2, $analytic_array);	
	$final_table_string_new .= get_table_string('ans3', $search_para_str, 3, $analytic_array);
	$final_table_string_new .= get_table_string('ans4', $search_para_str, 4, $analytic_array);
	$final_table_string_new .= get_table_string('ans5', $search_para_str, 5, $analytic_array);	
	$final_table_string_new .= get_table_string('ans6', $search_para_str, 6, $analytic_array);
	$final_table_string_new .= get_table_string('ans7', $search_para_str, 7, $analytic_array);
	$final_table_string_new .= get_table_string('ans8', $search_para_str, 8, $analytic_array);
	$final_table_string_new .= get_table_string('ans9', $search_para_str, 9, $analytic_array);	
	$final_table_string_new .= get_table_string('ans9', $search_para_str, 10, $analytic_array);	
			
	$final_table_string_new .= '<tr><td align="center">Total</td>';
	$rating_n_analytic_value = 0;
	$total_of_rating = 0;
	for($i=0; $i<count($analytic_array); $i++)
	{
		
		$final_table_string_new .= '<td align="center">'.$analytic_array[$i].' * '.$i.' = '.($i * $analytic_array[$i]).'</td>';
		//echo $i.' * '. $analytic_array[$i]. ' = '. ($i * $analytic_array[$i]).'<br/>';
		$rating_n_analytic_value += ($i * $analytic_array[$i]);
		$total_of_rating += $analytic_array[$i];		
	}

	$analytic_result = ($rating_n_analytic_value / $total_of_rating);	
	$final_table_string_new .= '</tr>';	
	$final_table_string_new .= '<tr><td align="center"><b>Avg. Rating</b></td><td colspan="10" align="center"><b>'.($rating_n_analytic_value).'/'.$total_of_rating.' = '.number_format((float)$analytic_result, 2, '.', '').'</b></td></tr>';	

	$final_table_string_new .= '</table>';
	echo $final_table_string_new;
	?>	
</td>
</tr>
</table>

</td>
</tr>
</table>
</body>
</html>
