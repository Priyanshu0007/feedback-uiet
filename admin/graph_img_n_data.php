<?php 
      include('session_chk.php');
	  include("includes/config_db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Average Graph Report</title>
    <script language="javascript" type="text/javascript" src="includes/js/jquery.js"></script>	
    <script language="javascript" type="text/javascript" src="includes/js/jquery.flot.js"></script>
	<link rel="stylesheet" type="text/css" href="includes/style.css" />
</head>

<body>
<table width="67%" align="center" border="0" cellpadding="0" cellspacing="1">
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="14%" bgcolor="#FFFFFF" valign="top">
<?php include('left_side.php');?>
</td>

<td width="86%" align="center" valign="top">
<table align="center" width="100%">
<tr><td colspan="3">

<?php
	  error_reporting( error_reporting() & ~E_NOTICE );
      $str= base64_decode( $_GET['str'] ); 
	  //echo $str;
	  function cal_avg($total_ans, $r_id)
	  {
		$percent = ($total_ans/($r_id));
	    return number_format((float)$percent, 2, '.', '');
	  }
	  
	  if($str=='select * from feedback_master order by feed_date asc')
	  {
	  	echo "Input is not correct";
		exit;
	  }
	  else
	  {         
	  	        $res = mysql_query($str) or die(mysql_error('sql error'));
			    //$result=mysql_fetch_array($res);			  
			    //$arr1=mysql_fetch_array($res);
			    //$total_std=mysql_num_rows($res);
			    $remark_count=0;	
				
				if(mysql_num_rows($res)==0)
				{
					echo "No Record Found!";
					exit;
				}
				else
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
					//$total_ans10=0;
					//$total_ans11=0;
					//$total_ans12=0;
					//$total_ans13=0;
					//$total_ans14=0;
					//$total_ans15=0;
					$i=0;
					
					while($myrow=mysql_fetch_array($res))
					{	  
						  $total_ans1 = $total_ans1 + $myrow['ans1'];
						  $total_ans2 = $total_ans2 + $myrow['ans2'];
						  $total_ans3 = $total_ans3 + $myrow['ans3'];
						  $total_ans4 = $total_ans4 + $myrow['ans4'];
						  $total_ans5 = $total_ans5 + $myrow['ans5'];
						  $total_ans6 = $total_ans6 + $myrow['ans6'];
						  $total_ans7 = $total_ans7 + $myrow['ans7'];
						  $total_ans8 = $total_ans8 + $myrow['ans8'];
						  $total_ans9 = $total_ans9 + $myrow['ans9'];
						  //$total_ans10 = $total_ans10 + $myrow['ans10'];
						  //$total_ans11 = $total_ans11 + $myrow['ans11'];
						  //$total_ans12 = $total_ans12 + $myrow['ans12'];
						  //$total_ans13 = $total_ans13 + $myrow['ans13'];
						  //$total_ans14 = $total_ans14 + $myrow['ans14'];
						  //$total_ans15 = $total_ans15 + $myrow['ans15'];
						  
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
						  						  
						  
						  if($myrow['remark']!=NULL)
						  {	
						    $arr_remark[$remark_count] = $myrow['remark'];
						    $remark_count++;
						  }	
					}
					$ans1 = cal_avg($total_ans1, $i);
					$ans2 = cal_avg($total_ans2, $i);
					$ans3 = cal_avg($total_ans3, $i);
					$ans4 = cal_avg($total_ans4, $i);
					$ans5 = cal_avg($total_ans5, $i);
					$ans6 = cal_avg($total_ans6, $i);
					$ans7 = cal_avg($total_ans7, $i);
					$ans8 = cal_avg($total_ans8, $i);
					$ans9 = cal_avg($total_ans9, $i);
					//$ans10 = cal_avg($total_ans10, $i);
					//$ans11 = cal_avg($total_ans11, $i);
					//$ans12 = cal_avg($total_ans12, $i);
					//$ans13 = cal_avg($total_ans13, $i);
					//$ans14 = cal_avg($total_ans14, $i);
					//$ans15 = cal_avg($total_ans15, $i);					
				}
								
				?>																						
				<script type="text/javascript">
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
				$(function() {
					var previousPoint = null;
					$("#placeholder").bind("plothover", function (event, pos, item) {
						$("#x").text(pos.x.toFixed(2));
						$("#y").text(pos.y.toFixed(2));								
							if (item) {
								if (previousPoint != item.dataIndex) {
									previousPoint = item.dataIndex;
									
									$("#tooltip").remove();
									var x = item.datapoint[0].toFixed(2),
										y = item.datapoint[1].toFixed(2);																	
									showTooltip(item.pageX, item.pageY, parseFloat(y).toFixed(2) );
								}
							}
							else {
								$("#tooltip").remove();
								previousPoint = null;            
							}					
					});
				});
							
	
				 $(function() {
					  var myData = [[1, <?php echo $ans1;?>], [2, <?php echo $ans2;?>], [3, <?php echo $ans3;?>], [4, <?php echo $ans4;?>], [5, <?php echo $ans5;?>], 
									[6, <?php echo $ans6;?>], [7, <?php echo $ans7;?>], [8, <?php echo $ans8;?>], [9, <?php echo $ans9;?>]];
			
					  var Options = { 
						xaxis: {ticks: [[1, '<?php echo que_one_word(1);?>'], [2, '<?php echo que_one_word(2);?>'], [3, '<?php echo que_one_word(3);?>'], [4, '<?php echo que_one_word(4);?>'], [5, '<?php echo que_one_word(5);?>'],
										[6, '<?php echo que_one_word(6);?>'], [7, '<?php echo que_one_word(7);?>'], [8, '<?php echo que_one_word(8);?>'], [9, '<?php echo que_one_word(9);?>']] },
										
						bars: { show: true, align:"center" },
						grid: { hoverable: true, clickable: true, xaxis: false },
					}
			
					  $.plot($("#placeholder"), [{data: myData}], Options);
				
				});
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
				<div align="center">Questions v/s Avg. rating</div>	
				<p></p>		
				<div id="placeholder" style="height:300px;width:1000px;"></div>
				<p>&nbsp;</p>
				<tr><td align="left"><br/>Remark(s):-<br/></td></tr>
				<?php				
		}
		echo '<table width=100% border=0>';
		$j=0;
		
		for($row=0;$row<($remark_count)/4;$row++)
		{
			echo '<tr>';			
			for($col=0;$col<4;$col++)
			{	
				if($arr_remark[$j]!=NULL)
				{
					echo '<td>'.'&nbsp;'.$arr_remark[$j].'</td>';
					$j++;
				}
			}
			echo '</tr>';
		}
		echo '</table>';
?>
</table>
</td>
</tr>
</table>

</body>
</html>
