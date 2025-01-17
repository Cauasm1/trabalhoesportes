<?php
include_once './config/config.php';
include_once './classes/Usuarios.php';
$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $nova_senha = $_POST['nova_senha'];
    $usuario = new Usuarios($db);
    if ($usuario->redefinirSenha($codigo, $nova_senha)) {
        $mensagem = 'Senha redefinida com sucesso. Você pode <a
href="login.php">entrar</a> agora.';
    } else {
        $mensagem = 'Código de verificação inválido.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="recuperar.css">


    <title>Redefinir Senha</title>
</head>

<body>

    <header>
        <h1>NEW SPORTS</h1>
    </header>

    <br>
    <br>

    <div class="container">
        <h1>Redefinir Senha</h1>
        <form method="POST">
            <label for="codigo">Verificação:</label>
            <input type="text" name="codigo"  value="Seu código aqui" required><br><br>
            <label for="nova_senha">Nova Senha:</label>
            <input type="password" name="nova_senha" required><br><br>
            <input class="card-header" type="submit" value="Redefinir Senha">
        </form>
        <p><?php echo $mensagem; ?></p>
    </div>
    </div>

</body>

</html>