<?php 
require_once('classes/statusreport.php');
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
if(!empty($_POST['dept']) && isset($_POST['dept'])){
	$StatusReport=new StatusReport();
	$StatusReport_1=new StatusReport();
	$departmentName='';
	if($_POST['dept']!='all'){
		$departmentName=$StatusReport->getDepartmentNameById($_POST['dept']);
		$StatusReport->getPdfData($_POST['dept'],$_POST['start_date_odesk'],$_POST['end_date_odesk'],'odesk');
	}else{
		$departmentName=$_POST['dept'];
		$StatusReport->getPdfData($_POST['dept'],$_POST['start_date_odesk'],$_POST['end_date_odesk'],'odesk');
	}
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	//getting all the department
	$dept=array();
	foreach($StatusReport->getDepartmentList() as $val){
		if($val->id!=''){
			$dept[]=$val->id;
		}
	}
	$pdf->SetTitle($departmentName);
	$pdf->SetHeaderData('logo.png', PDF_HEADER_LOGO_WIDTH, ucwords($departmentName).' Report in period from '.$_POST['start_date_odesk'].' to '.$_POST['end_date_odesk'], 'http://www.kindlebit.com');
	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	//set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	//set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	//set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	//set some language-dependent strings
	$pdf->setLanguageArray($l);
	$pdf->SetFont('dejavusans', '', 6);
	// add a page
	$pdf->AddPage();
	$html='<div>
			<table style="width:720px;">
			<thead>
			<tr>
			<th><strong>Odesk Id</strong></th>
			<th ><strong>Client Name</strong></th>
			<th><strong>Hour Billed</strong></th>
			<th><strong>Estimated Hour</strong></th>
			</tr>
			</thead>
		';
	$estimated_hour=0;
	$hour_billed=0;
	$working_hour=0;
    $free_hour=0;
    $previous_user_id='';
    $previousdepartment='';
   //Total variable for particular user.
    $user_hour_billed=0;
    $user_working_hour=0;
    $user_free_hour=0;
    $user_today_total=0;
	foreach($StatusReport->dailyReport as $val){
			if($previous_user_id==$val->user_id){
				$user_hour_billed+=$val->hour_billed;
				$user_working_hour+=$val->working_hour;
				$user_free_hour+=$val->free_hour;
			}
		   if(in_array($StatusReport->getDepartmentIdByUserId($val->user_id),$dept) && ($_POST['dept']=='all')){
				foreach($dept as $key=>$department){
					if($department==$val->department){
						unset($dept[$key]);
						break;
					}
				}
				$store.='<tr><td colspan="4" align="center"><h2><font color="green">'.ucwords($StatusReport->getDepartmentNameByUserId($val->user_id)).'</font></h2></td></tr>';
			}
			$username=$StatusReport_1->getUserNameById($val->user_id);
			if($previous_user_id==''){
				$previousdepartment=$StatusReport->getDepartmentIdByUserId($val->user_id);
				$user_hour_billed+=$val->hour_billed;
				$user_working_hour+=$val->working_hour;
				$user_free_hour+=$val->free_hour;
				$html.=$store;
				$html.='<tr>';
				//$html.='<td colspan="9"><strong><font color="blue">'.ucfirst($username[0]->full_name).'</font></strong></td>';
				$previous_user_id=$val->user_id;
				$html.='</tr><tr><td colspan="4"></td></tr>';
			}elseif($previous_user_id!=$val->user_id){
				$previous_user_id=$val->user_id;
				//$user_today_total=$user_free_hour+$user_working_hour+$user_hour_billed;
				//$html.='<tr><td></td><td colspan="3" height="3px"><hr></td></tr>';
				//$html.='<tr><td></td><td></td><td></td><td></td><td><strong>Total Hours</strong></td><td></td><td></td><td></td><td><strong>'.$user_today_total.' hours</strong></td></tr>';
				$user_today_total=0;
				//check for new department.
				if($previousdepartment!=$StatusReport->getDepartmentIdByUserId($val->user_id)){
					$previousdepartment=$StatusReport->getDepartmentIdByUserId($val->user_id);
					$html.='<tr style="margin:10px;"><td colspan="4" align="center"><h2><font color="green">'.ucfirst($StatusReport->getDepartmentNameByUserId($val->user_id)).'</font></h2></td></tr>';
				}
					//$html.='<tr><td colspan="9"><strong><font color="blue">'.ucfirst($username[0]->full_name).'</font></strong></td></tr><tr><td colspan="9"></td></tr>';
					$user_hour_billed=0;
					$user_working_hour=0;
					$user_free_hour=0;
					//setting the current user hours.
					$user_hour_billed+=$val->hour_billed;
					$user_working_hour+=$val->working_hour;
					$user_free_hour+=$val->free_hour;
			}
			//$html.='<tr><td align="center"><strong><font color="blue">'.ucfirst($username[0]->full_name).'</font></strong></td>';
			//$html.='<td align="center"><a href="http://target.kindlebit.com/viewdescription.php?id='.$val->id.'">'.ucfirst($val->project_name).'</a></td>';
			//$html.='<tr><td align="center">'.$val->project_type.'</td>';
			$html.='<tr><td><a href="http://target.kindlebit.com/viewdescription.php?id='.$val->id.'">'.$val->odesk_id.'</a></td>';
			$html.='<td>'.$val->client_name.'</td>';
			//$html.='<td align="center">'.$val->working_hour.'</td>';
			$html.='<td>'.$val->hour_billed.'</td>';
			$html.='<td>'.$val->estimated_hour.'</td>';
			//$html.='<td align="center">'.$val->free_hour.'</td>';
			$html.='</tr>';
			$estimated_hour+=$val->estimated_hour;
			$working_hour+=$val->working_hour;
			$hour_billed+=$val->hour_billed;
			$free_hour+=$val->free_hour;
	}
	$user_today_total=$user_free_hour+$user_working_hour+$user_hour_billed;
	//$html.='<tr><td></td><td colspan="8"><hr></td></tr>';
	//$html.='<tr><td></td><td></td><td></td><td></td><td><strong>Total Hours</strong></td><td></td><td></td><td></td><td><strong>'.$user_today_total.' hours</strong></td></tr>';
	$html.='<tr><td colspan="4"><hr></td></tr>';
	$html.='<tr><td><strong>Total Hours</strong></td><td><strong></strong></td><td><strong>'.$hour_billed.'hours</strong></td><td><strong>'.$estimated_hour.'hours</strong></td></tr>';
	$html.='</table></div>';
	$user_today_total=0;
	// output the HTML content
	$pdf->writeHTML($html, true, false, true, false, '');
	// reset pointer to the last page
	$pdf->lastPage();
	//Close and output PDF document
	$pdf->Output($_POST['dept'].'Report in period'.date('Y-m-d').'.pdf', 'I');
}
?>
