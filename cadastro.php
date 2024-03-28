
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de cadastro</title>
    <link rel="stylesheet" href="stylecadastro.css">

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
    </div>

</header>
<hr>
<main>
    
    <div class="formulario-container">
        <form method="POST" action="processa.php">
            <fieldset>
                <legend>Formulario de Cadastro</legend>
                <br>
                <div class="input-group">
                    <label for="empresa">Nome da empresa</label>
                    <input type="text" id="empresa" name="empresa" required>
                </div>
                <br>
                <div class="input-group">
                    <label for="cnpj">CNPJ</label>
                    <input type=text id="cnpj" name="cnpj" required>
                </div>
                <br>
                <div class="input-group">
                    <label for="responsavel">Responsável (opecional ou logística)</label>
                    <input type=text id="responsavel" name="responsavel" required>
                </div>
                <br>
                <div class="input-group">
                    <label for="contato">Contato</label>
                    <input type=text id="contato" name="contato" required>
                </div>
                <br>
                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" >
                </div>
                <br>
                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" >
                </div>
                <br>
                <div class="input-group">
                    <label for="confsenha">Confirme a senha</label>
                    <input type="password" id="confsenha" name="confsenha" >
                </div>
                <br>
                
                <input type="submit" nome="submit" id="submit" value="Cadastrar">
            </fieldset>
        </form>
        <br>
        
    </div>
</main>
<footer>

</footer>
</body>
</html>