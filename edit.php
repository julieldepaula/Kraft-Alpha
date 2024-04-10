<?php
session_start();
require_once 'control/config.php';

if((!isset($_SESSION['nome']) == true) and (!isset($_SESSION['id']) == true))
{
    unset($_SESSION['id']);
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: index.html');
}

if(!empty($_GET['id']))
{
    $id = $_GET['id'];

    //pegando no banco todas as infomaçãoes registradas
    $sql = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conexao->query($sql);

    if($result -> num_rows > 0)
    {
        while($user_data = mysqli_fetch_assoc($result))
        {

        $empresa = $user_data['empresa'];
        $cnpj = $user_data['cnpj'];
        $responsavel = $user_data['responsavel'];
        $contato = $user_data['contato'];
        $email = $user_data['email'];
        $senha = $user_data['senha'];
        $confsenha = $user_data['confsenha'];

        }
        
    }
    else{ header( 'Location: painel.php' ); }

    




}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/stylecadastro.css">

</head>
<body>
<header class="banner">
    <div class="logo">
        <h3>Logo</h3>
    </div>
    <div>
        <h1>Sistema Alpha Driver</h1>
    </div>
    <div class="menu-usuario">
        <h3>Menu usuário</h3>
        <a href="painel.php"> Voltar</a>
    </div>

</header>
<main>
    
    <div class="formulario-container">
        <form method="POST" action="processa.php">
            <fieldset>
                <legend>Formulario de Cadastro</legend>
                <br>
                <div class="input-group">
                    <label for="empresa">Nome da empresa</label>
                    <input type="text" id="empresa" name="empresa" value ="<?php echo $empresa ?>" required>
                </div>
                <br>
                <div class="input-group">
                    <label for="cnpj">CNPJ</label>
                    <input type=text id="cnpj" name="cnpj" value ="<?php echo $empresa ?>" required>
                </div>
                <br>
                <div class="input-group">
                    <label for="responsavel">Responsável (operacional ou logística)</label>
                    <input type=text id="responsavel" name="responsavel" value ="<?php echo $responsavel ?>" required>
                </div>
                <br>
                <div class="input-group">
                    <label for="contato">Contato</label>
                    <input type=text id="contato" name="contato" value ="<?php echo $contato ?>" required>
                </div>
                <br>
                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" value ="<?php echo $email ?>" required>
                </div>
                <br>
                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" value ="<?php echo $senha ?>" required>
                </div>
                <br>
                <div class="input-group">
                    <label for="confsenha">Confirme a senha</label>
                    <input type="password" id="confsenha" name="confsenha" value ="<?php echo $confsenha ?>" required>
                </div>
                <br>
                
                <input type="submit" nome="submit" id="submit" value="Salvar">
            </fieldset>
        </form>
        <br>
        
    </div>
</main>
<footer>

</footer>
</body>
</html>