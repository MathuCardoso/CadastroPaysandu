<?php
require_once("Connection.php");
$conn = Connection::getConnection();

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    $sql = "SELECT * FROM players WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $player = $stmt->fetch();

    echo "<p id = 'nome'>" . $player['nome_camisa'] . "</p>";
    echo "<br>";
    echo "<p id = 'n_camisa'>" . $player['n_camisa'] . "</p>";
} else {
    echo "ID do jogador não informado.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/styleShirt.css">
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/pt/2/2f/PaysanduSC.png" type="image/x-icon">
</head>

<body>
    <div class="container">
        <a href="table.php" class="voltar">Voltar à tabela</a>
    </div>
</body>

</html>