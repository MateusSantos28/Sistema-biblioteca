<?php
session_start();

if (isset($_SESSION['acesso'])) {

	if ($_SESSION['acesso'] === 1) {
	} else {
		$_SESSION['erro'] = "Acesso inválido! Por favor, faça o login novamente.";
		header('Location: login.php');
	}
} else {
	$_SESSION['erro'] = "Acesso inválido! Por favor, faça o login novamente.";
	header('Location: login.php');
}

if (isset($_GET['insert']) && $_GET['insert'] == 'true') {
	header("Refresh:2 ; url=dashboard.php");
}
?>

<!doctype html>
<html lang="pt-br">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Bootstrap Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

	<title>...:::DASHBOARD SISTEMA:::...</title>
</head>

<body>

	<!-- BARRA DE MENUS -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="dashboard.php"><i class="bi bi-house-door"></i>
				<?php
				if ($_SESSION['nivel_de_acesso'] == 1) {
					echo "Painel do Administrador";
				} else {
					echo "Painel do Cliente";
				}
				?>
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">

				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<?php
					if ($_SESSION['nivel_de_acesso'] == 1) { ?>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
								aria-expanded="false">
								<i class="bi bi-person"></i> Usuários
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">

								<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cadastrousuarioModal">Cadastrar</a></li>
								<li><a class="dropdown-item" href="#" onclick="loadUsersList()">Listar</a></li>
							</ul>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
								aria-expanded="false">
								<i class="bi bi-boxes"></i> Produtos
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">

								<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cadastroprodutoModal">Cadastrar</a></li>
								<li><a class="dropdown-item" href="#" onclick="loadProductsList()">Listar</a></li>
							</ul>

						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
								aria-expanded="false">
								<i class="bi bi-people"></i> Clientes
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">

								<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cadastroclienteModal">Cadastrar</a></li>
								<li><a class="dropdown-item" href="#" onclick="loadClientsList()">Listar</a></li>
							</ul>
						</li>

					<?php
					} else {
					}
					?>
				</ul>

				<button class="btn btn-outline-primary" type="button" data-bs-toggle="modal"
					data-bs-target="#confirmesairModal">Sair</button>

			</div>
		</div>
	</nav>
	<!-- BARRA DE MENUS -->

	<p>

	<div class="container-fluid">

		<span id="mainContent"></span>

		<div>

			<script type="text/javascript">
				document.getElementById("mainContent").innerHTML = '<iframe scrolling="no" width="100%" height="500" src="cards.php" name="contentFrame"></iframe>';

				function loadUsersList() {
					document.getElementById("mainContent").innerHTML = '<iframe scrolling="yes" width="100%" height="500" src="listar_usuarios.php" name="contentFrame"></iframe>';
				}

				function loadClientsList() {
					document.getElementById("mainContent").innerHTML = '<iframe scrolling="yes" width="100%" height="500" src="listar_clientes.php" name="contentFrame"></iframe>';
				}

				function loadProductsList() {
					document.getElementById("mainContent").innerHTML = '<iframe scrolling="yes" width="100%" height="500" src="listar_produtos.php" name="contentFrame"></iframe>';
				}
			</script>

			<!-- RODAPÉ -->
			<footer class="py-2 my-0 border-top fixed-bottom">
				<p class="text-center text-muted">&copy; Mateus Batista Bento dos Santos <?= date("Y") ?></p>
			</footer>
			<!-- RODAPÉ -->

			<!-- Option 1: Bootstrap Bundle with Popper -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

</body>

</html>

<!-- Modal SAIR -->
<div class="modal fade" id="confirmesairModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Sair</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Deseja sair do sistema?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
				<a href="login.php"><button type="button" class="btn btn-primary">Sim</button></a>
			</div>
		</div>
	</div>
</div>

<!-- Modal CADASTRO USUARIO -->
<div class="modal fade" id="cadastrousuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Cadastro de Usuário</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST" action="cadastro.php?cad=usuario">
				<div class="modal-body">
					<div class="col-12">
						<label for="inputUsername" class="form-label">Usuário:</label>
						<input type="text" class="form-control" id="inputUsername" name="usuario" placeholder="nome de usuário" required>
					</div>
					<div class="col-12">
						<label for="inputSenha" class="form-label">Senha:</label>
						<input type="password" class="form-control" id="inputSenha" name="senha" placeholder="senha de acesso" required>
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

<!-- Modal CADASTRO PRODUTO -->
<div class="modal fade" id="cadastroprodutoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<form method="POST" action="cadastro.php?cad=produto">
				<div class="modal-body">
					<div class="col-12">
						<label for="productName" class="form-label">Nome:</label>
						<input type="text" class="form-control" id="productName" name="nome" placeholder="nome do produto" required>
					</div>
					<div class="col-12">
						<label for="productPrice" class="form-label">Preço:</label>
						<input type="number" class="form-control" id="productPrice" name="preco" placeholder="digite o preço" required>
					</div>
					<div class="col-12">
						<label for="inputCategoria" class="form-label">Categoria:</label>
						<select class="form-select" id="inputCategoria" name="categoria" required>
							<option value="" selected disabled>Escolha uma categoria...</option>
							<option value="informatica">Informática</option>
							<option value="eletronicos">Eletrônicos</option>
							<option value="escritorio">Escritório</option>
						</select>
					</div>

					<div class="col-12">
						<label for="productStock" class="form-label">Estoque:</label>
						<input type="number" class="form-control" id="productStock" name="estoque" placeholder="digite o estoque" required>
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


<!-- Modal CADASTRO CLIENTE -->
<div class="modal fade" id="cadastroclienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Cadastro de Cliente</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<form method="POST" action="cadastro.php?cad=cliente">
				<div class="modal-body">
					<div class="col-12">
						<label for="clientName" class="form-label">Nome:</label>
						<input type="text" class="form-control" id="clientName" name="nome" placeholder="digite seu nome" required>
					</div>
					<div class="col-12">
						<label for="clientEmail" class="form-label">E-mail:</label>
						<input type="email" class="form-control" id="clientEmail" name="email" placeholder="digite seu email" required>
					</div>
					<div class="col-12">
						<label for="clientPhone" class="form-label">Telefone:</label>
						<input type="text" class="form-control" id="clientPhone" name="telefone" placeholder="digite seu telefone" required maxlength="11" minlength="10" pattern="[0-9]{10,11}">
					</div>
					<div class="col-12">
						<label for="clientCpf" class="form-label">CPF:</label>
						<input type="text" class="form-control" id="clientCpf" name="cpf" placeholder="digite seu cpf" required maxlength="11" minlength="11" pattern="[0-9]{11}">
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
				Erro na operação!
			</div>
		</div>
	</div>
</div>
<!-- Erro Modal-->

<!-- Erro Modal-->
<div class="modal fade" id="invalidoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-white bg-danger">
				<h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-x-lg mr-2"></i> Erro!</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Parámetro inválido!
			</div>
		</div>
	</div>
</div>

<?php
if (isset($_GET['insert'])) {

	if ($_GET['insert'] === 'true') { ?>
		<script>
			$(document).ready(function() {
				$('#sucessoModal').modal('show');
			})
		</script>
	<?php } else { ?>
		<script>
			$(document).ready(function() {
				$('#erroModal').modal('show');
			})
		</script>
	<?php
	}
}

if (isset($_GET['value'])) {
	if ($_GET['value'] === 'false') { ?>
		<script>
			$(document).ready(function() {
				$('#invalidoModal').modal('show');
			})
		</script>
	<?php } else { ?>
		<script>
			$(document).ready(function() {
				$('#invalidoModal').modal('show');
			})
		</script>
<?php
	}
}
