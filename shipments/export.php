<?php
require_once './core/init.php';

if (isset($_POST['export']) && !empty($_GET['action'] == 'csv')) {

	$sql = "SELECT 
			  p.shipment_id
			, p.date_sent
			, p.recipient
			, p.recipient_address
			, p.body_sent_correspondence
			, rp.shipment_type_name
			, CONCAT(u1.first_name,' ',u1.last_name) AS registered_by
			, CONCAT(u2.first_name,' ',u2.last_name) AS updated_by
			FROM ".$t_shipments." AS p 
			LEFT JOIN ".$t_shipments_types." AS rp ON p.shipment_type_id = rp.shipment_type_id 
			INNER JOIN ".$t_users." AS u1 ON p.registered_by_id = u1.user_id 
			INNER JOIN ".$t_users." AS u2 ON p.updated_by_id = u2.user_id 
			WHERE p.deleted = 0 ";
	
	$received = " AND p.received = 1";
	$sent = " AND p.sent = 1";
	
	if ($_GET['shipments'] == 'received')
	{
		$sql .= $received;
	}
	else if ($_GET['shipments'] == 'sent')
	{
		$sql .= $sent;
	}
	
	$result = mysqli_query($connect, $sql);

	csv_from_mysql($result);

}
else if (isset($_POST['export']) && !empty($_GET['action'] == 'pdf'))
{
	require_once './core/classes/tcpdf/tcpdf.php';
	
	$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	$obj_pdf->SetCreator(PDF_CREATOR);// set document information
	$obj_pdf->SetTitle("Tabela ".$_GET['shipments']." - PDF");
	$obj_pdf->SetSubject('Generated using Shipment Register System');
	$obj_pdf->SetAuthor('John Doe');
	$obj_pdf->SetKeywords('TCPDF, PDF, John, Doe, ');
	$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);// set default header data
	$obj_pdf->SetHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));// set header and footer fonts
	$obj_pdf->SetFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$obj_pdf->SetDefaultMonospacedFont('FreeSans');// set default monospaced font
	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);// set margins
	$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$obj_pdf->SetAutoPageBreak(TRUE, 10);// set auto page breaks
	$obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);// set image scale factor
	/* // set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/en.php')) {
		require_once(dirname(__FILE__).'/lang/en.php');
		$pdf->setLanguageArray($l);
	}
	*/
	$obj_pdf->SetFont('FreeSans', '', 12);// set font
	$obj_pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);// add a page
	$obj_pdf->SetPrintHeader(false);
	$obj_pdf->SetPrintFooter(false); // or true
	$obj_pdf->AddPage('L', 'A4'); // L - Landscape or P - Portrait
	//$obj_pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C'); // custom cell on page

	$html = '';
	
	$html .='<h3 align="center">Shipments ('.$_GET['shipments'].')</h3>';
	$html .='<table border="1" cellspacing="0" cellpadding="5">
			<tr>
				<th style="text-align: center; width: 4%;">No.</th>
				<th style="text-align: center; width: 10%;">Sent date</th>
				<th style="text-align: center; width: 10%;">Recipient</th>
				<th style="text-align: center; width: 15%;">Recipient address</th>
				<th style="text-align: center; width: 20%;">The content of sent correspondence</th>
				<th style="text-align: center; width: 15%;">Shipment type</th>
				<th style="text-align: center; width: 13%;">Registered by</th>
				<th style="text-align: center; width: 13%;">Updated by</th>
			</tr>
	';
	
	$html .= get_shipments_pdf($_GET['shipments']);
	
	$html .= '</table>';
	
	//$html .= 'This is <b color="#FF0000">digitally signed document</b>';
	
	$obj_pdf->writeHTML($html);
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	//$obj_pdf->Image('./core/classes/tcpdf/examples/images/tcpdf_signature.png', 180, 60, 15, 15, 'PNG');// create content for signature (image and/or text)
	//$obj_pdf->setSignatureAppearance(180, 60, 15, 15);// define active area for signature appearance
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	$obj_pdf->Output("file.pdf", "I");
	
} else {
	$error[] = 'Error!';
}
?>