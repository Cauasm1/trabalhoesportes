<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuarios.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario = new Usuarios($db);

$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
$nome_usuario = $dados_usuario['nome'];

$dados = $usuario->ler();

function saudacao()
{
    $hora = date('H');
    if ($hora >= 6 && $hora < 12) {
        return "Bom dia";
    } else if ($hora >= 12 && $hora < 18) {
        return "Boa tarde";
    } else {
        return "Boa noite";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menu.css">
    <title>Document</title>
</head>

<body>

    <header>

        <h1>Menu de Receitas</h1>

        <br>

        <a class="button" role="button" href="login.php">Logout</a>

    </header>



    <div class="cadastro-container">

        <h1><?php echo saudacao() . ", " . $nome_usuario; ?>!</h1>

    </div>

    <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <div class="not-container">
                <br><br>
                <label>Titulo:</label>
                <td><?php echo $row['titulo']; ?></td>
                <br><br>
                <label>Data:</label>
                <td><?php echo $row['data']; ?></td>
                <br><br>
                <label>Noticia:</label>
                <br><br>
                <td><?php echo $row['noticia']; ?></td>
                <br><br>
            </div>
        </tr>
    <?php endwhile; ?>

</body>

</html>