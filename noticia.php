<?php
session_start();
include_once "./config/config.php";
include_once "./classes/Noticias.php";

date_default_timezone_set('America/Sao_Paulo');

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}


?> 

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="noticia.css">
    <title>Document</title>
</head>

<body>

    <div class="container-vap">

        <h1>Cadastro de Notícias:</h1>

        <form method="POST">
            <label for="noticia">Escreva uma notícia</label>
            <br><br>
           
            <label for="titulo">Título:</label>
            <br><br>
            <input type="text" name="titulo">
            <br><br>

            <textarea id="noticia" name="noticia" rows="5" cols="33" placeholder="Escreava a noticia"></textarea>
            <br><br>
            <input type="submit" class="button" value="Salvar">
        </form>


    </div>
 <?php
if($_SERVER['REQUEST_METHOD']==='POST'){
    if (isset($_POST['titulo']) && isset($_POST['noticia'])){
          $noticias = new Noticias($db);
           $idusu = $_SESSION['usuario_id'];
          $data = date("Y-m-d");
          $titulo = $_POST['titulo'];
          $noticia = $_POST['noticia'];
          $noticias->registrar($idusu, $data, $titulo, $noticia);
          header("Location: portal.php");
        exit();
    }
  
}
?>
  
</body>

</html>