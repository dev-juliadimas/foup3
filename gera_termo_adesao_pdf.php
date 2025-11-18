<?php
ob_start();

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/examples/tcpdf_include.php');

$html_termo = $_POST['dados'];
$nome_termo = $_POST['nome_termo'];

//echo $html_termo;
//exit;

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		//$image_file = K_PATH_IMAGES.'logo_foup.png';
		//$this->Image($image_file, 10, 10, 50, '', 'PNG', '', 'C', false, 300, '', false, false, 0, false, false, false);
		// Set font
		//$this->setFont('helvetica', 'B', 20);
        $txt = '<p style="text-align: center;"><img style="width: 150px;" src="./assets/img/logo_foup.png"></p>';
        $this->writeHTMLCell(0, 0, '', '', $txt, 0, 1, 0, true, '', true);
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->setY(-15);
		// Set font
		$this->setFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, $this->getAliasNumPage().' / '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Marcelo Mazon');
$pdf->setTitle('Termo de Adesão');
$pdf->setSubject('Termos de Aceite e Adesão - FOUP');
//$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setMargins(20, PDF_MARGIN_TOP, 15);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('times', 'N', 10);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('FOUP - Fórum de Universidades pela Paz');
$pdf->setTitle('Termo de Adesão');
$pdf->setSubject('Termo de Aceite e Adesão ao Fórum de Universidades pela Paz');
//$pdf->setKeywords('TCPDF, PDF, example, test, guide');


// add a page
$pdf->AddPage();

//html content

$html = $html_termo;

$time = time();

$file_name = $nome_termo; // 'termo_adesao_'.$time.'.pdf';

// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);

$pdf->Output(dirname(__FILE__).'/termos/'.$file_name, 'FI');

// ---------------------------------------------------------

//Close and output PDF document
//$pdf->Output('termo_adesao.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

//<object data="xxxx.pdf" type="application/pdf" style="width:100%;height:1200px;"></object>

//ob_get_clean();
?>