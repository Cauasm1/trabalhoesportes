<?php
session_start();
include_once './config/config.php';
include_once './classes/Noticias.php';
include_once './classes/Comentarios.php';

date_default_timezone_set('America/Sao_Paulo');

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$noticias = new Noticias($db);

if (isset($_GET['idnot'])) {
    $idnot = $_GET['idnot'];
    $row = $noticias->lerPorId($idnot);
}

$comentarios = new Comentarios($db);

$dadoscomentarios = $comentarios->ler();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="notcompleta.css">
    <title>Document</title>
</head>

<body>

    <header>
        <h1>NEW SPORTS</h1>
    </header>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['titulo']) && isset($_POST['noticia'])) {
            $noticias = new Noticias($db);
            $idusu = $_SESSION['usuario_id'];
            $data = date("Y-m-d");
            $titulo = $_POST['titulo'];
            $noticia = $_POST['noticia'];
            $caminho = $_POST['caminho'];
            $noticias->registrar($idusu, $data, $titulo, $noticia, $caminho);
            header('Location: menu.php');
            exit();
        }
    }
    ?>



    <div class="container">
        <div class="box">
            <label>Titulo:</label>
            <td><?php echo $row['titulo']; ?></td>
            <br><br>
            <label>Imagem:</label>
            <br><br>
            <td><?php echo ' <img src=' . $row['caminho'] . '>'; ?></td>
            <br><br>
            <label>Noticia:</label>
            <br>
            <td><?php echo $row['noticia']; ?></td>
            <br><br>
            <label>Data:</label>
            <td><?php echo $row['data']; ?></td>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['comentario'])) {
            $comentarios = new Comentarios($db);
            $comentario = $_POST['comentario'];
            $data_envio = date("Y-m-d H:i:s");
            $comentarios->registrar($comentario, $data_envio);
            header('Location: menu.php');
            exit();
        }
    }
    ?>

    <div class="container_comentario">

        <h1>Adicionar comentário:</h1>

        <br>

        <form method="POST">
            <label>Escreva um comentário:</label>
            <br><br>
            <textarea id="comentario" name="comentario" rows="5" cols="33"
                placeholder="Escreva um comentário"></textarea>
            <br><br>
            <input class="button" type="submit" value="Publicar">
            <br><br><br>
            <a class="button" type="submit" href="menu.php">Voltar</a>
        </form>

    </div>

    <div class="container_areacomentarios">

        <h1>Comentários</h1>

        <?php while ($row = $dadoscomentarios->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="box_comentarios">
                <td><?php echo $row['comentario']; ?></td>
                <br><br>
                <td><?php echo $row['data_envio']; ?></td>
            </div>
            <br>
        <?php endwhile; ?>

    </div>

</body>

</html>