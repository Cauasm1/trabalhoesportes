<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header('Location: login.php');
    exit();
}
include_once './config/config.php';
include_once './classes/Usuarios.php';

$Usuario = new Usuarios($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $Usuario->atualizar($id, $nome, $sexo, $fone, $email);
    header('Location: menu.php');
    exit();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = $Usuario->lerPorId($id);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <div>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Usuário</title>
        <link rel="stylesheet" href="editar.css">
</head>

<body>

    <header>
        <h1>NEW SPORTS</h1>
    </header>

    <br>
    <br>

    <div class="container">

        <h1>Editar Usuário</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="name">Nome:</label>
            <input type="text" name="nome" value="<?php echo $row['nome']; ?>" required>
            <br>
            <br>
            <br>
            <label>Sexo:</label>
            <label for="Masculino_editar">
                <input type="radio" id="Masculino_editar" name="sexo" value="M" <?php echo ($row['sexo'] === 'M') ? 'checked' : ''; ?> required>Masculino</label>
            <label for="feminino_editar">
                <input type="radio" id="feminino_editar" name="sexo" value="F" <?php echo ($row['sexo'] === 'F') ? 'checked' : ''; ?>required>Feminino</label>
            <br>
            <br>
            <br>
            <label for="fone">Fone:</label>
            <input type="text" name="fone" value="<?php echo $row['fone']; ?>" required>
            <br>
            <br>
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
            <br>
            <br>
            <br>
            <button class="botaoditar" type="submit">Editar</button>
            <br><br><br>
            <a class="button" href="menu.php">Voltar</a>
            <br><br>
            </label>
        </form>
    </div>
    </div>

</body>

</html>