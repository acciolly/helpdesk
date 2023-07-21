<?php

	session_start();
	@$_SESSION['login'];
	
	
		require_once "funcoes_admin/conexao.php";
		
		//verifica se tem instituicao cadastrada
		$BuscaInstituicao = $conexao->query("SELECT * FROM tb_instituicao");
		
		if($BuscaInstituicao->rowCount() > 0){
			$RSBuscaInstituicao = $BuscaInstituicao->fetch();
			$logo = $RSBuscaInstituicao['logo'];
			$lb_setor = $RSBuscaInstituicao['lb_setor'];
			$lb_departamento = $RSBuscaInstituicao['lb_departamento'];
		
		//verifica se existem usuarios cadastrados
			$BuscaUsuarios = $conexao->query("SELECT * FROM tb_usuario");
			
			if($BuscaUsuarios->rowCount() > 0){
			
			
				if(isset($_SESSION['login'])){
					$pagina = "dashboard";
				}else{
					$pagina = "login";
				}
				
					
			}else{
				
				$pagina = "caduser";
				
			}
		}else{
			$pagina = "cadinstituicao";
		}
		
		if(file_exists("paginas/".$pagina.".php")){
			require_once "paginas/".$pagina.".php";
		}else{
			echo "Página em construção";
		}

?>