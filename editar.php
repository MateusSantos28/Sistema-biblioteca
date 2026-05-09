<?php

if (isset($_GET['edit'])){
	$editar = $_GET['edit'];

	switch ($editar){
		case 'usuario':
			$id = $_POST['id'];
			$usuario = $_POST['usuario'];
			$senha = $_POST['senha'];

			include "conexao.php" ;

			if($senha == ""){
				
				$update_usuario = mysqli_query($conn, 
				"UPDATE usuarios SET usuario='$usuario' WHERE id='$id'");
				
			} else {
				
				$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
				
				$update_usuario = mysqli_query($conn, 
				"UPDATE usuarios SET usuario='$usuario', senha='$senha_hash' WHERE id='$id'");
				
			}

			if(mysqli_affected_rows($conn) == 1){
				//echo mysqli_affected_rows($conn);
				header('Location: listar_usuarios.php?process=true');
				
			}else if(mysqli_affected_rows($conn) == 0){	
				//echo mysqli_affected_rows($conn);
				header('Location: listar_usuarios.php?process=true');
				
			}else{
				header('Location: listar_usuarios.php?process=false');
			}
			break;

		case 'produto':
			$id = $_POST['id'];
			$nome = $_POST['nome'];
			$categoria = $_POST['categoria'];
			$preco = $_POST['preco'];
			$estoque = $_POST['estoque'];

			include "conexao.php" ;

			$update_produto = mysqli_query($conn, 
			"UPDATE produtos SET nome='$nome', categoria='$categoria', preco='$preco', estoque='$estoque' WHERE id='$id'");
				
			

			if(mysqli_affected_rows($conn) == 1){
				//echo mysqli_affected_rows($conn);
				header('Location: listar_produtos.php?process=true');
				
			}else if(mysqli_affected_rows($conn) == 0){	
				//echo mysqli_affected_rows($conn);
				header('Location: listar_produtos.php?process=true');
				
			}else{
				header('Location: listar_produtos.php?process=false');
			}
				break;

			case 'cliente':
			$id = $_POST['id'];
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$telefone = $_POST['telefone'];
			$cpf = $_POST['cpf'];

			if (strlen($telefone) < 10 || strlen($telefone) > 11) {
				header('Location: listar_clientes.php?process=false&error=telefone');
				exit;
			}
			if (strlen($cpf) != 11) {
				header('Location: listar_clientes.php?process=false&error=cpf');
				exit;
			}
			include "conexao.php" ;

			$update_cliente = mysqli_query($conn, 
			"UPDATE clientes SET nome='$nome', email='$email', telefone='$telefone', cpf='$cpf' WHERE id='$id'");

			if(mysqli_affected_rows($conn) == 1){
				//echo mysqli_affected_rows($conn);
				header('Location: listar_clientes.php?process=true');
				
			}else if(mysqli_affected_rows($conn) == 0){	
				//echo mysqli_affected_rows($conn);
				header('Location: listar_clientes.php?process=true');
				
			}else{
				header('Location: listar_clientes.php?process=false');
			}
			break;

	}
}

?>