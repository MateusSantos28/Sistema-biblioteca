<?php
session_start();
//var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

include("conexao.php");

$select_usuarios = mysqli_query($conn, "SELECT * FROM USUARIOS WHERE usuario = '$usuario'");
while($usuarios = mysqli_fetch_assoc($select_usuarios)){
	
	if (password_verify($senha, $usuarios['senha'])) {
		$nivel_de_acesso_bd = $usuarios['nivel_de_acesso'];
		$_SESSION['acesso'] = 1;
		$_SESSION['nivel_de_acesso'] = $nivel_de_acesso_bd;
		header('Location: dashboard.php');
	} else {
		header('Location: login.php?login=false');
		exit;
	}

}

}
?>