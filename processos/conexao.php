<?php
	//documento que possui a configuração da conexão com o banco de dados
	$servidor = 'localhost';
	$usuario = 'root';
	$senha = '';
	$banco_de_dados = 'gtarefas';

	//Faz a conexão com o DB
	$conexao = mysqli_connect($servidor, $usuario, $senha, $banco_de_dados);

	//Aceitar acentuação
	mysqli_set_charset($conexao, "utf8");
?>