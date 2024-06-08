<?php 
include ("control/header.php");
	$tabela = "usuario";
	$keySet = "  nome, email, celular, secret, role ";
	$pageBack = "list_user.php";
include ("control/crud.php"); 
?>

         <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                       <h2 class="pull-left"><?php echo ucfirst(str_replace('view_', "", basename($_SERVER['SCRIPT_FILENAME'],'.php')));?> Detalhe</h2>
                    </div>
					
					
 					<div class="container-fluid">
						<div class="col-md-10">
						   <div class="form-group ">
								<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
									<label>Nome</label>
									<input type="text" onkeyup="this.value = this.value.toUpperCase();" name="nome" class="form-control" value="<?php echo $row['nome']; ?>">
								  <br />
								  <label for="celular">celular *</label>
								  <input type="text" name="celular" class="form-control" value="<?php echo $row['celular']; ?>"/>
								  <br />
								  <label for="Email">Email *</label>
								  <input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?>" />
								  <br />
								  <label for="secret">Senha</label>
								  <input type="password" name="secret" class="form-control" value="<?php echo $row['secret']; ?>" />
									<br />
								  <label for="comprovante">Role</label>
								  <input type="text" name="role" class="form-control" maxlength="2" size="2" value="<?php echo $row['role']; ?>" />
								  <br />
								  <input type="text" name="user_id" size=3 readonly value="<?php echo $_SESSION['usuarioID']; ?>" />
								  <input type="text" name="user_cadastro" readonly value="<?php echo $_SESSION['usuarioNome']; ?>" />
								  <input type="text" name="dt_registro" readonly value="<?php echo date("d/m/Y h:i:s", strtotime("now")); ?>" />
								  <br />
								  <br />

									<input type="hidden" name="id" value="<?php echo ($act == "new")? "0":$id; ?>"/>
									<br>
									<input type="hidden" name="act" value="<?php echo $act; ?>"/>
									
									<input type="submit" class="btn btn-primary" value="Enviar">
									<a href="<?php echo $pageBack; ?>" class="btn btn-default">Voltar</a>
								</form>
								
							</div>
						</div>	
 					</div>	
                </div>
            </div>        
		
		
