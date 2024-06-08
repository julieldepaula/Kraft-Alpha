<?php
include ("control/header.php");
$tabela = "usuario";
$keySet = "nome, email, celular, secret, role";
$pageBack = "painel.php";

$nome = (isset($_SESSION['usuarioNome'])) ? $_SESSION['usuarioNome'] : "";
//logMe("acesso " .$nome. " - Listagem de alunos");
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços e escalas</title>
    <style>
        .iframe-container {
            width: 100%;
            height: 75vh;
            padding: 20px 0;
        }

        iframe {
            width: 100%; 
            height: 100%;
            border: none;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="iframe-container">
                    <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vShnFG5bOhWYJXpG4CYOnZrXyyiY2k6cVjjBHmxrAryI2xXMJWcXB8CHi1Rj4yGzZ8nTgWwh7GoXtCP/pubhtml?gid=1281034696&single=true&widget=true&headers=false"></iframe>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
