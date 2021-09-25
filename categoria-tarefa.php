<?php
	//Inclui o menu
	include_once('menu.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Gerenciador>Categoria</title>
	<style type="text/css">
		*{
			font-family: sans-serif;
		}
		form{margin-top: 2%;}
	</style>
</head>
<body>
	<div class="container">
		<h1>Categorias cadastradas</h1>
		<!--Botão que aciona a janela modal-->
		<button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#cadastrar_categoria">Adicionar</button>
		<table class="table table-sm">
			<thead>
				<tr>
					<th>Categoria</th>					
				</tr>
			</thead>
			<tbody>
				<?php
				include_once('processos/conexao.php');
				$query_cat = $conexao->query("SELECT * FROM categoria ORDER BY categoria ASC");
				while ($result_query_cat = mysqli_fetch_assoc($query_cat)) {
					echo "<tr>";
						echo "<td>".$result_query_cat['categoria']."</td>";
					echo "</tr>";
				}
				echo "</tbody>
		</table>";
				?>
					
		<!--Janela modal cadastra categoria-->
		<div class="modal fade" id="cadastrar_categoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Nova Categoria</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		      	<form method="POST" action="processos/processa-cadastra-categoria.php">
			      	<div class="row">
			      		<div class="col-md">
			      			<label>*Categoria</label>
			      			<input type="" class="form-control form-control-sm" placeholder="Digite aqui." name="categoria">
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
		<!--Fim da Janela modal cadastra categoria-->
	</div>
</body>
</html>