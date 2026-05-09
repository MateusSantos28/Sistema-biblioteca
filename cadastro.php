<?php
$permitidos = ['produto', 'cliente', 'usuario'];
$cadastro = $_GET['cad'] ?? '';

if (!in_array($cadastro, $permitidos)) {
	header('Location: dashboard.php?value=false');
	exit();
}
if (!isset($_POST)){
	header('Location: dashboard.php?value=false');
	exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	

	switch ($cadastro ?? '') {
		case 'usuario':
			
			//Filtrar com SANITAZE
			$filter= array_fill_keys(array_keys($_POST), FILTER_SANITIZE_SPECIAL_CHARS);
			$postLimpo = filter_input_array(INPUT_POST, $filter);

			$usuario = $postLimpo['usuario'];
			$senha = $postLimpo['senha'];

			include "conexao.php";

			$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

			$i = 0;
			while ($i < 10) {
				$insert_usuario = mysqli_query($conn, "INSERT INTO usuarios (usuario,senha) VALUES ('$usuario','$senha_hash');");
				$i++;
			}
			if(mysqli_insert_id($conn)){
				header('Location: dashboard.php?insert=true');
			}else{
				header('Location: dashboard.php?insert=false');
			}

				break;

		case 'produto':

			//Filtrar com SANITAZE
			$filter= array_fill_keys(array_keys($_POST), FILTER_SANITIZE_SPECIAL_CHARS);
			$postLimpo = filter_input_array(INPUT_POST, $filter);

			$nome = $postLimpo['nome'];
			$preco = $postLimpo['preco'];
			$categoria = $postLimpo['categoria'];
			$estoque = $postLimpo['estoque'];
			
			include "conexao.php";

			$i = 0;
			while ($i < 10) {
				$insert_produto = mysqli_query($conn, "INSERT INTO produtos (nome, preco, categoria, estoque) VALUES ('$nome','$preco','$categoria','$estoque');");
				$i++;
			}
			
			if(mysqli_insert_id($conn)){
				header('Location: dashboard.php?insert=true');
			}else{
				header('Location: dashboard.php?insert=false');
			}
				break;

		case 'cliente':

			//Filtrar com SANITAZE
			$filter= array_fill_keys(array_keys($_POST), FILTER_SANITIZE_SPECIAL_CHARS);
			$postLimpo = filter_input_array(INPUT_POST, $filter);

			$nome = $postLimpo['nome'];
			$email = $postLimpo['email'];
			$telefone = $postLimpo['telefone'];
			$cpf = $postLimpo['cpf'];

			if (strlen($telefone) < 10 || strlen($telefone) > 11) {
				header('Location: dashboard.php?insert=false');
				exit;
			}

			if (strlen($cpf) != 11) {
				header('Location: dashboard.php?insert=false');
				exit;
			}
			
			include "conexao.php";
			$i = 0;
			while ($i < 10) {
				$insert_cliente = mysqli_query($conn, "INSERT INTO clientes (nome, email, telefone, cpf) VALUES ('$nome','$email','$telefone','$cpf');");
				$i++;
			}

			if(mysqli_insert_id($conn)){
				header('Location: dashboard.php?insert=true');
			}else{
				header('Location: dashboard.php?insert=false');
			}
				break;
				

			
	}

} 





