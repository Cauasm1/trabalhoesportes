<?php
include_once "./config/config.php";
include_once "./classes/Usuarios.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuarios($db);
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $usuario->registrar($nome, $sexo, $fone, $email, $senha);
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

    <header>
        <h1>NEW SPORTS</h1>
    </header>

    <br>
    <br>

    <main class="container">
        <h1>Registrar-se</h1>
        <form method="POST">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" placeholder="Nome" required>
            <br>
            <br>
            <label for="sexo">Sexo: </label>
            <laber>Masculino</laber>
            <input type="radio" name="sexo" value="M" required>
            <label>Feminino</label>
            <input type="radio" name="sexo" value="F" required>
            <br>
            <br>
            <label for="telefone">Telefone: </label>
            <input type="text" name="fone" placeholder="Telefone" required>
            <br>
            <br>
            <label for="email">Email: </label>
            <input type="text" name="email" placeholder="Email" required>
            <br>
            <br>
            <label for="senha">Senha: </label>
            <input type="Password" name="senha" placeholder="Senha" required>
            <br>
            <br>
            <button class="card-header">Salvar</button>

        </form>
    </main>
    </div>

</body>

</html>