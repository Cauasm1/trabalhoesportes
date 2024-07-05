<?php
include_once "./config/config.php";
include_once "./classes/Usuarios.php";

if($_SERVER['REQUEST_METHOD']==='POST'){
    $usuario = new Usuarios($db);
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $usuario->registrar($nome, $email, $senha);
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Usuario</title>
    <link rel="stylesheet" href="registrar.css">
</head>
<body>
   


    <main class="container-star">
    <h1>Registrar-se</h1>
    <form method ="POST">
        <input type = "text" name = "nome" placeholder= "nome" required>
        <br>
        <br>
        <input type = "text" name = "email" placeholder= "email" required>
        <br>
        <br>
        <input type = "Password" name = "senha" placeholder= "senha" required>
        <br>
        <br>
        <!-- <input type = "submit" value="Salvar"> -->
        <button class="button">Salvar</button>

    </form>
</main>
</div>

</body>
</html>