<?php
	include('conexao.php');

	//Variáves que recebem os dados do modal cadastra
	$categoria = $_POST['categoria'];
	$data = $_POST['data'];
	$hora = $_POST['hora'];
	$tarefa = $_POST['tarefa'];

	$sql = "INSERT INTO tarefas (cod_categoria, tarefa, data_realiz, hora_realiz, status) VALUES ('$categoria', '$tarefa', '$data', '$hora', 'Aguardando')";
	$query_sql = mysqli_query($conexao, $sql);	
	if (mysqli_affected_rows($conexao) > 0) {
		echo '<script language="javascript">alert("Cadastro realizado com sucesso.")</script>';
		echo '<script language="javascript">window.location="../index.php"</script>';
	}else{
		echo '<script language="javascript">alert("Ocorreu um erro.")</script>';
		echo '<script language="javascript">window.location="../index.php"</script>';
	}
	mysqli_close($conexao);
?>