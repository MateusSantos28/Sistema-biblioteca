<?php
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

include "conexao.php";

$param = $_GET['param'] ?? '';

$titulos = [
    'usuarios' => 'Tabela de Usuários',
    'produtos' => 'Tabela de Produtos',
    'clientes' => 'Tabela de Clientes'
];

$header = $titulos[$param] ?? 'Tabela';

ob_start();
?>
<style>
    .table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid black; padding: 8px; text-align: left; }
    .thead-light th { background-color: #f8f9fa; }
</style>

<body>
  <h1 style="text-align: center; margin: 15px;"><?= $header ?></h1>
  <hr>
  

  <div style="margin:15px;" class="table">
    <table class="table">
      <thead class="thead-light">
        <tr>
          <?php 
          switch ($param){
            case 'usuarios':
              echo '
                    <th style="background-color: white;border: 2px solid, black;" scope="col">ID</th>
                    <th style="background-color: white;border: 2px solid, black;" scope="col">Usuário</th>';
            break;
            case 'clientes':
              echo '
                    <th style="background-color: white;border: 2px solid, black;" scope="col">Nome</th>
                    <th style="background-color: white;border: 2px solid, black;" scope="col">Email</th>
                    <th style="background-color: white;border: 2px solid, black;" scope="col">Telefone</th>
                    <th style="background-color: white;border: 2px solid, black;" scope="col">Cpf</th>';
            break;
            case 'produtos':
              echo '
                    <th style="background-color: white;border: 2px solid, black;" scope="col">Nome</th>
                    <th style="background-color: white;border: 2px solid, black;" scope="col">Categoria</th>
                    <th style="background-color: white;border: 2px solid, black;" scope="col">Preço</th>
                    <th style="background-color: white;border: 2px solid, black;" scope="col">Estoque</th>';
            break;
            default:
                echo '<th colspan="4" style="border: 2px solid black;">Dados não identificados</th>';
            break;
            
          }
          ?>
          

        </tr>
      </thead>
      <tbody>
        <?php
        switch ($param) {
            case "usuarios":

                $sql    = "SELECT id, usuario FROM usuarios ORDER BY id ASC";
                $result_usuarios   = mysqli_query($conn, $sql);

                if ($result_usuarios && mysqli_num_rows($result_usuarios) > 0) {

                  while ($linha = mysqli_fetch_assoc($result_usuarios)) {
                      echo '<tr>';

                      echo '<td style="border: 1px solid black;">' . htmlspecialchars($linha['id']) . '</td>';
                      echo '<td style="border: 1px solid black;">' . htmlspecialchars($linha['usuario']) . '</td>';
                      echo '</tr>';
                  }

                } else {
                  echo '<tr>';
                  echo '<td colspan = 2  class=text-center>', "Nenhum usuário encontrado", '</td>';
                  echo '</tr>';
                };
                break; 
                
            case "clientes":

                $sql    = "SELECT nome, email, telefone, cpf FROM clientes ORDER BY id ASC";
                $result_clientes   = mysqli_query($conn, $sql);

                if ($result_clientes && mysqli_num_rows($result_clientes) > 0) {
                  while ($linha = mysqli_fetch_assoc($result_clientes)) {
                      echo '<tr>';
                      echo '<td style="border: 1px solid black;">' . htmlspecialchars($linha['nome']) . '</td>';
                      echo '<td style="border: 1px solid black;">' . htmlspecialchars($linha['email']) . '</td>';
                      echo '<td style="border: 1px solid black;">' . htmlspecialchars($linha['telefone']) . '</td>';
                      echo '<td style="border: 1px solid black;">' . htmlspecialchars($linha['cpf']) . '</td>';
                      echo '</tr>';
                  }

                } else {
                  echo '<tr>';
                  echo '<td colspan = 2  class=text-center>', "Nenhum cliente encontrado", '</td>';
                  echo '</tr>';
                };
                break;
            case "produtos":
                $sql    = "SELECT nome, categoria, preco, estoque FROM produtos ORDER BY id ASC";
                $result_produtos   = mysqli_query($conn, $sql);

                if ($result_produtos && mysqli_num_rows($result_produtos) > 0) {
                  while ($linha = mysqli_fetch_assoc($result_produtos)) {
                      echo '<tr>';
                      echo '<td style="border: 1px solid black;">' . htmlspecialchars($linha['nome']) . '</td>';
                      echo '<td style="border: 1px solid black;">' . htmlspecialchars($linha['categoria']) . '</td>';
                      echo '<td style="border: 1px solid black;">' . htmlspecialchars($linha['preco']) . '</td>';
                      echo '<td style="border: 1px solid black;">' . htmlspecialchars($linha['estoque']) . '</td>';
                      echo '</tr>';
                  }

                } else {
                  echo '<tr>';
                  echo '<td colspan = 2  class=text-center>', "Nenhum produto encontrado", '</td>';
                  echo '</tr>';
                };
                break;

                default:
                    echo '<tr><td colspan="4" style="text-align:center;">Parâmetro inválido ou tabela não encontrada.</td></tr>';
                break;
        }
        

        ?>
      </tbody>

    </table>

  </div>

<?php
$pagina = ob_get_clean();

$mpdf->WriteHTML($pagina);
$footer = "<p style='text-align:center;'>Desenvolvido por: Mateus Batista Bento dos Santos".date('Y')."</p>";
$mpdf->SetHTMLFooter($footer);

$mpdf->Output('lista_' . $param . '.pdf', \Mpdf\Output\Destination::INLINE);

