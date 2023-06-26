<?php

require_once("Connection.php");
$conn = Connection::getConnection();

$sql = "SELECT * FROM players";
//Prepara e executa o comando SQL
$stmt = $conn->prepare($sql);
$stmt->execute();
//Armazena os resultados ($result é uma matriz)
$result = $stmt->fetchAll();


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de jogadores</title>
    <link rel="stylesheet" href="style/styleTable.css">
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/pt/2/2f/PaysanduSC.png" type="image/x-icon">


</head>

<body>
    <div class="container">

        <audio src="paysandu.mp3" id="audio"></audio>

        <h3>Sejam bem-vindos ao <span id="paysandu">Paysandu!</span></h3>
        <a href="jogador.php" class="voltar">Voltar ao formulário</a>

        <table id="tb">


            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Nome no uniforme</th>
                <th>Nº da camisa</th>
                <th>Idade</th>
                <th>Posição</th>
                <th>Excluir</th>
                <th>Camisa</th>

            </tr>

            <?php
            foreach ($result as $reg) : ?>

                <tr>
                    <td>
                        <?php echo
                        $reg['id'];
                        ?>
                    </td>

                    <td>
                        <?php echo
                        $reg['nome'];
                        ?>
                    </td>

                    <td>
                        <?php echo
                        $reg['nome_camisa'];
                        ?>
                    </td>

                    <td>

                        <?php
                        echo
                        $reg['n_camisa'];
                        ?>
                    </td>


                    <td>
                        <?php echo
                        $reg['idade']
                        ?>

                    </td>

                    <td>
                        <?php echo
                        $reg['posicao'];
                        ?>
                    </td>

                    <td class="excluir"><a href="jogador_del.php?id=<?php echo $reg['id']; ?>" onclick="return confirmDelete()">Excluir</a></td>

                    <td class="visualizar">
                        <a href="camisa.php?id=<?php echo $reg['id']; ?>">Visualizar
                        </a>
                    </td>
                </tr>

            <?php endforeach ?>


        </table>
    </div>


    <script>
        var paysa = document.getElementById('paysandu');
        paysa.onclick = function() {
            document.getElementById('audio').play();
        };

        function confirmDelete() {
            var senha = prompt("Insira a senha", "");
            if(senha === "lobomal"){
                return true
            }else{
                alert('senha incorreta.');
                return false;
            }

        }
    </script>


</body>

</html>