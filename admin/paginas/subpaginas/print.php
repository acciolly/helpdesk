<?php
	require_once 'dompdf/autoload.inc.php';
	
	use Dompdf\Dompdf;
	
	if(isset($_GET['print'])){
		$impressao = base64_encode($_GET['print']);
		
		$dompdf = new Dompdf(null);
		
		$dompdf->loadHtmlFile('paginas/subpaginas/'.$impressao.'php');
		
		$dompdf->render();
		header('Content-type: application/pdf');
		echo $dompdf->output();
	}
	
	
?>