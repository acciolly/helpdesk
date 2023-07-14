<?php
	require_once '../dompdf/autoload.inc.php';
	require_once '../funcoes/conexao.php';
	
	use Dompdf\Dompdf;
		
	$dompdf = new Dompdf();
	
	$html = "<html>
				<head>
					<title>Relatório de Saldo Por Lote</title>
				</head>
				<body>
					<h3 style = 'font-family: Arial, Helvetica, sans-serif;'>SALDO POR LOTE</h3>
					<table style = 'font-family: Arial, Helvetica, sans-serif;'>
						<tr>
							<th align = 'left' width = '80' style = 'border:1px solid black; background-color: #DCDCDC;'>DT LOTE</th>
							<th align = 'left' width = '230' style = 'border:1px solid black; background-color: #DCDCDC;'>PRODUTO</th>
							<th align = 'left' width = '70' style = 'border:1px solid black; background-color: #DCDCDC;'>ENTRADA</th>
							<th align = 'left' width = '70' style = 'border:1px solid black; background-color: #DCDCDC;'>SAIDA</th>
							<th align = 'left' width = '70' style = 'border:1px solid black; background-color: #DCDCDC;'>SALDO</th>
							
						</tr>";
						
						$SQLBusca = $conexao->query("SELECT * FROM v_produtosaida WHERE saldo > 0 ORDER BY produto,data");
						while($RSBusca = $SQLBusca->fetch()){
							
							$html = $html."<tr><td>".date('d/m/Y', strtotime($RSBusca['data']))."</td><td>".$RSBusca['id_produto']." - ".$RSBusca['produto']." / ".$RSBusca['fabricante']."</td><td>".$RSBusca['qtd']."</td><td>".$RSBusca['saida']."</td><td>".$RSBusca['saldo']."</td></tr>";
							
						}
						
						
						
						
						
					$html = $html."</table>
				</body>
			</html>";
	
	$dompdf->loadHtml($html);
								
	$dompdf->render();
	header('Content-type: application/pdf');
	echo $dompdf->output();
								
	
?>