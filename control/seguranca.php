<?php header("cache-control: no-cache"); ?> 
<?php
/**
* Sistema de segurança com acesso restrito
*
* Usado para restringir o acesso de certas páginas do seu site
*
*
* @version 1.0
* @package SistemaSeguranca
*/
//  Configurações do Script
// ==============================
$_SG['conectaServidor'] = true;    // Abre uma conexão com o servidor MySQL?
$_SG['abreSessao'] = true;         // Inicia a sessão com um session_start()?
$_SG['caseSensitive'] = false;     // Usar case-sensitive? Onde 'thiago' é diferente de 'THIAGO'
$_SG['validaSempre'] = true;       // Deseja validar o usuário e a senha a cada carregamento de página?

// Evita que, ao mudar os dados do usuário no banco de dado o mesmo contiue logado.
$_SG['servidor'] = 'localhost';    // Servidor MySQL
$_SG['usuario'] = 'uzjeiu16yzhey';          // Usuário MySQL
$_SG['senha'] = '683qvl6wwexd';                // Senha MySQL
$_SG['banco'] = 'dbv6oy5vcjxk6f';            // Banco de dados MySQL
$_SG['paginaLogin'] = '/controle/login.html'; // Página de login
$_SG['tabela'] = 'usuario';       // Nome da tabela onde os usuários são salvos
// ==============================
$default_from = "curso@luciferianismo.org.br"; // Deve ser um email válido do domínio
$default_emailto = "reisla.rodrigues@gmail.com";


// Verifica se precisa fazer a conexão com o MySQL
//$conexao = mysqli_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha'], $_SG['banco']);

if ($_SG['conectaServidor'] == true) {
//  logMe($_SG['servidor']."-".$_SG['usuario']."-". $_SG['senha']);
  $_SG['link'] = mysqli_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha'], $_SG['banco']);

  /** // versão anterior a php 7.0
  $_SG['link'] = mysqli_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) or die( logMe("MySQL: Não foi possível conectar-se ao servidor [".$_SG['servidor']."]."));
  if ( !$_SG['link']) logMe("MySQL: Não foi possível conectar-se ao servidor [".$_SG['servidor']."].");
  mysqli_select_db($_SG['banco'], $_SG['link']) or die( logMe("MySQL: Não foi possível conectar-se ao banco de dados [".$_SG['banco']."]."));
  */
  
  if (!$_SG['link']) { logMe("MySQL: Não foi possível conectar-se ao servidor [".$_SG['servidor']."]."); }
	; // else  logMe ("<br>conexão efetuada");
}
// Verifica se precisa iniciar a sessão
if ($_SG['abreSessao'] == true)
  session_start();

/**
* Função que valida um usuário e senha
*
* @param string $usuario - O usuário a ser validado
* @param string $senha - A senha a ser validada
*
* @return bool - Se o usuário foi validado ou não (true/false)
*/
function validaUsuario($usuario, $senha) {
  global $_SG;
  $cS = ($_SG['caseSensitive']) ? 'BINARY' : '';
  // Usa a função addslashes para escapar as aspas
  $nusuario = addslashes($usuario);
  $nsenha = addslashes($senha);
  // Monta uma consulta SQL (query) para procurar um usuário
 // $sql = "SELECT * FROM usuario` WHERE  nome = '".$nusuario."' AND  secret = '".$nsenha."' LIMIT 1";
	$sql = "SELECT * FROM `usuario` WHERE `nome`= '".$nusuario."' AND `secret` = '".$nsenha."' ";
//  $query = mysql_query($sql);
   
  
  //$result = mysql_query($sql);
	$result = mysqli_query($_SG['link'], $sql);
	//logMe("<br>consulta efetuada"); 
  
if (!$result) {
    logMe ("<br>Could not successfully run query ($sql) from DB: " . mysqli_error());
   return false;
}

if (mysqli_num_rows($result) == 0) {
    logMe ("usuário não encontrado: ".$usuario);
    return false;
}
//$resultado = ""; //mysql_fetch_assoc($query);

	$resultado = mysqli_fetch_assoc($result);
   // logMe( $sql."\r\n".$resultado["id"]. "-".$resultado["nome"].$resultado["secret"]);

// Verifica se encontrou algum registro
  if (empty($resultado)) {
    // Nenhum registro foi encontrado => o usuário é inválido
    logMe ("usuário não encontrado: ".$usuario);
   return false;
  } else {
//	logMe("<br>usuario validado: ".$resultado['nome']);
	// Definimos dois valores na sessão com os dados do usuário
    $_SESSION['usuarioID'] = $resultado['id']; // Pega o valor da coluna 'id do registro encontrado no MySQL
    $_SESSION['usuarioNome'] = $resultado['nome']; // Pega o valor da coluna 'nome' do registro encontrado no MySQL
    $_SESSION['usuarioRole'] = $resultado['role']; // Pega o valor da coluna 'role' do registro encontrado no MySQL
    $_SESSION['email'] = $resultado['email']; // Pega o valor da coluna 'nome' do registro encontrado no MySQL
    // Verifica a opção se sempre validar o login
    if ($_SG['validaSempre'] == true) {
      // Definimos dois valores na sessão com os dados do login
      $_SESSION['usuarioLogin'] = $usuario;
      $_SESSION['usuarioSenha'] = $senha;
    }

    return true;
  }
}

/**
* Função que protege uma página
*/
function protegePagina() {
  global $_SG;
  if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
    // Não há usuário logado, manda pra página de login
		logMe( "protege pagina: Não há usuário ativo.");
        expulsaVisitante();
  } else 
	if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
		// Há usuário logado, verifica se precisa validar o login novamente
		logMe( "protege pagina: usuário ".$_SESSION['usuarioNome']." - role: ".$_SESSION['usuarioRole']);
		if ($_SG['validaSempre'] == true) {
			// Verifica se os dados salvos na sessão batem com os dados do banco de dados
			if (!validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])) {
				// Os dados não batem, manda pra tela de login
				logMe( "protege pagina: login inválido");
				expulsaVisitante();
			}
		}
	}
}
/**
* Função para expulsar um visitante
*/
function expulsaVisitante() {
  global $_SG;
  // Remove as variáveis da sessão (caso elas existam)
  logMe("logout - ".$_SESSION['usuarioNome']);   
  
  unset(	$_SESSION['usuarioID'] ,     $_SESSION['usuarioNome'], 
    $_SESSION['usuarioEmail'] , $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);
	

  // Manda pra tela de login
  header("Location: ".$_SG['paginaLogin']);
}

/**
* Função para validar o TOKen e dar acesso a aula
*/
function validaToken($token) {
  global $_SG;
  $cS = ($_SG['caseSensitive']) ? 'BINARY' : '';
  // Usa a função addslashes para escapar as aspas
  $ntoken = addslashes($token);
  // Monta uma consulta SQL (query) para procurar um usuário
  $sql = "SELECT a.*, b.nome as nome, b.email as email, c.id as aula_id, c.titulo as titulo, c.tipo as tipo, c.file_link as file_link";
  $sql .= " FROM token a JOIN aluno b on a.aluno_id = b.id";
  $sql .= " JOIN aula c on a.aula_id = c.id";
  $sql .= " WHERE a.id = '".$ntoken."'";
 // $query = mysql_query($sql);
//  $result = mysql_query($sql);
  $result = mysqli_query($_SG['link'], $sql);

 // logMe("<br>consulta efetuada");  

if (!$result) {
    logMe("<br>Could not successfully run query ($sql) from DB: " . mysqli_error());
   return false;
}

if (mysqli_num_rows($result) == 0) {
    logMe("<br>No rows found, nothing to print so am exiting");
    return false;
}
//$resultado = ""; //mysql_fetch_assoc($query);

	$resultado = mysqli_fetch_assoc($result);
    //echo "<br>".$resultado["id"];
    //echo "-".$resultado["nome"];

// Verifica se encontrou algum registro
  if (empty($resultado)) {
    // Nenhum registro foi encontrado => o usuário é inválido
	logMe ( "<br>nenhum registro encontrado");
    return false;
  } else {
	  
	logMe("<br>ACESSO AUTORIZADO: ".$resultado['nome']);
	// Definimos valores na sessão com os dados do usuário
	$arquivo = "";
 	foreach($resultado as $key => $value ){
	   $_SESSION[$key] = $value;
	   $arquivo .= $key.'='.$value."\r\n";
	}
	/**
	logMe($arquivo);
*/	
	$_SESSION['usuarioID'] = $resultado['id']; // Pega o valor da coluna 'id 
    $_SESSION['usuarioNome'] = $resultado['nome']; // Pega o valor da coluna 'nome' 
    $_SESSION['usuarioEmail'] = $resultado['email']; // Pega o valor da coluna 
/**
    $_SESSION['aula_id'] = $resultado['aula_id']; // Pega o valor da coluna 
    $_SESSION['aula_titulo'] = $resultado['titulo']; // Pega o valor da coluna 
    $_SESSION['aula_tipo'] = $resultado['tipo']; // Pega o valor da coluna 'nome' 
    $_SESSION['aula_link'] = $resultado['file_link']; // Pega o valor da coluna 
	*/

    return true;
  }
}

//-- log por txt
function logMe($msg){
// Abre ou cria o arquivo bloco1.txt
// "a" representa que o arquivo é aberto para ser escrito
$fp = fopen("log.txt", "a");
$ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
$hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
$currentPage =  basename($_SERVER['SCRIPT_FILENAME']) ;

// Escreve a mensagem passada através da variável $msg
$escreve = fwrite($fp, $hora." - ".$ip." - ".$_SESSION['usuarioID']. " - ".$_SESSION['usuarioNome']." - ".$currentPage." - ".$msg);
$escreve = fwrite($fp, "\r\n");

// Fecha o arquivo
fclose($fp); 
}

function getFromID ($tab, $id) {

	global $_SG;
	$sql = "SELECT * FROM ".$tab." WHERE id = ". $id; 

	
	if((!empty($sql))&&($result = mysqli_query($_SG['link'], $sql))){
	
		if (mysqli_num_rows($result) == 0) return "sem resultados: ";
		
		$resultado = mysqli_fetch_assoc($result);
		
		if (empty($resultado)) {
			logMe ("usuário não encontrado: ");
		   return false;
		  } else return $resultado;	
	  
	} else {
		logMe( "erro de conexão: ".$sql."-".mysqli_error($_SG['link']));
		return false;
 }
 
}
function getFromClause ($tab, $clause) {

	global $_SG;
	$sql = "SELECT * FROM ".$tab." WHERE ". $clause; 

	
	if($result = mysqli_query($_SG['link'], $sql)){
	
		if (mysqli_num_rows($result) == 0) return "sem resultados: ";

 		
		$resultado = mysqli_fetch_assoc($result);
		//while($row = mysqli_fetch_array($result)){
		if (empty($resultado)) {
			logMe ("usuário não encontrado: ");
		   return false;
		  } 
		  else return $resultado;	
	  
	} else {
		logMe( "erro de conexão: ".$sql."-".mysqli_error($_SG['link']));
		return false;
 }
 
}

function getOptions($table, $fields, $value = "", $condition = "", $orderby = "") {

	global $_SG;
	$htlm = "";
	
  // Monta uma consulta SQL (query) para procurar um usuário
	$sql = "SELECT id, ".$fields." FROM `".$table."` ";
	if (!empty($condition)) $sql .= " WHERE $condition";
	if (!empty($orderby)) $sql .= " ORDER BY $orderby";
	logMe($sql);
	
	if($result = mysqli_query($_SG['link'], $sql)){
		if(mysqli_num_rows($result) > 0){
//			logMe("Resultados: ".mysqli_num_rows($result));
			
			$desc = explode(", ",$fields);
			while( $row = mysqli_fetch_array($result)){
				$html .= "<option value='".$row['id']."' ";
				$html .= ($row['id'] == $value)? " selected " :""; 
				$html .= ">";
				for ($k=0; $k < sizeof($desc); $k++) {
					$html .=  ($k>0)?"-":"";
					$html .= $row[$desc[$k]];
					//logMe($desc[$k]."-".$row[$desc[$k]]);
				}
				$html .=  "</option> \r\n";
			}	
			
			// Free result set
			mysqli_free_result($result);
			
			return $html;
		} else	{
			logMe( "<p class='lead'><em>No records were found.</em></p>");
			return false;
			
		} 
	} else  {
		logMe( "ERROR: Could not able to execute ". $sql. "- " . mysqli_error($_SG['link']));
		return false;
	}
	
}

function persist($act, $i_tabela, $i_dados, $i_id){
	global $_SG;
	$sql = "";

	switch ($act) {
		case "update" :
			$dados = "";
			foreach($i_dados as $key=>$val) {
				if (strlen($dados) > 1) $dados .= ", "; // $fields .= ", "; $values .= ", "; 
				
				$dados .= "`".$key . "` = ";
				if (is_numeric($val)){
					$dados .= $val;
				} else { 
					$dados .= "'".$val."'";
				}
			}
			//logMe("dados: ".$dados);
			$sql = "UPDATE  `".$i_tabela."` SET ".$dados . " WHERE `id`=".$i_id;
			
			break;

		case "delete" :
			$sql = "DELETE FROM `".$i_tabela."` WHERE `id`=".$i_id;
			break;

		case "new":
			$fields = $values = "";
			foreach($i_dados as $key=>$val) {
				if (strlen($fields) > 1) { $fields .= ", "; $values .= ", "; } 
				
				$fields .= "`".$key . "`";
				if (is_numeric($val)){
					$values .= $val;
				} else { 
					$values .= "'".$val."'";
				}
			}
			//logMe("fields: ".$fields);
			//logMe("values: ".$values);
			
		    $sql = "INSERT INTO `".$i_tabela."`( $fields ) VALUES ( $values );";
			break;
 
		default:
           $sql = "";
		   break;
		}		

		logMe($sql);
		
        if((!empty($sql))&&($result = mysqli_query($_SG['link'], $sql))){
 			return true;
			
        } else {
			$error_msg = "ERROR: Could not able to execute $sql. " . mysqli_error($_SG['link']);
			logMe($error_msg);
            return false;
        }
     
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function mailTo($to_id, $mensagem, $tokenID =""){
  global $_SG;

//Variáveis
$default_emailto = $_SG['defaultemail'];
$default_from = $_SG['emailfrom'] ; 

  $aluno = getFromID("aluno", $to_id);
  //echo $row['aluno_id']." - ". $aluno[ "nome"] ; 

$nome = $aluno["nome"];
$email = $aluno['email'];


$emailto = (!empty($email)) ? $email: $default_emailto; 
//$emailfrom = (isset($_POST['emailfrom'])) ? $_POST['emailfrom']: $default_from; 

$data_envio = date('d/m/Y');
$hora_envio = date('H:i:s');

// emails para quem será enviado o formulário
  $assunto = "Contato pelo Site";
 
 
 /* Cabeçalho da mensagem  */
	$boundary = "XYZ-" . date("dmYis") . "-ZYX";
	$headers = "MIME-Version: 1.0\n";
	$headers.= "From: $emailfrom\n";
	$headers.= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";  
	$headers.= ". \n"; //"$boundary\n"; 
	  
// Compo E-mail
  $arquivo  = "Nome: " . $nome . " \r\n";
  $arquivo .= "E-mail: " . $email . "  \r\n";
  $arquivo .= "Mensagem: " . $mensagem . " \r\n";
  $arquivo .= "\r\n";
  
  if (!empty($tokenID)) {
	
  
  }
  
  $arquivo .= "Este e-mail foi enviado em " . $data_envio;
  $arquivo .= " às " . $hora_envio . " \r\n";
  $arquivo .= "\r\n";
  $arquivo .= "\r\n";
  

  //enviar
  logMe($emailto."\r\n".$assunto."\r\n".$headers."\r\n".$arquivo);

  $enviaremail = mail($emailto, $assunto, $arquivo, $headers);
  
 $mgm = "";
 
 if($enviaremail){
  $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> ";
    } else {
  $mgm = "ERRO AO ENVIAR E-MAIL! <br> " ;
   $errorMessage = error_get_last()['message'];
   $mgm .=  $errorMessage . "<br>"; 
  
    }

  echo $mgm;

}