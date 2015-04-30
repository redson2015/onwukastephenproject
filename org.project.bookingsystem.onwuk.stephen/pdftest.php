<?php
require 'pdfmaker/fpdf.php';
include_once 'DOA.php';


if (isset($_COOKIE["codes"])){
$codes = explode(",", $_COOKIE["codes"]);
$imageHeight=68;
$imagewidth=68;
$margin =2;
$x=6;
$y=20;


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(200,10,'Room QR Codes',0,0,'C');
$pdf->SetFont('Arial','',8);

foreach ($codes as $roomID){
	
	$room = json_decode(roomqrcode($roomID),true);
	if (count($room)!=0){

		$qrCode=$roomID."_".md5($roomID).".png";
		if ($y>=230) {
			$pdf -> AddPage("P","A4");
			$y = 10;
		
		}
		
		$pdf -> SetXY($x, $y);
		$pdf->Cell($imagewidth-18,10,$room[0]["RoomName"],0,0,'C');
		$y= $y+6;
		$pdf -> SetXY($x, $y);
		$pdf -> Image ( "roomqrcodes/".$qrCode);
		$y= $y-6;
		$x = $x + $imagewidth + 2;
		$pdf -> SetXY($x, $y);
		
		if ($x>=180) {
			$x=6;
			$y= $imageHeight +15;
		
		}	
		
	}
	
}

$pdf->Output();
}
?>