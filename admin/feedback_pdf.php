<?php
require('session_chk.php');
require('pdf_head.php');
$fname=$_REQUEST['f_name']."_".$_REQUEST['l_name'];
if((isset($_SESSION['myusername']))&&($_SESSION['myusername']==$fname))
{
	$branch = $_REQUEST['branch'];
	$faculty = $_REQUEST['faculty'];
	$sem = $_REQUEST['sem'];
	$sub = $_REQUEST['sub'];
	$str_roll = $_REQUEST['str_roll'];
	$end_roll = $_REQUEST['end_roll'];

	class PDF extends PDF_MySQL_Table
	{
		
	}

	$pdf=new PDF();
	$pdf->AddPage('L');
			$pdf->Image('../images/uiet.png',10,2,23,23,'PNG');
			$pdf->Image('../images/pu.png',265,2,22,22,'PNG');
		    $pdf->SetFont('Courier','',30);
		    $pdf->Cell(0,15,'FeedBack','B',1,'C');
		    $pdf->SetFont('Courier','',15);
		    $pdf->Cell(100,20,strtoupper($_REQUEST['b_s']),0,0,'C');
		    $pdf->Cell(80,20,strtoupper($_REQUEST['sub_name']),0,0,'C');
		    $pdf->Cell(100,20,strtoupper($_REQUEST['f_name']." ".$_REQUEST['l_name']),0,0,'R');
	
    $prop=array('HeaderColor'=>array(255,150,100),
    			 'color1'=>array(210,245,255),
            	 'color2'=>array(255,255,210),
            	 'width' => 200,
            	 'padding'=>2,
            	 'align'=> C
    			);
    $prop2=array('HeaderColor'=>array(255,150,100),
    			 'color1'=>array(210,245,255),
            	 'color2'=>array(255,255,210),
            	 'width' => 50,
            	 'padding'=>10,
            	 'align'=> L
    			);
    $pdf->Ln(15);
     $sel_que = "SELECT * FROM question_master";
     $res_que=mysql_query($sel_que) or die(mysql_error());
     $i = 1;
     while($row_que=mysql_fetch_array($res_que))
     {	
     	$pdf->SetFont('Courier','',10);
     	$pdf->Cell(0,15,'Q'.$i.') '.$row_que['question'],'T',1,'L');
     	$query = "SELECT ans$i as 'Option',count(*) as Response FROM `feedback_master`
     				 WHERE `b_id` = ".$branch." AND `sub_id` = ".$sub." AND `sem_id` = ".$sem." AND `f_id` = ".$faculty." AND `roll_no`>='".$str_roll."' AND `roll_no`<='".$end_roll."' GROUP BY ans$i";
     	//echo $query;
		$pdf->Table($query,$prop2);
		$diff = 5;
		/*if(($i==6)||($i==9)||($i==12))
			$diff=50;*/
		$pdf->Ln($diff);
		$diff=5;
     	$i++;
     }
	$pdf->Output();

}
else
	header("location:index.php");

?>