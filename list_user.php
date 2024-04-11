<?php include ("control/header.php") ?>
<script>
function changeText(user_id, user_nome) {   
  $("#student_id").val(user_id);
  $("#user").val(user_nome);
  $("#form_modal").attr("action","view_user.php?delete="+user_id);
 }
</script>
		 
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">lista de usuários</h2>
                        <a href="view_user.php?new=1" class="btn btn-success pull-right">Novo</a>
                    </div>
                    <?php
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM usuario order by nome";
                    if($result = mysqli_query($_SG['link'], $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nome</th>";
                                        echo "<th>email</th>";
                                        echo "<th>celular</th>";
                                        echo "<th>role</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        
										echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" ;
										echo "<a href='view_user.php?update=". $row['id'] ."' title='View Record' data-toggle='tooltip'>";
										echo $row['nome'] . "</a></td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['celular'] . "</td>";
                                        echo "<td>" . $row['role'] . "</td>";
										
                                        echo "<td>";
                                            echo "<a href='view_user.php?update=". $row['id'] ."' title='editar' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
											
 											echo "<a href='#' onclick=\"changeText('".$row['id'] ."' , '".$row['nome'] ."');\" data-toggle='modal' data-target='#myModal'><span class='glyphicon glyphicon-trash'></span></a>";

                                         echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($_SG['link']);
                    }
 
                    // Close connection
                   // mysqli_close($_SG['link']);
                    ?>
                </div>
            </div>        
        </div>
<!-- Trigger the modal with a button 
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
-->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Deletar Usuário?</h4>
      </div>
      <div class="modal-body">
		 <form method="post" id="form_modal"  action="" class="form-group">

		  <label for="user">Usuário</label>
		  <input type="text" size=3 name="id"  id="student_id" readonly /> - 
		  <input type="text" id="user" name="student_name" readonly />
          <input type="hidden" name="act" value="delete"/>

		  <button type="submit" class="btn btn-default">deletar</button>
		  <button type="button" class="btn btn-default" data-dismiss="modal">fechar</button>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">fechar</button>
      </div>
    </div>

  </div>
  
</div>

	</body>
</html>
