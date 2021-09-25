<?php
	include('conexao.php');

	$categoria = $_POST['categoria'];

	$sql = "INSERT INTO categoria (categoria) VALUES ('$categoria')";
	$query = mysqli_query($conexao, $sql);
	if (mysqli_affected_rows($conexao) > 0) {
		echo '<script language="javascript">alert("Categoria cadastrada com sucesso.")</script>';
		echo '<script language="javascript">window.location="../categoria-tarefa.php"</script>';
	}else{
		echo '<script language="javascript">alert("Ocorreu um erro.")</script>';
		echo '<script language="javascript">window.location="../categoria-tarefa.php"</script>';
	}
	mysqli_close($conexao);
?>