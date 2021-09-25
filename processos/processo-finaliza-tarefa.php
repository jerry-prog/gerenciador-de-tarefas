<?php
	include 'conexao.php';
	//Recebe o id da tarefa selecionada na página index
	$id_tarefas = $_GET['id_tarefas'];

	$up_finaliza = "UPDATE tarefas SET status = 'Concluído' WHERE id_tarefas = '$id_tarefas'";
	$query_up_finaliza = mysqli_query($conexao, $up_finaliza);
	if (mysqli_affected_rows($conexao) > 0) {
	 	echo '<script language="javascript">alert("Tarefa finalizada com sucesso.")</script>';
		echo '<script language="javascript">window.location="../index.php"</script>';
	}else{
		echo '<script language="javascript">alert("Ocorreu um erro ao finalizar a tarefa.")</script>';
		echo '<script language="javascript">window.location="../index.php"</script>';
	}
	mysqli_close($conexao);
?>