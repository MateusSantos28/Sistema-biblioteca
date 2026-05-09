<?php
include("conexao.php");

$select_usuarios = mysqli_query($conn, "SELECT COUNT(*) as id FROM usuarios");
$cont_usuarios = mysqli_fetch_assoc($select_usuarios);

$select_produtos = mysqli_query($conn, "SELECT COUNT(*) as id FROM produtos");
$cont_produtos = mysqli_fetch_assoc($select_produtos);

$select_clientes = mysqli_query($conn, "SELECT COUNT(*) as id FROM clientes");
$cont_clientes = mysqli_fetch_assoc($select_clientes);

?>	
	
	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
	integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	
	<!-- Bootstrap Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

	<!-- CARDS -->
		<div class="container">
			<div class="row">
			
				<div class="col-xl-2 col-md-4 mb-4">
					<div class="card border-left-primary shadow h-100 py-0">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col mr-2">
								  <div><h5>Usuários</h5></div>
								  <div class="text-primary"><b>
								  <?php
								  if(strlen($cont_usuarios['id']) == 1){
										echo '0'.$cont_usuarios['id'];
								  }else{
										echo $cont_usuarios['id'];
								  }
								  ?>
								  </b></div>
								</div>
								<div class="col-auto">
								  <i class="bi bi-person" style='font-size:26px;'></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-xl-2 col-md-4 mb-4">
					<div class="card border-left-primary shadow h-100 py-0">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col mr-2">
								  <div><h5>Produtos</h5></div>
								  <div class="text-primary">
									<b>
								<?php
								  if(strlen($cont_produtos['id']) == 1){
										echo '0'.$cont_produtos['id'];
								  }else{
										echo $cont_produtos['id'];
								  }
								  ?>
								</b>
								</div>
								</div>
								<div class="col-auto">
								  <i class="bi bi-boxes" style='font-size:26px;'></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-xl-2 col-md-4 mb-4">
					<div class="card border-left-primary shadow h-100 py-0">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col mr-2">
								  <div><h5>Clientes</h5></div>
								  <div class="text-primary">
									<b>
								<?php
								  if(strlen($cont_clientes['id']) == 1){
										echo '0'.$cont_clientes['id'];
								  }else{
										echo $cont_clientes['id'];
								  }
								  ?>
									</b>
								</div>
								</div>
								<div class="col-auto">
								  <i class="bi bi-people" style='font-size:26px;'></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<!-- CARDS -->