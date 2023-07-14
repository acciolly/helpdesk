<?php
	require_once '../dompdf/autoload.inc.php';
	require_once '../funcoes/conexao.php';
	
	if(isset($_GET['id'])){
		
		$id = $_GET['id'];
		
		$SQLBusca = $conexao->query("SELECT tb_chamado.data, tb_departamento.nome AS departamento, tb_pessoa.nome AS pessoa, tb_chamado.protocolo FROM tb_chamado INNER JOIN tb_departamento ON tb_chamado.tb_departamento_id = tb_departamento.id INNER JOIN tb_pessoa ON tb_chamado.tb_pessoa_id = tb_pessoa.id WHERE tb_chamado.id = $id");
		$RSBusca = $SQLBusca->fetch();
		
		$data = date('d/m/Y', strtotime($RSBusca['data']));
		$departamento = $RSBusca['departamento'];
		$pessoa = $RSBusca['pessoa'];
		$protocolo = $RSBusca['protocolo'];
		
	}
	
	
	use Dompdf\Dompdf;
		
	$dompdf = new Dompdf();
	
	$html = "<html>
				<head>
					<title>Relatório de Produtos Solicitados</title>
				</head>
				<body style = 'font-family: Arial, Helvetica, sans-serif; font-size: 14px;'>
					<h3>PRODUTOS SOLICITADOS</h3>
					<b>DATA:</b> $data<br/>
					<b>PROTOCOLO:</b> $protocolo<br/>
					<b>DEPARTAMENTO:</b> $departamento<br/>
					<b>SOLICITANTE:</b> $pessoa<br/><br/>
					<table>
						<tr>
							<th align = 'left' width = '200' style = 'border:1px solid black; background-color: #DCDCDC; padding:5px;'>NOME</th>
							<th align = 'left' width = '100' style = 'border:1px solid black; background-color: #DCDCDC; padding:5px;'>UN MEDIDA</th>
							<th align = 'left' width = '100' style = 'border:1px solid black; background-color: #DCDCDC; padding:5px;'>CATEGORIA</th>
							<th align = 'left' width = '80' style = 'border:1px solid black; background-color: #DCDCDC; padding:5px;'>QTD</th>
							
						</tr>";
						
						$SQLBusca = $conexao->query("SELECT tb_produto.id, tb_produto.nome, tb_produto.un_medida, tb_categoria_produto.nome AS categoria, tb_lista_produtos.qtd FROM tb_lista_produtos INNER JOIN tb_produto ON tb_lista_produtos.tb_produto_id = tb_produto.id INNER JOIN tb_categoria_produto ON tb_categoria_produto.id = tb_produto.tb_categoria_produto_id WHERE tb_lista_produtos.tb_chamado_id = $id ORDER BY tb_categoria_produto.nome");
						while($RSBusca = $SQLBusca->fetch()){
							
							$html = $html."<tr><td style = 'border:1px solid black; padding: 5px;'>".$RSBusca['id']." - ".$RSBusca['nome']."</td><td align = 'center'  style = 'border:1px solid black; padding: 5px;'>".$RSBusca['un_medida']."</td><td style = 'border:1px solid black; padding: 5px;'>".$RSBusca['categoria']."</td><td align = 'center'  style = 'border:1px solid black; padding: 5px;'>".$RSBusca['qtd']."</td></tr>";
							
						}
						
						
						
						
						
					$html = $html."</table>
				</body>
			</html>";
	
	$dompdf->loadHtml($html);
								
	$dompdf->render();
	header('Content-type: application/pdf');
	echo $dompdf->output();
								
	
?>