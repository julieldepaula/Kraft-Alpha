<?php

    $dbhost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'formulario-cadastro';

    //conexão com o banco
    $conexao = new mysqLi($dbhost, $dbUsername, $dbPassword, $dbName);
    
    // verificando conexão
    if($conexao -> connect_error)
    {
    die("Falha ao se conectar: ".$conn -> connect_error);
    }


?>