<?php

	session_start();
	@$_SESSION['login'];
	
	
		require_once "funcoes_admin/conexao.php";
		
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
		
		if(file_exists("paginas/".$pagina.".php")){
			require_once "paginas/".$pagina.".php";
		}else{
			echo "Página em construção";
		}

?>