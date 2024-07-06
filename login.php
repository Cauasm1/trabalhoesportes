<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuarios.php';

$Usuario = new Usuarios($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if ($dados_Usuario = $Usuario->login($email, $senha)) {
            $_SESSION['usuario_id'] = $dados_Usuario['id'];
            header("Location: menu.php");
            exit();
        } else {
            $mensagem_erro = "Credenciais estão inválidas!";
        }

        if ($dados_Usuario = $Usuario->login($email, $senha)) {
            $_SESSION['usuario_id'] = $dados_Usuario['id'];
            header("Location: portal.php");
            exit();
        } else {
            $mensagem_erro = "Credenciais estão inválidas!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<body>

    <div class="img">
        <div class="container">
            <h1>Login</h1>
            <form method="POST">
                <input type="email" name="email" placeholder="insira o email" required>
                <br>
                <br>
                <input type="password" name="senha" placeholder="Insira sua senha" required>
                <br>
                <br>
                <button type="submit">login</button>

                <p><a href="./registrar.php">cadastre-se </a> </p>
                <p><a href="./solicitar_senha.php">recuperar senha</a> </p>

                <br>
                <br>
                <br>
            </form>
            <div classe="mensagem">
                <?php
                if (isset($mensagem_erro)) {
                    echo '<p>' . $mensagem_erro . '</p>';
                }
                ?>

            </div>

        </div>
    </div>
    </div>

</body>

</html>