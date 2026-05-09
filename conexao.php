<?php
$servername = "sql112.infinityfree.com";
$username = "if0_41740296";
$password = "IhSRsdlyobdA";
$database = "if0_41740296_bd_ds2_2024";

$conn = mysqli_connect($servername,$username,$password,$database);

if($conn){
	//echo"Conexão realizada com sucesso!";
}else{
	die("Erro na conexão! ".mysqli_connect_error());
}
