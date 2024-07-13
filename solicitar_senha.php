<?php
include_once './config/config.php';
include_once './classes/Usuarios.php';
$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $usuario = new Usuarios($db);
    $codigo = $usuario->gerarCodigoVerificacao($email);
    if ($codigo) {
        $mensagem = "Seu código de verificação é: $codigo. Por favor,
anote o código e <a href='recuperar_senha.php'>clique aqui</a> para
redefinir sua senha.";
    } else {
        $mensagem = 'E-mail não encontrado.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">


<head>
    <link rel="stylesheet" href="solicitar.css">
    <meta charset="UTF-8">
    </main>
    <title>Recuperar Senha</title>
</head>

<body>

    <header>
        <h1>NEW SPORTS</h1>
    </header>

    <br>
    <br>

    <div class="container">
        <h1>Recuperar Senha</h1>
        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" required><br><br>
            <button class="card-header">Enviar</button>

        </form>
        <p><?php echo $mensagem; ?></p>
        <a class="button" href="login.php">Voltar</a>

    </div>
</body>

</html>