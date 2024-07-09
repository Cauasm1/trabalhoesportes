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

$dadosnot = $noticias->lerPorIdnot($idnot);

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

    <br><br>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['titulo']) && isset($_POST['noticia'])) {
            $noticias = new Noticias($db);
            $idusu = $_SESSION['usuario_id'];
            $data = date("Y-m-d");
            $titulo = $_POST['titulo'];
            $noticia = $_POST['noticia'];
            $noticias->registrar($idusu, $data, $titulo, $noticia);
            header('Location: menu.php');
            exit();
        }
    }
    ?>

    <div class="container">
        <?php while ($row = $dadosnot->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="box">
                <label>Titulo:</label>
                <td><?php echo $row['titulo']; ?></td>
                <br><br>
                <label>Noticia:</label>
                <br>
                <td><?php echo $row['noticia']; ?></td>
                <br><br>
                <label>Data:</label>
                <td><?php echo $row['data']; ?></td>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="container_comentario">

        <h1>Adicionar comentário:</h1>

        <br>

        <form method="POST">
            <label for="noticia">Escreva um comentário:</label>
            <br><br>
            <textarea id="comentario" name="comentario" rows="5" cols="33" placeholder="Escreva um comentário"></textarea>
            <br><br><br>
            <input type="submit" value="Publicar">
        </form>

    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['titulo']) && isset($_POST['noticia'])) {
            $noticias = new Noticias($db);
            $idusu = $_SESSION['usuario_id'];
            $data = date("Y-m-d");
            $titulo = $_POST['titulo'];
            $noticia = $_POST['noticia'];
            $noticias->registrar($idusu, $data, $titulo, $noticia);
            header('Location: menu.php');
            exit();
        }
    }
    ?>

    <div class="container_box">
        <?php while ($row = $dadosnot->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="box">
                <label>Titulo:</label>
                <td><?php echo $row['titulo']; ?></td>
                <br><br>
                <label>Noticia:</label>
                <br>
                <td><?php echo $row['noticia']; ?></td>
                <br><br>
                <label>Data:</label>
                <td><?php echo $row['data']; ?></td>
            </div>
        <?php endwhile; ?>
    </div>

</body>

</html>