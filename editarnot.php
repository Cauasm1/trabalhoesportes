<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
include_once './config/config.php';
include_once './classes/Noticias.php';

$noticias = new Noticias($db);

if (isset($_GET['idnot'])) {
    $idnot = $_GET['idnot'];
    $row = $noticias->lerPorId($idnot);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idnot = $_POST['idnot'];
    $idusu = $_POST['idusu'];
    $data = $row['data'];
    $titulo = $_POST['titulo'];
    $noticia = $_POST['noticia'];
    $noticias->atualizar($idnot, $idusu, $data, $titulo, $noticia);
    header('Location: menu.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editarnot.css">
    <title>Document</title>
</head>

<body>

    <header>
        <h1>NEW SPORTS</h1>
    </header>
    <br>
    <br>

    <div class="container">

        <h1>Editar Notícia</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idnot" value="<?php echo $row['idnot']; ?>">
            <input type="hidden" name="idusu" value="<?php echo $row['idusu']; ?>">
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" value="<?php echo $row['titulo']; ?>" required>
            <br>
            <br>
            <label for="noticia">Noticia:</label>
            <br><br>
            <textarea type="text" name="noticia" required rows="5" cols="33"
                placeholder="Escreva uma notícia"><?php echo $row['noticia']; ?></textarea>
            <br><br><br>
            <button class="button" type="submit">Editar</button>
            <br><br><br>
            <a class="button" href="menu.php">Voltar</a>
        </form>

    </div>

</body>

</html>