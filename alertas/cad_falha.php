<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados gravados com sucesso</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../css/stylecadastro.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    <header>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid ">
                <div class="navbar-header">
                    <a href="../index.html">
                        <img src="../assets/logo-alpha-driver-branco.png" alt="logo alpha driver">
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
                <div class="alert alert-danger">
                    <h3>Erro, dados não enviados! <br>
                        Volte para tela de cadastro <a href="../cadastro.php">clicando aqui.</a></h3>

                        <?php echo $smtp->error; ?> 
                </div>
            </div>
        </div>
    </div>
</main>
<footer>

</footer>
</body>
</html>