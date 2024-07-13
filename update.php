<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $imagem = $_FILES['imagem'];

    // Buscar imagem atual no banco de dados
    $stmt = $pdo->prepare('SELECT * FROM imagens WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $imagemAtual = $stmt->fetch();

    if (!$imagemAtual) {
        echo "Imagem não encontrada.";
        exit;
    }

    // Atualizar nome da imagem
    $stmt = $pdo->prepare('UPDATE imagens SET nome = :nome WHERE id = :id');
    $stmt->execute(['nome' => $nome, 'id' => $id]);

    // Se uma nova imagem for carregada, atualizar o caminho
    if ($imagem['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);
        $nomeArquivo = uniqid() . '.' . $extensao;
        $caminhoArquivo = 'uploads/' . $nomeArquivo;

        if (move_uploaded_file($imagem['tmp_name'], $caminhoArquivo)) {
            // Remover a imagem antiga
            unlink($imagemAtual['caminho']);

            // Atualizar caminho da imagem no banco de dados
            $stmt = $pdo->prepare('UPDATE imagens SET caminho = :caminho WHERE id = :id');
            $stmt->execute(['caminho' => $caminhoArquivo, 'id' => $id]);

            echo "Imagem atualizada com sucesso!<br><a href='list.php'>Voltar para a lista de imagens</a>";
        } else {
            echo "Erro ao mover o arquivo.";
        }
    } else {
        echo "Imagem atualizada com sucesso (sem alteração na imagem)!<br><a href='list.php'>Voltar para a lista de imagens</a>";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
