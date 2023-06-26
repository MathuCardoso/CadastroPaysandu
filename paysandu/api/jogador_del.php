<?php

    require_once('Connection.php');

    $id = isset ($_GET['id']) ? $_GET['id'] : null;
    echo $id;

    if($id) {

        $conn = Connection::getConnection();
        $sql = 'DELETE FROM players WHERE id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        header("location: table.php");

        
    }
    else {
        echo "ID não informado.";
        echo "<br>";
        echo "<a href= 'jogador.php'Voltar</a>";
    }
