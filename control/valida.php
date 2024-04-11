<?php 
// Inclui o arquivo com o sistema de segurança
require_once("seguranca.php");
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Salva duas variáveis com o que foi digitado no formulário
 // logMe($_POST['usuario']." - ". $_POST['senha'] . " : ".md5($_POST['senha']));
  
  $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
  $senha = (isset($_POST['senha'])) ? md5($_POST['senha']) : ''; 
 
 //logMe($_POST['usuario']." - ". $_POST['senha'] . " : ".$senha);

  // Utiliza uma função criada no seguranca.php pra validar os dados digitados
  if (validaUsuario($usuario, $senha) == true) {
    // O usuário e a senha digitados foram validados, manda pra página interna
    //echo "<br>login válido: ".$usuario;
	logMe("login válido: ".$usuario);
	//echo '<script>window.location.replace("/controle/pagto.php");</script>' ;	logMe("Location: /controle/pagto.php");
	//header("Location: /controle/pagto.php");	
	//header("Location: .$newURL.php");	die();
	header("Location: ../painel.php");
  } else {
    // O usuário e/ou a senha são inválidos, manda de volta pro form de login
    // Para alterar o endereço da página de login, verifique o arquivo seguranca.php
    // echo " <br>login inválido: ".$usuario;
	logMe("[ERRO] login inválido: ".$usuario);
     expulsaVisitante();
  }
} else {
     expulsaVisitante();

}
?>

