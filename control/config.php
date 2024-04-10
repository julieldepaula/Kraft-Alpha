<?php

    $dbhost = 'mysql.kraftsolutions.com.br';
    $dbUsername = 'kraftsolutions';
    $dbPassword = '683qvl6wwexd';
    $dbName = 'kraftsolutions';

    //conexão com o banco
    $conexao = new mysqli($dbhost, $dbUsername, $dbPassword, $dbName);

    
    // verificando conexão
    if($conexao -> connect_error)
    {
    die("Falha ao se conectar: ".$conn -> connect_error);
    }


?>