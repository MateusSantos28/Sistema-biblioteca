<?php
include("conexao.php");

$select_usuarios = mysqli_query($conn, "SELECT * FROM usuarios");
?>	
	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
	integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	
	<!-- Bootstrap Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	
	<!-- TABLE USUÁRIOS -->
	<div class="container">
		
		<h1>Listar usuários</h1>
		<a href="relatorio.php?param=usuarios" target="_blank">
			<button type="button" class="btn btn-outline-dark">
				<i class="bi bi-file-earmark-pdf"></i> Relatório
			</button>
		</a>
		<hr>
		
		<table class="table table-striped">
		  <thead>
			<tr>
			  <th scope="col">id</th>
			  <th scope="col">Usuario</th>
			  <th scope="col"></th>
			</tr>
		  </thead>
		  <tbody>
			<?php
			while ($usuarios = mysqli_fetch_assoc($select_usuarios)) {?>
				<tr>
				  <th scope="row"><?php echo $usuarios['id'];?></th>
				  <td><?php echo $usuarios['usuario'];?></td>
				  <td>
					<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" 
					data-bs-target="#editUserModal" data-bs-id="<?php echo $usuarios['id']?>" 
					data-bs-usuario="<?php echo $usuarios['usuario']?>"><i class="bi bi-pencil-square"></i></button>
					
					<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" 
					data-bs-target="#confirmDeleteModal" data-bs-id="<?php echo $usuarios['id']?>" 
					data-bs-usuario="<?php echo $usuarios['usuario']?>"><i class="bi bi-trash"></i></button>
				  </td>
				</tr>
			<?php
			};
			?>
		  </tbody>
		</table>
		
		
	</div>
	
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModal">Editar Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <form method="POST" action="editar.php?edit=usuario">
      <div class="modal-body">
		  <input type="hidden" id="userId" name="id" required>
          <div class="mb-3">
            <label for="userName" class="col-form-label">Usuário:</label>
            <input type="text" class="form-control" id="userName" name="usuario" required>
          </div>
          <div class="mb-3">
            <label for="userPassword" class="col-form-label">Senha:</label>
            <input type="password" class="form-control" id="userPassword" name="senha">
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
var editUserModal = document.getElementById('editUserModal')
console.log("MODAL: ", editUserModal)
editUserModal.addEventListener('show.bs.modal', function (event) {
	console.log("EVENTO: ", event);

  var button = event.relatedTarget
	console.log("BUTTON: ", button);

  var id = button.getAttribute('data-bs-id');
	console.log("ID: ", id);
	document.getElementById("userId").value = id;
	
  var usuario = button.getAttribute('data-bs-usuario');
	console.log("USUÁRIO: ", usuario);
	document.getElementById("userName").value = usuario;
  
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
	  <form method="POST" action="excluir.php?delete=usuario">
		  <div class="modal-body">
		  <input type="hidden" id="deleteUserId" name="id" required>
			Deseja excluir este usuário?
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
confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
	console.log("EVENTO: ", event);

  var button = event.relatedTarget
	console.log("BUTTON: ", button);

  var id = button.getAttribute('data-bs-id');
	console.log("ID: ", id);
	document.getElementById("deleteUserId").value = id;
	
  var usuario = button.getAttribute('data-bs-usuario');
	console.log("USUÁRIO: ", usuario);
	
  var modalTitle = confirmDeleteModal.querySelector('.modal-title')
  modalTitle.textContent = 'Excluir ' + usuario
  
})
</script>

<?php
if(isset($_GET['process'])){
	//var_dump($_GET);
	
	if($_GET['process'] === 'true'){?>
		<script>
			$(document).ready(function() {
				$('#sucessoModal').modal('show');
			})
		</script>
	<?php
	}else{?>
		<script>
			$(document).ready(function() {
				$('#erroModal').modal('show');
			})
		</script>
	<?php
	}
	
}else{
	
}
?>
