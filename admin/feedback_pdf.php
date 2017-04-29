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

	class PDF extends PDF_MySQL_Table
	{
		
	}

	/*
	$query = "SELECT RIGHT(roll_no, 3) as R_no,
									ans1 as Q1,
									ans2 as Q2,
									ans3 as Q3,
									ans4 as Q4,
									ans5 as Q5,
									ans6 as Q6,
									ans7 as Q7,
									ans8 as Q8,
									ans9 as Q9,
									ans10 as Q10,
									ans11 as Q11,
									ans12 as Q12,
									ans13 as Q13,
									ans14 as Q14,
									ans15 as Q15,
									ans16 as Q16 
									FROM feedback_master 
									WHERE b_id=".$branch." and
										  f_id=".$faculty." and
				   					      sem_id=".$sem." and
										  sub_id=".$sub."
									ORDER BY roll_no";
	*/									

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
		    //$pdf->Ln(10);
	//First table: put all columns automatically
	/*
		width: width of the table. Useful if you specify column widths by percentage. The default value is the page width without the margins.
		align: alignment of the table in the page. Possible values are L, C and R (default is C).
		padding: left and right margins used inside cells. Default value is 1mm.
		HeaderColor: background color for the table header (array of the three RGB components).
		color1: background color for odd rows.
		color2: background color for even rows.
		----------------
		Ex-
		$prop=array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'padding'=>2);
        $pdf->Table('select name, format(pop,0) as pop, rank from country order by rank limit 0,10',$prop);
	*/


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
     				 WHERE `b_id` = ".$branch." AND `sub_id` = ".$sub." AND `sem_id` = ".$sem." AND `f_id` = ".$faculty." GROUP BY ans$i";
		$pdf->Table($query,$prop2);
		$diff = 5;
		/*if(($i==6)||($i==9)||($i==12))
			$diff=50;*/
		$pdf->Ln($diff);
		$diff=5;
     	$i++;
     }

     /*
    for($i=1;$i<=16;$i++)
    {
    	$query = "SELECT ans$i,count(*) as Response FROM `feedback_master` GROUP BY ans$i";
	    $pdf->Ln(5);
		$pdf->Table($query,$prop2);
    }
    */
    
	//$pdf->Ln();
	//$pdf->Table("Select roll_no,ans1 from feedback_master ",$prop2);
	//$pdf->Table("Select roll_no,ans1 from feedback_master ",$prop2);
	$pdf->Output();

}
else
	header("location:index.php");

?>