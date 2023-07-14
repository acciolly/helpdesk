<?php
	require_once '../dompdf/autoload.inc.php';
	require_once '../funcoes/conexao.php';
	
	use Dompdf\Dompdf;
		
	$dompdf = new Dompdf();
	
	$html = "<html>
				<head>
					<title>Relatório de Produtos Cadastrados</title>
				</head>
				<body>
					<h3 style = 'font-family: Arial, Helvetica, sans-serif;'>PRODUTOS CADASTRADOS</h3>
					<table style = 'font-family: Arial, Helvetica, sans-serif;'>
						<tr>
							<th align = 'left' width = '50' style = 'border:1px solid black; background-color: #DCDCDC;'>CÓDIGO</th>
							<th align = 'left' width = '380' style = 'border:1px solid black; background-color: #DCDCDC;'>NOME</th>
							<th align = 'left' width = '100' style = 'border:1px solid black; background-color: #DCDCDC;'>UN MEDIDA</th>
							
						</tr>";
						
						$SQLBusca = $conexao->query("SELECT * FROM tb_produto ORDER BY nome");
						while($RSBusca = $SQLBusca->fetch()){
							
							$html = $html."<tr><td>".$RSBusca['id']."</td><td>".$RSBusca['nome']."</td><td>".$RSBusca['un_medida']."</td></tr>";
							
						}
						
						
						
						
						
					$html = $html."</table>
				</body>
			</html>";
	
	$dompdf->loadHtml($html);
								
	$dompdf->render();
	header('Content-type: application/pdf');
	echo $dompdf->output();
								
	
?>