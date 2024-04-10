<?php
session_start();
require_once 'control/config.php';
//echo $_SESSION['nome'];
if((!isset($_SESSION['nome']) == true) and (!isset($_SESSION['id']) == true))
{
    unset($_SESSION['id']);
    unset($_SESSION['nome']);
    //unset($_SESSION['senha']);
    header('Location: index.html');
}
$logado = $_SESSION['nome'];

//pegando no banco todas as infomaçãoes registradas
$sql = "SELECT * FROM usuarios ORDER BY id ASC";

$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paniel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/stylelogin.css">
    
</head>
<body>
<header class="banner">
    <div class="logo">
        <h3>Logo</h3>
    </div>
    <div>
        <h1><?php echo "Bem vindo " .$logado?> </h1>
    </div>
    <div class="menu-usuario">
        <h3>Menu usuário</h3>
        <br>
        <a href="logout.php"> Sair</a>
    </div>

</header>
<main>
    <div>
        <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Empresa</th>
            <th scope="col">CNPJ</th>
            <th scope="col">Responsavel</th>
            <th scope="col">Contato</th>
            <th scope="col">Email</th>
            <th scope="col">...</th>
        </tr>
        </thead>
        <tbody>
            <?php
                while($user_data = mysqli_fetch_assoc($result))
                {
                    echo "<tr>";
                    echo "<td>".$user_data['id']."</td>";
                    echo "<td>".$user_data['empresa']."</td>";
                    echo "<td>".$user_data['cnpj']."</td>";
                    echo "<td>".$user_data['responsavel']."</td>";
                    echo "<td>".$user_data['contato']."</td>";
                    echo "<td>".$user_data['email']."</td>";
                    echo "<td> <a class= 'btn btn-sm btn-primary' href='edit.php?id=$user_data[id]'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                        <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325'/>
                        </svg>
                        </a>
                        <a class= 'btn btn-sm btn-danger' href='#'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                        <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/>
                        <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/>
                        </svg>
                        </a>
                    </td>";
                    echo "</tr>";
                }
            ?>

        </tbody>
        </table>
    </div>
</main>
</body>