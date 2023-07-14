<?php
	require_once "funcoes/conexao.php";
	
	
	if(isset($_POST['criterio'])){
		$parametro = isset($_POST['criterio']) ? $_POST['criterio'] : null;
		
		$SQLBusca = $conexao->query("SELECT * FROM tb_produto WHERE nome LIKE '%$parametro%' ORDER BY nome ASC");
		while($RSBusca = $SQLBusca->fetch()){
			
			echo "<input type = 'radio' name = 'opcao' value = '".$RSBusca['id']."'> ".$RSBusca['nome']."<br/>";
			
		}
	}
	
	if(isset($_POST['produto'])){
		$produto = isset($_POST['produto']) ? $_POST['produto'] : null;
		$SQLBusca = $conexao->query("SELECT * FROM tb_produto WHERE id = $produto");
			if($SQLBusca->rowCount() > 0){
			$RSBusca = $SQLBusca->fetch();
			echo "<div class = 'col-md-4'><label>Nome</label><input type = 'text' value = '".$RSBusca['nome']."' class = 'form-control' disabled/></div>";
			
			echo "<div class = 'col-md-8'><label>Fabricante</label>";
				echo "<select name = 'fabricante' class = 'form-control'>";
				
				$SQLBuscaFab = $conexao->query("SELECT tb_fabricante.nome, tb_fabricante.id FROM tb_fabricante INNER JOIN tb_lista_fabricante ON tb_lista_fabricante.tb_fabricante_id = tb_fabricante.id WHERE tb_lista_fabricante.tb_produto_id = ".$RSBusca['id']);
				while($RSFab = $SQLBuscaFab->fetch()){
					echo "<option value = '".$RSFab['id']."'>".$RSFab['nome']."</option>";
				
				}
				echo "</select>";
			echo "</div>";
			
			
												
		}else{
			echo "<p style = 'font-size: 24px;'>Produto não encontrado!</p>";
		}
		
	}
	
	if(isset($_POST['criterio_saida'])){
		$parametro = isset($_POST['criterio_saida']) ? $_POST['criterio_saida'] : null;
		
		$SQLBusca = $conexao->query("SELECT * FROM tb_produto WHERE nome LIKE '%$parametro%' ORDER BY nome ASC");
		while($RSBusca = $SQLBusca->fetch()){
			
			echo "<input type = 'radio' name = 'opcao' value = '".$RSBusca['id']."'> ".$RSBusca['nome']."<br/>";
			
		}
	}
	
	if(isset($_POST['produto_saida'])){
		$produto = isset($_POST['produto_saida']) ? $_POST['produto_saida'] : null;
		$SQLBusca = $conexao->query("SELECT * FROM tb_produto WHERE id = $produto");
			if($SQLBusca->rowCount() > 0){
			$RSBusca = $SQLBusca->fetch();
			echo "<div class = 'col-md-4'><label>Nome / Un medida</label><input type = 'text' value = '".$RSBusca['nome']." / ".$RSBusca['un_medida']."' class = 'form-control' disabled/></div>";
			
			echo "<div class = 'col-md-8'><label>Lote</label>";
				echo "<select name = 'lote' class = 'form-control'>";
				
				$SQLBuscaEnt = $conexao->query("SELECT * FROM v_produtosaida WHERE saldo > 0 AND id_produto = ".$RSBusca['id']);
				if($SQLBuscaEnt->rowCount() > 0){
					while($RSEnt = $SQLBuscaEnt->fetch()){
						$data = date('d/m/Y', strtotime($RSEnt['data']));
						echo "<option value = '".$RSEnt['id']."'>$data - ".$RSEnt['fabricante']." - SALDO: ".$RSEnt['saldo']." de ".$RSEnt['qtd']."</option>";
					
					}
				}else{
					echo "<option>PRODUTO SEM SALDO!</option>";
				}
				echo "</select>";
			echo "</div>";
			
			
												
		}else{
			echo "<p style = 'font-size: 24px;'>Produto não encontrado!</p>";
		}
		
	}


?>