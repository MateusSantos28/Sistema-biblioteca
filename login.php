<?php
session_start();
?>

<!doctype html>
<html lang="pt-br">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<title>ACESSO AO SISTEMA!</title>

	<!-- Link para o Manifest -->
    	<link rel="manifest" href="manifest.json">

    	<!-- Cores de interface -->
    	<meta name="msapplication-TileColor" content="#ffffff">
    	<meta name="msapplication-TileImage" content="icon/192x.png">
    	<meta name="theme-color" content="#ffffff">
	
</head>

<script type="text/javascript">
	function redirectTime() {
		//window.location = "manutencao.php"
	}
</script>

<body onLoad="(redirectTime())" class="p-3 mb-2 bg-primary">

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-sm-6">
				<div class="card">
					<center><img src="imagens/logo.png" class="img-fluid" alt="..."></center>

					<center>
						<div class="card-body">
							<h5 class="card-title">Acesso ao Sistema</h5>

							<form method="POST" action="valida_login.php">

								<div class="form-floating mb-3">
									<input type="text" class="form-control" id="loginUser" name="usuario" placeholder="Usuário" required>
									<label for="floatingName">Usuário</label>
								</div>

								<div class="form-floating">
									<input type="password" class="form-control" id="loginPassword" name="senha" placeholder="Senha" required>
									<label for="floatingPassword">Senha</label>
								</div>
								</p>

								<input type="submit" class="btn btn-primary" value="Entrar">
								</p>

								<?php
								//retorno usuário ou senha inválido
								if ($_GET) {
									//var_dump($_GET);
									if (isset($_GET['login'])) {
										$login = $_GET['login'];
										if ($login == 'false') {
											echo '
											<div class="alert alert-danger" role="alert">
											  Usuário ou Senha Inválidos!
											</div>
											';
											header("Refresh:2;url=login.php");
										} else {
										}
									} else {
									};
								}

								//retorno proteção de acesso pela url
								if (isset($_SESSION['erro'])) {

									echo $_SESSION['erro'];

									session_destroy();

									echo
									'<script>
									setInterval(Refresh, 2000);

									function Refresh() {
									  window.location = "login.php";
									}
									</script>';
								} else {
									session_destroy();
								}

								?>

							</form>

						</div>
					</center>
				</div>
			</div>
		</div>
	</div>

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>