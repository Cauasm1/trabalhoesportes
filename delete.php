<?php
require 'db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM imagens WHERE id = :id');
$stmt->execute(['id' => $id]);
$imagem = $stmt->fetch();

if ($imagem) {
    // Remover a imagem do sistema de arquivos
    unlink($imagem['caminho']);

    // Remover a imagem do banco de dados
    $stmt = $pdo->prepare('DELETE FROM imagens WHERE id = :id');
    $stmt->execute(['id' => $id]);

    echo "Imagem excluída com sucesso!<br><a href='list.php'>Voltar para a lista de imagens</a>";
} else {
    echo "Imagem não encontrada.";
}
?>
