<?php
	if (isset($_GET['delete'])) {

	$permitidos = ['produto', 'cliente', 'usuario'];
	$delete = $_GET['delete'] ?? '';

	if (!in_array($delete, $permitidos)) {
		header('Location: dashboard.php?value=false');
		exit();
	}

	switch ($delete){
		case 'usuario':
			$id = $_POST['id'];
			include "conexao.php";
				
			$delete_query = mysqli_query($conn, 
			"DELETE FROM usuarios WHERE id = '$id'");

			if(mysqli_affected_rows($conn)){
				header('Location: listar_usuarios.php?process=true');
			}else{
				header('Location: listar_usuarios.php?process=false');
			}

			break;

		case 'produto':
			$id = $_POST['id'];
			include "conexao.php";
				
			$delete_query = mysqli_query($conn, 
			"DELETE FROM produtos WHERE id = '$id'");

			if(mysqli_affected_rows($conn)){
				header('Location: listar_produtos.php?process=true');
			}else{
				header('Location: listar_produtos.php?process=false');
			}
			break;

		case 'cliente':
			$id = $_POST['id'];
			include "conexao.php";
				
			$delete_query = mysqli_query($conn, 
			"DELETE FROM clientes WHERE id = '$id'");

			if(mysqli_affected_rows($conn)){
				header('Location: listar_clientes.php?process=true');
			}else{
				header('Location: listar_clientes.php?process=false');
			}
			break;
	}

} else {
	header('Location: dashboard.php?value=false');
	exit();
}


?>