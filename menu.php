<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuarios.php';
include_once './classes/Noticias.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario = new Usuarios($db);

$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
$nome_usuario = $dados_usuario['nome'];

$noticias = new Noticias($db);

$dados = $noticias->ler();

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

        <h1>NEW SPORTS</h1>

        <br>

        <navigation>
            <div class="dropdown">
                <button class="menubtn">
                    <div class="menu"></div>
                    <div class="menu"></div>
                    <div class="menu"></div>
                </button>
                <div class="dropdown-child">
                    <a id="primeiro" class="buttoneditar" role="button"
                        href="editar.php?id=<?php echo $_SESSION['usuario_id']; ?>">Conta</a>
                    <a class="buttonpublicar" role="button" href="publicarnot.php">Publicar</a>
                    <a class="button" role="button" href="logout.php">Logout</a>
                </div>
            </div>
        </navigation>


    </header>

    <div class="saudacao">

        <h1><?php echo saudacao() . ", " . $nome_usuario; ?>!</h1>

    </div>

    <div class="noticiaspubli">

        <h1>Notícias Publicadas</h1>

        <div class="container">
            <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)): ?>
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
                    <br><br>
                    <a id="primeiro" role="button" href="notcompleta.php?idnot=<?php echo $row['idnot'] ?>">Ver mais</a>
                </div>
            <?php endwhile; ?>
        </div>

        <br>
        <br>
        <br>
    </div>

</body>

</html>