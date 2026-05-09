<?php
include("conexao.php");

$select_clientes = mysqli_query($conn, "SELECT * FROM clientes");
?>	
	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
	integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	
	<!-- Bootstrap Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	
	<!-- TABLE USUÁRIOS -->
	<div class="container">
		
		<h1>Lista de clientes</h1>
		<a href="relatorio.php?param=clientes" target="_blank">
			<button type="button" class="btn btn-outline-dark">
				<i class="bi bi-file-earmark-pdf"></i> Relatório
			</button>
		</a>
		<hr>
		
		<table class="table table-striped">
		  <thead>
			<tr>
			  <th scope="col">Nome</th>
			  <th scope="col">Email</th>
			  <th scope="col">Telefone</th>
			  <th scope="col">Cpf</th>
			  <th scope="col"></th>
			</tr>
		  </thead>
		  <tbody>
			<?php
			while($clientes = mysqli_fetch_assoc($select_clientes)){?>
				<tr>
				  <th scope="row"><?php echo $clientes['nome'];?></th>
				  <td><?php echo $clientes['email'];?></td>
				  <th scope="row"><?php echo $clientes['telefone'];?></th>
				  <td><?php echo $clientes['cpf'];?></td>
				  <td>
					<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" 
					data-bs-target="#editClientModal" 
					data-bs-id="<?php echo $clientes['id']?>" 
					data-bs-nome="<?php echo $clientes['nome']?>"
					data-bs-email="<?php echo $clientes['email']?>"
					data-bs-telefone="<?php echo $clientes['telefone']?>"
					data-bs-cpf="<?php echo $clientes['cpf']?>"
					><i class="bi bi-pencil-square"></i></button>
					
					<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" 
					data-bs-target="#confirmDeleteModal" data-bs-id="<?php echo $clientes['id']?>" 
					data-bs-nome="<?php echo $clientes['nome']?>"><i class="bi bi-trash"></i></button>
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
	
<div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editClientModal">Editar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <form method="POST" action="editar.php?edit=cliente">
      <div class="modal-body">
		  <input type="hidden" id="clientId" name="id" required>
          <div class="mb-3">
            <label for="clientName" class="col-form-label">Nome:</label>
            <input type="text" class="form-control" id="clientName" name="nome" required>
          </div>
          <div class="mb-3">
            <label for="clientEmail" class="col-form-label">Email:</label>
            <input type="email" class="form-control" id="clientEmail" name="email" required>
          </div>
		<div class="mb-3">
            <label for="clientPhone" class="col-form-label">Telefone:</label>
            <input type="text" class="form-control" id="clientPhone" name="telefone" required maxlength="11" minlength="10" pattern="[0-9]{10,11}">
          </div>
		<div class="mb-3">
            <label for="clientCpf" class="col-form-label">Cpf:</label>
            <input type="text" class="form-control" id="clientCpf" name="cpf" required maxlength="11" minlength="11" pattern="[0-9]{11}">
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
var editClientModal = document.getElementById('editClientModal')
console.log("MODAL: ", editClientModal)
editClientModal.addEventListener('show.bs.modal', function (event) {
	console.log("EVENTO: ", event);

  var button = event.relatedTarget
	console.log("BUTTON: ", button);

  var id = button.getAttribute('data-bs-id');
	console.log("ID: ", id);
	document.getElementById("clientId").value = id;
	
  var nome = button.getAttribute('data-bs-nome');
	console.log("NOME: ", nome);
	document.getElementById("clientName").value = nome;

  var email = button.getAttribute('data-bs-email');
	console.log("EMAIL: ", email);
	document.getElementById("clientEmail").value = email;

  var telefone = button.getAttribute('data-bs-telefone');
	console.log("TELEFONE: ", telefone);
	document.getElementById("clientPhone").value = telefone;

  var cpf = button.getAttribute('data-bs-cpf');
	console.log("CPF: ", cpf);
	document.getElementById("clientCpf").value = cpf;
  
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
	  <form method="POST" action="excluir.php?delete=cliente">
		  <div class="modal-body">
		  <input type="hidden" id="deleteClientId" name="id" required>
			Deseja excluir este cliente?
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
	document.getElementById("deleteClientId").value = id;
	
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
		} else {
			$error_msg = "Ocorreu um erro na operação!";
			if (isset($_GET['error'])) {
				if ($_GET['error'] === 'telefone') {
					$error_msg = "Telefone deve ter entre 10 e 11 dígitos.";
				} elseif ($_GET['error'] === 'cpf') {
					$error_msg = "CPF deve ter exatamente 11 dígitos.";
				}
			}
			?>
			<script>
				$(document).ready(function() {
					$('#erroModal .modal-body').text('<?php echo $error_msg; ?>');
					$('#erroModal').modal('show');
				})
			</script>
	<?php
		}
	} else {
	}
	?>

		
		
	