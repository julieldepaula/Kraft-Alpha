		<?php
        include ("control/header.php");
        $tabela = "usuario";
        $keySet = "  nome, email, celular, secret, role ";
        $pageBack = "";
        
		
		$nome = (isset($_SESSION['usuarioNome']))? $_SESSION['usuarioNome'] : "" ;
		//logMe("acesso " .$nome. " - Listagem de alunos");
		?>
<script>
function changeText(user_id, user_nome) {   
  $("#student_id").val(user_id);
  $("#user").val(user_nome);
  $("#form_modal").attr("action","view_empresa.php?delete="+user_id);
 }
</script>
<?php

/* session_start();
require_once 'control/seguranca.php';
//echo $_SESSION['nome'];
if((!isset($_SESSION['nome']) == true) and (!isset($_SESSION['id']) == true))
{
    unset($_SESSION['id']);
    unset($_SESSION['nome']);
    //unset($_SESSION['senha']);
    header('Location: index.html');
}
$logado = $_SESSION['nome'];
*/
//pegando no banco todas as infomaçãoes registradas
$sql = "SELECT * FROM empresas ORDER BY id ASC";
$result = mysqli_query($_SG['link'], $sql);
?>

    <div>
        <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Empresa</th>
            <th scope="col">CNPJ</th>
            <th scope="col">Responsavel</th>
            <th scope="col">Contato</th>
            <th scope="col">Email</th>
            <th scope="col"><a href="view_empresa.php?new=1" class="btn btn-success">Novo</a></th>
        </tr>
        </thead>
        <tbody>
            <?php
                while($user_data = mysqli_fetch_assoc($result))
                {
                    echo "<tr>";
                    echo "<td>".$user_data['id']."</td>";
                    echo "<td>".$user_data['empresa']."</td>";
                    echo "<td>".$user_data['cnpj']."</td>";
                    echo "<td>".$user_data['responsavel']."</td>";
                    echo "<td>".$user_data['contato']."</td>";
                    echo "<td>".$user_data['email']."</td>";
                    echo "<td>";
                    echo "<a href='view_empresa.php?update=". $user_data['id'] ."' title='editar' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                    
                    echo "<a href='#' onclick=\"changeText('".$user_data['id'] ."' , '".$user_data['empresa'] ."');\" data-toggle='modal' data-target='#myModal'><span class='glyphicon glyphicon-trash'></span></a>";

                    echo "</td>";
                    echo "</tr>";
                }
            ?>

        </tbody>
        </table>
    </div>

    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-lg">
      <div class="modal-header bg-primary text-dark">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Deletar Empresa?</h4>
      </div>
      <div class="modal-body">
		 <form method="post" id="form_modal"  action="" class="form-group">

		  <label for="user">ID:  </label>
		  <input type="text" size=3 name="id"  id="student_id" readonly />
          <br>
          <label for="user">Empresa:  </label>
		  <input type="text" id="user" name="student_name" readonly />
          <br>
          <input type="hidden" name="act" value="delete"/>

		  <button class="btn btn-danger" type="submit" >Deletar</button>
		  <button class="btn btn-default" type="button"  data-dismiss="modal">Fechar</button>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>
      </div>
    </div>

  </div>
  
</div>