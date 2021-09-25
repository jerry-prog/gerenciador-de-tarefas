<?php
	error_reporting(1);
	//Modifica a zona de tempo a ser utilizada.
	date_default_timezone_set('UTC');

	include_once('menu.php');
	include_once 'processos/conexao.php';
	//Recebe os valores enviados do formulário de filtro
	$filter_status = $_GET['filter_status'];
	$filter_data = $_GET['filter_data'];
	//Data atual
	$data_atual = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Gerenciador>Home</title>
	<style type="text/css">
		*{
			font-family: sans-serif;
		}
		form{margin-top: 2%;}
	</style>
</head>
<body>
	<div class="container">
		<div class="corpo">
			<form>
				<div class="row">
					<div class="col-md">
						<label>Status</label>
						<select class="form-select form-select-sm" name="filter_status">
							<option></option>
							<option>Aguardando</option>
							<option>Concluído</option>
						</select>
					</div>
					<div class="col-md">
						<label>Data</label>
						<input class="form-control form-control-sm" type="date" name="filter_data">
					</div>					
				</div><br>
				<button class="btn btn-sm btn-primary" type="submit">Localizar</button>							
			</form><hr>
			<h1>Tarefas Programadas</h1>
			<table class="table table-sm">
				<thead>
					<tr>
						<th>#</th>
						<th>Categoria</th>
						<th>Tarefas</th>
						<th>Data/Hora</th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($filter_status) AND empty($filter_data)) {
						$query_tarefas = $conexao->query("SELECT t.*, cat.categoria FROM tarefas AS t INNER JOIN categoria AS cat ON t.cod_categoria = cat.id_cat WHERE status = '$filter_status' ORDER BY data_realiz ASC");
					}elseif (empty($filter_status) AND !empty($filter_data)) {
						$query_tarefas = $conexao->query("SELECT t.*, cat.categoria FROM tarefas AS t INNER JOIN categoria AS cat ON t.cod_categoria = cat.id_cat WHERE data_realiz = '$filter_data' ORDER BY data_realiz ASC");
					}elseif(!empty($filter_status) AND !empty($filter_data)){
						$query_tarefas = $conexao->query("SELECT t.*, cat.categoria FROM tarefas AS t INNER JOIN categoria AS cat ON t.cod_categoria = cat.id_cat WHERE status = '$filter_status' AND data_realiz = '$filter_data' ORDER BY data_realiz ASC");
					}else{					
						$query_tarefas = $conexao->query("SELECT t.*, cat.categoria FROM tarefas AS t INNER JOIN categoria AS cat ON t.cod_categoria = cat.id_cat WHERE data_realiz = '$data_atual' ORDER BY data_realiz ASC");
					}
					while ($result_query_tarefas = mysqli_fetch_assoc($query_tarefas)) {
						$id_tarefas = $result_query_tarefas['id_tarefas'];
						echo "<tr>";
							echo "<td>".$id_tarefas."</td>";
							echo "<td>".$result_query_tarefas['categoria']."</td>";
							echo "<td>".$result_query_tarefas['tarefa']."</td>";
							echo "<td>".date('d/m/Y', strtotime($result_query_tarefas['data_realiz']))."  ".$result_query_tarefas['hora_realiz']."</td>";
							echo "<td>".$result_query_tarefas['status']."</td>";
							echo "<td><a class='btn btn-sm btn-outline-warning' href='processos/processo-finaliza-tarefa.php?id_tarefas=$id_tarefas'>Concluir</a></td>";
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		<button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#cadastrar">Adicionar</button>
		<!--Janela modal cadastra-->
		<div class="modal fade" id="cadastrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Nova Tarefa</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		      	<form method="POST" action="processos/processa-cadastra-tarefa.php">
			      	<div class="row">
			      		<div class="col-md">
			      			<label>*Categoria</label>
			      			<select class="form-select form-select-sm" required="" name="categoria">
			      				<option></option>
			      				<?php
								$query_cat = $conexao->query("SELECT * FROM categoria ORDER BY categoria ASC");
								while ($result_cat = mysqli_fetch_assoc($query_cat)) {
									echo '<option value="'.$result_cat['id_cat'].'">'.$result_cat['categoria'].'</option>';
								}
								?>
			      			</select>
			      		</div>
			      		<div class="col-md">
			      			<label>*Data</label>
			      			<input class="form-control form-control-sm" type="date" required="" name="data">
			      		</div>
			      		<div class="col-md">
			      			<label>*Hora</label>
			      			<input class="form-control form-control-sm" type="time" required="" name="hora">
			      		</div>
			      	</div>
			      	<div class="row">
			      		<div class="col-md">
			      			<label>*Descrição da tarefa a ser realizada</label>
			      			<textarea class="form-control form-control-sm" rows="5" placeholder="Descreva aqui a tarefa." required="" name="tarefa"></textarea>
			      		</div>
			      	</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
			        <button type="submit" class="btn btn-success">Cadastrar</button>
			      </div>
			    </form>
		    </div>
		  </div>
		</div>
		<!--Fim da Janela modal cadastra-->
	</div>
</body>
</html>