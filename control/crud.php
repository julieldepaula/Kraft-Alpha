<?php
// Include config file
require_once("seguranca.php");
protegePagina();
 
// Define variables and initialize with values
	$act=""; 
	$id = "";

$dados = array();        
$currentPage =  basename($_SERVER['SCRIPT_FILENAME']) ;
$pgBack = (empty($pageBack))? "dashboard.php" : $pageBack ;

// Processing form data when form is submitted
if(isset($_POST["id"]) && (isset($_POST["act"]))){

    // Get hidden input value
    $id = $_POST["id"];
	$act = $_POST["act"];
	logMe($act. "=> ". $id);
    
	foreach($_POST as $key=>$val) {
		logMe($key . "=>" . $val ."-".strpos($keySet,$key));
		if ((strpos($keySet," ".$key))&& (strpos($keySet," ".$key) >= 0)){
				$dados[$key] = $val;
		}
	}
	
	if (persist($act, $tabela, $dados, $id)) {
		// Records updated successfully. Redirect to landing page
		header("location: ". $pgBack) ;
		exit();
			
	} else{
		$error_msg = "ERROR: Could not able to execute $sql. " . mysqli_error($_SG['link']);
		logMe($error_msg);
		header("location: ../error.php?error=".$error_msg);
	}

} else {
	$act=""; 
	$id = "";
	
    // Check existence of id parameter before processing further
    if(isset($_GET["update"]) && !empty(trim($_GET["update"]))){
        // Get URL parameter
        $id =  trim($_GET["update"]);
		$act = "update";
	}
    if(isset($_GET["delete"]) && !empty(trim($_GET["delete"]))){
        // Get URL parameter
        $id =  trim($_GET["delete"]);
		$act = "delete";
	}
    if(isset($_GET["new"]) && !empty(trim($_GET["new"]))){
        // Get URL parameter
        $act = "new";
		$id = "" ;
		if ($tabela == "token") {
			$row['aluno_id'] = trim($_GET["new"]);
		}
	}
    if(isset($_GET["read"]) && !empty(trim($_GET["read"]))){
        // Get URL parameter
        $id =  trim($_GET["read"]);
        $act = "read";
	}
	logMe($act."-> ".$id);
	
    if (!empty($id)) {  
		$row = getFromID ($tabela, $id);
		if (! $row ){
			$error_msg = "ERROR: Could not able to execute $sql. " . mysqli_error($_SG['link']);
			logMe($error_msg);
			header("location: ../error.php?error=".$error_msg);
		}
	}  else if (!($act == "new")){
		$error_msg = "Ação não definida - ".$act ;
		logMe($error_msg );
		header("location: ../error.php?error=".$error_msg);
		exit();
    } 
}


?>
 