<?php



try
{
	//faz a conexão ao banco
    $conexao = new PDO("mysql:host=localhost;dbname=helpdesk","root","");
	//garante a visualização de caracteres(acentos,ç,etc...) 
	$conexao->exec("set names utf8");
}
catch (PDOException $e)
{
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}
?>
