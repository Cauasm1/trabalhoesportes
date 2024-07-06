<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $comentario = $_POST["comentario"];
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="comentario">Comentário:</label><br>
    <textarea id="comentario" name="comentario" rows="4" required></textarea><br>

    <input type="submit" value="Enviar Comentário">

    <?php

    while ($row) {
        echo "<div>";
        echo "<p><strong>{$row['nome']}</strong> em {$row['data_envio']}</p>";
        echo "<p>{$row['comentario']}</p>";
        echo "</div>";
    }
    ?>
</form>