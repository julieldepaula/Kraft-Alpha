<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de cadastro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/stylecadastro.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


</head>
<body>
<header>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid ">
            <div class="navbar-header">
                <a href="index.html">
                    <img src="assets/logo-alpha-driver-branco.png" alt="logo alpha driver">
                </a>
               
            </div>


            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="" data-bs-toggle="modal" data-bs-target="#JanelaModal" ><span class="glyphicon glyphicon-earphone"></span> Contato</a></li>
                </ul>


                <div id="JanelaModal" class="modal" >
                    <div class="modal-dialog">
                        <div class="modal-content">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>

</header>
<hr>
<main>
    
    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    

                            <form method="POST" action="control/processa.php">
                                <fieldset class="">
                                    <legend>Formulario de Cadastro</legend>
                                    <br>
                                    <div class="mb-6">
                                        <label for="empresa">Nome da empresa</label>
                                        <input type="text" class="form-control" id="empresa" name="empresa" required>
                                    </div>
                                    <br>
                                    <div class="mb-6">
                                        <label for="cnpj">CNPJ</label>
                                        <input type=text class="form-control" id="cnpj" name="cnpj" required>
                                    </div>
                                    <br>
                                    <div class="mb-6">
                                        <label for="responsavel">Responsável (opecional ou logística)</label>
                                        <input type=text class="form-control" id="responsavel" name="responsavel" required>
                                    </div>
                                    <br>
                                    <div class="mb-6">
                                        <label for="contato">Contato</label>
                                        <input type=text class="form-control" id="contato" name="contato" required>
                                    </div>
                                    <br>
                                    <div class="mb-6">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" >
                                    </div>
                                    <br>
                                    <div class="mb-6">
                                        <label for="senha">Senha</label>
                                        <input type="password" class="form-control" id="senha" name="senha" >
                                    </div>
                                    <br>
                                    <div class="mb-6">
                                        <label for="confsenha">Confirme a senha</label>
                                        <input type="password" class="form-control" id="confsenha" name="confsenha" >
                                    </div>
                                    <br>
                                    <div class="mb-6">
                                    <input type="submit" nome="submit" id="submit" value="Cadastrar">
                                    <a href="index.html" class="btn btn-danger">Voltar</a>
                                    </div>
                                </fieldset>
                            </form>
                            <br>                        
                    
                </div>
            </div>
        </div>
</main>
<footer>

</footer>
</body>
</html>