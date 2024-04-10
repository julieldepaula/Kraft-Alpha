<?php

require_once 'control/config.php';
if ($conexao === null) {
    die("Erro ao conectar ao banco de dados.");
}


if(isset($_POST['email']) || isset($_POST['senha']))
{
    if(strlen($_POST['email']) == 0){
        echo "Preencha seu e-mail!";
        
    }else if( strlen($_POST['senha']) == 0){
        echo "Preencha sua senha!";
   
    }else{
         
        $email = $conexao->real_escape_string($_POST['email']);
        $senha = $conexao->real_escape_string($_POST['senha']);
		echo $email."-".$senha;
		
        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND  senha = '$senha'";
        echo $sql_code;
		$sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1)  {

            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }
        
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['responsavel'];

        header("Location: painel.php");

        } else{
            echo "Falha ao logar! E-mail ou senha incorretos"; 
        }
    }
}


?>