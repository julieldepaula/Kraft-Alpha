<?php 
include ("control/header.php");
	$tabela = "empresas";
	$keySet = "  empresa, cnpj, responsavel, contato, email, senha ";
	$pageBack = "painel.php";
    include ("control/crud.php"); 
?>


<div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
    
                    <form method="POST" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>">
                        <fieldset>
                            <legend>Cadastro de carros</legend>
                            <br>
                            <div class="mb-6">
                                <label for="placa">Placa: </label>
                                <input type="text" class="form-control" id="placa" name="placa" value ="<?php echo $row['placa']; ?>" required>
                            </div>
                            <br>
                            <div class="mb-6">
                            <label for="Montadora">Montadora: </label>
                            <select class="form-control form-control-lg" id="Montadora" name="Montadora">
                            <option>Montadoras</option>
                            </select>
                                <label for="Modelo">Modelo: </label>
                                <input type=text class="form-control" id="Modelo" name="Modelo" value ="<?php echo $row['Modelo']; ?>" required>
                            </div>
                            <br>
                            <div class="mb-6">
                                <label for="fabricacao"> Ano Fabricação: </label>
                                <input type=text class="form-control" id="fabricacao" name="fabricacao" value ="<?php echo $row['fabricacao']; ?>" required>
                            </div>
                            <br>
                            <div class="mb-6">
                                <label for="anomodelo">Ano modelo: </label>
                                <input type=text class="form-control" id="anomodelo" name="anomodelo" value ="<?php echo $row['anomodelo']; ?>" required>
                            </div>
                            <br>
                            <div class="mb-6">
                                <label for="cor">Cor: </label>
                                <input type="email" class="form-control" id="cor" name="cor" value ="<?php echo $row['cor']; ?>" required>
                            </div>
                            <br>
                            <div class="mb-6">
                                <label for="valor_hora">Valor por hora: </label>
                                <input type="valor_hora" class="form-control" id="valor_hora" name="valor_hora" value ="<?php echo $row['valor_hora']; ?>" required>
                            </div>
                            <br>
                            <div class="mb-6">
                                <label for="valor_km">Valor por km: </label>
                                <input type="email" class="form-control" id="valor_km" name="valor_km" value ="<?php echo $row['valor_km']; ?>" required>
                            </div>
                            <br>

                            
                                    <input type="hidden" name="id" value="<?php echo ($act == "new")? "0":$id; ?>"/>
									<br>
									<input type="hidden" name="act" value="<?php echo $act; ?>"/>
									
									<input type="submit" class="btn btn-primary" value="Enviar">
									<a href="<?php echo $pageBack; ?>" class="btn btn-default">Voltar</a>
                        </fieldset>
                    </form>
                    <br>
                    </div>
            </div>
        </div>
    
