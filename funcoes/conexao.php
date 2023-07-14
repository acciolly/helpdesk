<?php

	if(file_exists("funcoes/parametro.txt")){
			try{
				$arquivo = "funcoes/parametro.txt";
				$fp = fopen($arquivo,"r");
				$conteudo = fread($fp, filesize($arquivo));
				fclose($fp);
				
				$parametro = explode(";",$conteudo);
				
				$host = $parametro[0];
				$dbname = $parametro[1];
				$user = $parametro[2];
				$pass = $parametro[3];
				
				//faz a conexão ao banco
				$conexao = new PDO("mysql:host=$host;dbname=$dbname","$user","$pass");
				//garante a visualização de caracteres(acentos,ç,etc...) 
				$conexao->exec("set names utf8");
				
			}
			catch (PDOException $e){
				echo "<script>alert('Não foi possível se conectar a base de dados! Você será redirecionado para a configuração.')</script>";
				echo "<meta http-equiv='refresh' content='0, url=parametro.php'>";
			}
	}else{
			$arquivo = "funcoes/parametro.txt";
			$fp = fopen($arquivo,"a+");
			fwrite($fp,"localhost;helpdesk;root;;");
			fclose($fp);
			echo "<meta http-equiv='refresh' content='0, url='>";
			
	}
		
		
	


?>
