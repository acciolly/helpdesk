<?php

	session_start();
	@$_SESSION['chamar'];
	@$_SESSION['solicitante'];
	@$_SESSION['senha'];
	@$_SESSION['setor'];
	@$_SESSION['departamento'];
	@$_SESSION['categoria'];
	@$_SESSION['solicitacao'];
	@$_SESSION['anexo'];
	@$_SESSION['verchamado'];
	
	//monta o carrinho---------------------------------------
	@$_SESSION['codigoProduto'];
	@$_SESSION['qtdProduto'];
	

	
	try{
		require_once "funcoes/conexao.php";
		
		$BuscaInstituicao = $conexao->query("SELECT * FROM tb_instituicao");
		
		if($BuscaInstituicao->rowCount() > 0){
			$RSBuscaInstituicao = $BuscaInstituicao->fetch();
			$logo = $RSBuscaInstituicao['logo'];
			$lb_setor = $RSBuscaInstituicao['lb_setor'];
			$lb_departamento = $RSBuscaInstituicao['lb_departamento'];
			
			if(isset($_SESSION['solicitante'])){
			if($_SESSION['solicitante'] == "novo"){
				$pagina = "cadsolicitante";
			}else{
				if(isset($_SESSION['senha'])){
					if(isset($_SESSION['chamar']) && $_SESSION['chamar'] != null){
						$pagina = "chamado";
					}
					else if(isset($_SESSION['verchamado']) && $_SESSION['verchamado'] != null){
						$pagina = "verchamado";
					}
					else{
						$pagina = "chamados";
					}
				}else{
					$pagina = "senha";
				}
				
			}
			
		}else{
			$pagina = "login";
		}
			
		}else{echo "<meta http-equiv='refresh' content='0, url=admin/'>";;}
		
		
	}catch(PDOException $ex){
		$pagina = "parametro";
	}
		
			
	
	
		if(file_exists("paginas/".$pagina.".php")){
			require_once "paginas/".$pagina.".php";
		}else{
			echo "Página em construção";
		}

?>