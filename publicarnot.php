<?php
session_start();
include_once './config/config.php';
include_once './classes/Noticias.php';

date_default_timezone_set('America/Sao_Paulo');

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$noticias = new Noticias($db);

$dadosnot = $noticias->lerPorIdusu($_SESSION['usuario_id']);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="publicarnot.css">
    <title>Document</title>
</head>

<body>

    <header>
        <h1>NEW SPORTS</h1>
    </header>

    <br><br>

    <div class="container">

        <h1>Cadastro de Notícias:</h1>

        <form method="POST">
            <label for="noticia">Escreva uma notícia:</label>
            <br><br>

            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo">
            <br><br>
            <textarea id="noticia" name="noticia" rows="5" cols="33" placeholder="Escreva uma notícia"></textarea>
            <br><br><br>
            <input class="button" type="submit" value="Publicar">
            <br><br><br>
            <a class="button" href="menu.php">Voltar</a>
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
                <br><br><br>
                <a class="button" href="deletarnot.php?idnot=<?php echo $row['idnot'] ?>">Deletar</a>
                <br><br>
                <a class="button" href="editarnot.php?idnot=<?php echo $row['idnot'] ?>">Editar</a>
            </div>
        <?php endwhile; ?>
    </div>

</body>

</html>