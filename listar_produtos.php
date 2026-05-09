<?php
include("conexao.php");

$select_produtos = mysqli_query($conn, "SELECT * FROM produtos");
?>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- TABLE USUÁRIOS -->
<div class="container">

	<h1>Lista de produtos</h1>
	<a href="relatorio.php?param=produtos" target="_blank">
		<button type="button" class="btn btn-outline-dark">
			<i class="bi bi-file-earmark-pdf"></i> Relatório
		</button>
	</a>
	<hr>

	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">Nome</th>
				<th scope="col">Categoria</th>
				<th scope="col">Preço</th>
				<th scope="col">Estoque</th>
				<th scope="col"></th>

			</tr>
		</thead>
		<tbody>
			<?php
			while ($produtos = mysqli_fetch_assoc($select_produtos)) { ?>
				<tr>
					<th scope="row"><?php echo $produtos['nome']; ?></th>
					<td><?php echo $produtos['categoria']; ?></td>
					<th scope="row"><?php echo $produtos['preco']; ?></th>
					<td><?php echo $produtos['estoque']; ?></td>
					<td>
						<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
							data-bs-target="#editProductModal"
							data-bs-id="<?php echo $produtos['id'] ?>"
							data-bs-nome="<?php echo $produtos['nome'] ?>"
							data-bs-categoria="<?php echo $produtos['categoria'] ?>"
							data-bs-preco="<?php echo $produtos['preco'] ?>"
							data-bs-estoque="<?php echo $produtos['estoque'] ?>"><i class="bi bi-pencil-square"></i></button>

						<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
							data-bs-target="#confirmDeleteModal" data-bs-id="<?php echo $produtos['id'] ?>"
							data-bs-nome="<?php echo $produtos['nome'] ?>"><i class="bi bi-trash"></i></button>
					</td>
				</tr>
			<?php
			};
			?>
		</tbody>
	</table>

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editProductModal">Editar Produto</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="POST" action="editar.php?edit=produto">
					<div class="modal-body">
						<input type="hidden" id="productId" name="id" required>
						<div class="mb-3">
							<label for="productName" class="col-form-label">Nome:</label>
							<input type="text" class="form-control" id="productName" name="nome" required>
						</div>
						<div class="mb-3">
							<label for="productCategory" class="col-form-label">Categoria:</label>


							<select class="form-select" id="productCategory" name="categoria" required>
								<option selected disabled>Escolha uma categoria...</option>
								<option value="informatica">Informática</option>
								<option value="eletronicos">Eletrônicos</option>
								<option value="escritorio">Escritório</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="productPrice" class="col-form-label">Preço:</label>
							<input type="text" class="form-control" id="productPrice" name="preco" required>
						</div>
						<div class="mb-3">
							<label for="productStock" class="col-form-label">Estoque:</label>
							<input type="text" class="form-control" id="productStock" name="estoque" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-primary">Salvar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var editProductModal = document.getElementById('editProductModal')
		console.log("MODAL: ", editProductModal)
		editProductModal.addEventListener('show.bs.modal', function(event) {
			console.log("EVENTO: ", event);

			var button = event.relatedTarget
			console.log("BUTTON: ", button);

			var id = button.getAttribute('data-bs-id');
			console.log("ID: ", id);
			document.getElementById("productId").value = id;

			var nome = button.getAttribute('data-bs-nome');
			console.log("NOME: ", nome);
			document.getElementById("productName").value = nome;

			var categoria = button.getAttribute('data-bs-categoria');
			console.log("CATEGORIA: ", categoria);
			document.getElementById("productCategory").value = categoria;

			var preco = button.getAttribute('data-bs-preco');
			console.log("PRECO: ", preco);
			document.getElementById("productPrice").value = preco;

			var estoque = button.getAttribute('data-bs-estoque');
			console.log("ESTOQUE: ", estoque);
			document.getElementById("productStock").value = estoque;

		})
	</script>

	<!-- Sucesso Modal-->
	<div class="modal fade" id="sucessoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-white bg-success">
					<h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-check-lg"></i> Sucesso!</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Operação realizada com sucesso!
				</div>
			</div>
		</div>
	</div>
	<!-- Sucesso Modal-->

	<!-- Erro Modal-->
	<div class="modal fade" id="erroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-white bg-danger">
					<h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-x-lg mr-2"></i> Erro!</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Ocorreu um erro na operação!
				</div>
			</div>
		</div>
	</div>
	<!-- Erro Modal-->

	<!-- Modal EXCLUIR -->
	<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-white bg-danger">
					<h5 class="modal-title" id="exampleModalLabel">Excluir</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="POST" action="excluir.php?delete=produto">
					<div class="modal-body">
						<input type="hidden" id="deleteProductId" name="id" required>
						Deseja excluir este produto?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
						<button type="submit" class="btn btn-primary">Sim</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var confirmDeleteModal = document.getElementById('confirmDeleteModal')
		console.log("MODAL: ", confirmDeleteModal)
		confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
			console.log("EVENTO: ", event);

			var button = event.relatedTarget
			console.log("BUTTON: ", button);

			var id = button.getAttribute('data-bs-id');
			console.log("ID: ", id);
			document.getElementById("deleteProductId").value = id;

			var nome = button.getAttribute('data-bs-nome');
			console.log("NOME: ", nome);

			var modalTitle = confirmDeleteModal.querySelector('.modal-title')
			modalTitle.textContent = 'Excluir ' + nome
		})
	</script>

	<?php
	if (isset($_GET['process'])) {
		//var_dump($_GET);

		if ($_GET['process'] === 'true') { ?>
			<script>
				$(document).ready(function() {
					$('#sucessoModal').modal('show');
				})
			</script>
		<?php
		} else { ?>
			<script>
				$(document).ready(function() {
					$('#erroModal').modal('show');
				})
			</script>
	<?php
		}
	} else {
	}
	?>