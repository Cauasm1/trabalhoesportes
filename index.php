<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload de Imagem</title>
</head>
<body>
<h1>Upload de Imagem</h1>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="nome">Nome da Imagem:</label>
    <input type="text" name="nome" id="nome" required><br><br>
    
    <label for="imagem">Escolha a Imagem:</label>
    <input type="file" name="imagem" id="imagem" required><br><br>
    
    <button type="submit">Upload</button>
</form>
<br>
<a href="list.php">Ver Imagens</a>
</body>
</html>
