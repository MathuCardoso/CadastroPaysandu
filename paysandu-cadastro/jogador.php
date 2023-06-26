<?php

require_once("Connection.php");

$conn = Connection::getConnection();

$msgErro = '';

$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$idade = isset($_POST['idade']) ? $_POST['idade'] : null;
$n_camisa = isset($_POST['n_camisa']) ? $_POST['n_camisa'] : null;
$posicao = isset($_POST['posicao']) ? $_POST['posicao'] : null;
$nome_camisa = isset($_POST['nome_camisa']) ? $_POST['nome_camisa'] : null;

if (isset($_POST['submetido'])) {

    if (!$nome) {
        $msgErro = "Preencha o(s) campos em branco";
    } else if (!$idade) {
        $msgErro = "Preencha o(s) campos em branco";
    } else if (!$n_camisa) {
        $msgErro = "Preencha o(s) campos em branco";
    } else if (!$posicao) {
        $msgErro = "Preencha o(s) campos em branco";
    } else if (!$nome_camisa) {
        $msgErro = "Preencha o(s) campos em branco";
    } else {
        $sql = 'INSERT INTO players(nome, idade, n_camisa, posicao, nome_camisa)' . ' VALUES(?, ?, ?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $idade, $n_camisa, $posicao, $nome_camisa]);
        header("location: jogador.php");
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paysandu SC</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/pt/2/2f/PaysanduSC.png" type="image/x-icon">
</head>

<body>

    <audio src="paysandu.mp3" id="audio"></audio>


    <div class="container">

        <div class="cont1">
            <img src="https://upload.wikimedia.org/wikipedia/pt/2/2f/PaysanduSC.png" id="img-left" alt="">
        </div>

        <form action="" method="POST" onsubmit="return msgSucesso();">
            <h1>Cadastre o jogador</h1>

            <div id="msg">
                <?php
                echo $msgErro;
                ?>
            </div>

            <div class="linha1">
                <div class="input">
                    <label for="nome" class="label">Nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Insira o nome do jogador" minlength="3" value="<?php
                                                                                                                            echo $nome; ?>">
                </div>

                <div class="input">
                    <label for="nome_camisa" class="label">Nome no uniforme</label>
                    <input type="text" name="nome_camisa" id="nome_camisa" placeholder="Insira o nome no uniforme" value="<?php
                                                                                                                            echo $nome_camisa; ?>">
                </div>
            </div>

            <div class="linha2">
                <div class="input">
                    <div class="camisa">
                        <label for="n_camisa">Nº</label>
                        <select name="n_camisa" id="n_camisa">
                            <option value="0"></option>
                            <?php
                            for ($numero = 1; $numero <= 99; $numero++) {
                                echo "<option value='$numero'" . ($n_camisa == $numero ? ' selected' : '') . ">$numero</option>";
                            }
                            ?>

                        </select>
                    </div>
                </div>


                <div class="input">
                    <div class="idade">
                        <label for="idade">Idade</label>
                        <select name="idade" id="idade">
                            <option value="0"></option>
                            <?php
                            for ($age = 16; $age <= 45; $age++) {
                                echo "<option value='$age'" . ($idade == $age ? ' selected' : '') . ">$age</option>";
                            }
                            ?>

                        </select>
                    </div>
                </div>
            </div>

            <label id="position">Posição</label>
            <div class="linha3">
                <div class="input-radio">
                    <label for="ataque">Ataque</label>
                    <input type="radio" name="posicao" class="radio" id="ataque" value="Ataque" <?php echo ($posicao == 'Ataque' ? 'checked' : ''); ?>>
                </div>

                <div class="input-radio">
                    <label for="meio-campo">Meio-Campo</label>
                    <input type="radio" name="posicao" class="radio" id="meio-campo" value="Meio-Campo" <?php echo ($posicao == 'Meio-Campo' ? 'checked' : ''); ?>>
                </div>


                <div class="input-radio">
                    <label for="defesa">Defesa</label>
                    <input type="radio" name="posicao" class="radio" id="defesa" value="Defesa" <?php echo ($posicao == 'Defesa' ? 'checked' : ''); ?>>
                </div>

                <div class="input-radio">
                    <label for="gol">Gol</label>
                    <input type="radio" name="posicao" class="radio" id="gol" value="Gol" <?php echo ($posicao == 'Gol' ? 'checked' : ''); ?>>
                </div>
            </div>

            <div class="linha4">
                <div class="btn">
                    <input type="submit" id="submit" value="Cadastrar">
                </div>
            </div>

            <input type="hidden" value="1" name="submetido">


            <div class="bottom">
                <div class="seeT">
                    <a href="table.php">Ver tabela</a>
                </div>

                <div class="clean">
                    <button type="button" id="limpar">Limpar</button>
                </div>
            </div>
        </form>

        <div class="cont2">
            <img src="https://4.bp.blogspot.com/-PlwN9Qaw3q4/Tw-jaiLLILI/AAAAAAAAA7s/pCcXdEygHQM/s320/masc_paysandu.png" id="img-right" alt="">
        </div>
    </div>



    <script src="script/script.js"></script>
</body>

</html>