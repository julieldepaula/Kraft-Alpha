 
<html lang="en">
  <head>
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="cache-control" content="cache-control=no-cache">
		<?php header("cache-control:no-cache"); ?> 					<title>Escola On-line</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
		<style type="text/css">
			.wrapper{
				width: 650px;
				margin: 0 auto;
			}
			.page-header h2{
				margin-top: 0;
			}
			table tr td:last-child a{
				margin-right: 15px;
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();   
			});
		</script>
	</head>
	<body>
		<?php
		include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
		protegePagina();
		
		$nome = (isset($_SESSION['usuarioNome']))? $_SESSION['usuarioNome'] : "" ;
		//logMe("acesso " .$nome. " - Listagem de alunos");
		?>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span> 
					</button>
					<a class="navbar-brand" href="dashboard.php">Aula OnLine</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
				<?php $currentPage =  basename($_SERVER['SCRIPT_FILENAME']) ;  ?> 
				
					<ul class="nav navbar-nav">
						<li <? echo ($currentPage == "dashboard.php")? "class='active'": "";?> >
							<a href="dashboard.php">Home</a></li>
						<li <? echo ($currentPage == "list_alunos.php")? "class='active'": "";?> >
							<a href="list_alunos.php">Alunos</a></li>
						<li <? echo ($currentPage == "list_cursos.php")? "class='active'": "";?> >
							<a href="list_cursos.php">Cursos e Aulas</a></li> 
						<li <? echo ($currentPage == "list_pagtos.php")? "class='active'": "";?> >
							<a href="list_pagtos.php">Pagamentos</a></li> 
						<li <? echo ($currentPage == "list_emails.php")? "class='active'": "";?> >
							<a href="list_emails.php">emails</a></li> 
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php print($nome); ?> </a></li>
						<li><a href="../valida.php" ><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
