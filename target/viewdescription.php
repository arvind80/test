<?php 
	require_once('classes/statusreport.php');
	require_once('tcpdf/config/lang/eng.php');
	require_once('tcpdf/tcpdf.php');

	
	
	if(isset($_GET['id']) && $_GET['id']!=''){
		
		$projectDetail=$StatusReport->getStatusDescription($_GET['id']);
	
	
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	
	//getting all the department
	
	$pdf->SetTitle($projectDetail[0]->project_name);

	$pdf->SetHeaderData('logo.png', PDF_HEADER_LOGO_WIDTH, ' Project Detail', 'http://www.kindlebit.com');

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	//set margins
	$pdf->SetMargins('2', PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	//set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	//set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	//set some language-dependent strings
	$pdf->setLanguageArray($l);

	// ---------------------------------------------------------

	// set font
	$pdf->SetFont('dejavusans', '', 8);

	// add a page
	$pdf->AddPage();
	
	$html='<div>
			<table style="width:720px;">
			<tr><td><font color="blue">Project Name :</font>'.ucfirst($projectDetail[0]->project_name).'</td></tr>
			<tr><td height="5px"></td></tr>
			<tr><td><font color="blue">Project Type :</font>'.($projectDetail[0]->project_type).'</td></tr>
			<tr><td height="5px"></td></tr>
			<tr><td><font color="blue">Odesk Id :</font>'.ucfirst($projectDetail[0]->odesk_id).'</td></tr>
			<tr><td height="5px"></td></tr>
			<tr><td><font color="blue">Client Name :</font>'.ucfirst($projectDetail[0]->client_name).'</td></tr>
			<tr><td height="5px"></td></tr>
			<tr><td><font color="blue">Company Name :</font>'.ucfirst($projectDetail[0]->company_name).'</td></tr>
			<tr><td height="5px"></td></tr>
			<tr><td><font color="blue">Hour Billed :</font>'.ucfirst($projectDetail[0]->hour_billed).'</td></tr>
			<tr><td height="5px"></td></tr>
			<tr><td><font color="blue">Estimated Hour :</font>'.ucfirst($projectDetail[0]->estimated_hour).'</td></tr>
			<tr><td height="5px"></td></tr>
			<tr><td><font color="blue">Project Description</font></td></tr>
			<tr></tr>
			<tr><td>"'.$projectDetail[0]->project_description.'"</td></tr>
		';
	
   
	
	
	$html.='</table></div>';

	// output the HTML content
	$pdf->writeHTML($html, true, false, true, false, '');
	// reset pointer to the last page
	$pdf->lastPage();
	//Close and output PDF document
	$pdf->Output($_POST['dept'].'Report in period'.date('Y-m-d').'.pdf', 'I');
	}
?>
