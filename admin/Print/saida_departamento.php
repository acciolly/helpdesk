<?php
	require_once '../dompdf/autoload.inc.php';
	require_once '../funcoes/conexao.php';
	
	use Dompdf\Dompdf;
		
	$dompdf = new Dompdf();
	
	if(isset($_GET['dep'])){
		
		$dep = $_GET['dep'];
		$inicio = date('d/m/Y', strtotime($_GET['inicio']));
		$fim = date('d/m/Y', strtotime($_GET['fim']));
		
		$SQLBusca = $conexao->query("SELECT * FROM tb_departamento WHERE id = $dep");
		$RSBusca = $SQLBusca->fetch();
		$departamento = $RSBusca['nome'];
		
		$html = "<html>
				<head>
					<title>Relatório de Produtos Solicitados</title>
				</head>
				<body style = 'font-family: Arial, Helvetica, sans-serif; font-size: 14px;'>
					<h3>SAÍDA POR DEPARTAMENTO</h3>
					<b>DEPARTAMENTO:</b> $departamento<br/>
					<b>PERÍODO:</b> de $inicio a $fim<br/>";
					
					//carrega as saídas
					$SQLSaida = $conexao->query("SELECT * FROM tb_saida WHERE data BETWEEN '".$_GET['inicio']."' AND '".$_GET['fim']."' AND tb_departamento_id = ".$RSBusca['id']);
					if($SQLSaida->rowCount() > 0){
						while($RSSaida = $SQLSaida->fetch()){
							
							$html = $html."<p><b>DATA:</b> ".date('d/m/Y', strtotime($RSSaida['data']))."<br/> <b>DOCUMENTO:</b> ".$RSSaida['documento']."</p>";
							$html = $html."<table>
													<tr>
														<th align = 'left' width = '300' style = 'border:1px solid black; background-color: #DCDCDC;'>PRODUTO</th>
														<th align = 'center' width = '120' style = 'border:1px solid black; background-color: #DCDCDC;'>UNIDADE</th>
														<th align = 'center' width = '120' style = 'border:1px solid black; background-color: #DCDCDC;'>QUANTIDADE</th>
													</tr>";
													
							$SQLProdutos = $conexao->query("SELECT tb_produto.nome, tb_produto.un_medida, tb_produto_saida.qtd FROM tb_produto_saida INNER JOIN tb_produto_entrada ON tb_produto_saida.tb_produto_entrada_id = tb_produto_entrada.id INNER JOIN tb_produto ON tb_produto_entrada.tb_produto_id = tb_produto.id WHERE tb_produto_saida.tb_saida_id = ".$RSSaida['id']." ORDER BY tb_produto.nome");
							while($RSProdutos = $SQLProdutos->fetch()){
								$produto = $RSProdutos['nome'];
								$un = $RSProdutos['un_medida'];
								$qtd = $RSProdutos['qtd'];
								$html = $html."<tr>
													<td style = 'border:1px solid black;'>$produto</td>
													<td align = 'center' style = 'border:1px solid black;'>$un</td>
													<td align = 'center' style = 'border:1px solid black;'>$qtd</td>
												</tr>";
												
												
								
								
							}
							
							$html = $html."</table>";
							
						}
					}else{
						$html = $html."<p>NENHUM LANÇAMENTO NO PERÍODO INFORMADO...</p>";
						
					}
					
					
				$html = $html."</body>
				</html>
					
					";
				
				
				
		$dompdf->loadHtml($html);
								
		$dompdf->render();
		header('Content-type: application/pdf');
		echo $dompdf->output();
		
		
	}
	
	
	
	
	
					
				
	
	
								
	
?>