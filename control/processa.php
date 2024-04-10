<?php
//cenectando ao banco
require_once 'config.php';

$empresa = filter_input(INPUT_POST, 'empresa');
$cnpj = filter_input(INPUT_POST, 'cnpj');
$responsavel = filter_input(INPUT_POST, 'responsavel');
$contato = filter_input(INPUT_POST, 'contato');
$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');
$confsenha = filter_input(INPUT_POST, 'confsenha');

//gravando dados com proteçao contra hacker
$smtp = $conexao->prepare("INSERT INTO usuarios (empresa, cnpj, responsavel, contato, email, senha, confsenha ) VALUES (?,?,?,?,?,?,?)");
$smtp -> bind_param("sssssss", $empresa, $cnpj, $responsavel, $contato, $email, $senha, $confsenha );

//testando se os dados foram salvos
if($smtp->execute())
{
    echo "Dados gravados";
}else{
    echo "Erro" .$smtp->error;
}

// fechando conexão
$smtp->close();
$conexao->close();

?>