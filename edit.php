<?php
require 'db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM imagens WHERE id = :id');
$stmt->execute(['id' => $id]);
$imagem = $stmt->fetch();

if (!$imagem) {
    echo "Imagem não encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Imagem</title>
</head>
<body>
    <h1>Editar Imagem</h1>
    <form action="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($imagem['id']); ?>">
        <label for="nome">Nome da Imagem:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($imagem['nome']); ?>" required><br><br>
        <label for="imagem">Escolha a Nova Imagem (se desejar alterar):</label>
        <input type="file" name="imagem" id="imagem"><br><br>
        <button type="submit">Atualizar</button>
    </form>
    <br>
    <a href="list.php">Voltar</a>
</body>
</html>
