<?php

require_once("Connection.php");

$conn = Connection::getConnection();

$titulo = 'Cadastre o jogador';

$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$idade = isset($_POST['idade']) ? $_POST['idade'] : null;
$n_camisa = isset($_POST['n_camisa']) ? $_POST['n_camisa'] : null;
$posicao = isset($_POST['posicao']) ? $_POST['posicao'] : null;
$nome_camisa = isset($_POST['nome_camisa']) ? $_POST['nome_camisa'] : null;
$cadastro = isset($_GET['cadastro']) ? $_GET['cadastro'] : null;

if ($cadastro === 'failMaximoJogadores') {
    $msgErro = '<p id="msgErro">O limite de jogadores foi atingido</p>';
    $titulo = $msgErro;
} elseif ($cadastro === 'fail') {
    $msgErro = '<p id="msgErro">Preencha os dados do jogador;</p>';
    $titulo = $msgErro;
} else if ($cadastro === 'failNome') {
    $msgErro = '<p id="msgErro">Qual é o nome do jogador?</p>';
    $titulo = $msgErro;
} else if ($cadastro === 'failNomeCamisa') {
    $msgErro = '<p id="msgErro">Qual será o nome na camisa?</p>';
    $titulo = $msgErro;
} else if ($cadastro === 'failNumeroCamisa') {
    $msgErro = '<p id="msgErro">Escolha o número da camisa.</p>';
    $titulo = $msgErro;
} else if ($cadastro === 'failIdade') {
    $msgErro = '<p id="msgErro">Qual a idade do jogador?</p>';
    $titulo = $msgErro;
} else if ($cadastro === 'failPosicao') {
    $msgErro = '<p id="msgErro">Qual a posição do jogador?</p>';
    $titulo = $msgErro;
} else if ($cadastro === 'failSameShirtName') {
    $msgErro = '<p id="msgErro">Essa camisa já tem dono!</p>';
    $titulo = $msgErro;
} else if ($cadastro === 'failSameShirtNumber') {
    $msgErro = '<p id="msgErro">Escolha outro número!</p>';
    $titulo = $msgErro;
}

if (isset($_POST['submetido'])) {

    $sql = "SELECT * FROM players WHERE nome_camisa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nome_camisa]);
    $sameShirtName = $stmt->fetchAll();

    $sql = "SELECT * FROM players";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $sql = "SELECT * FROM players WHERE n_camisa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$n_camisa]);
    $sameShirtNumber = $stmt->fetchAll();


    if (count($result) > 22) {
        header('location: jogador.php?cadastro=failMaximoJogadores');
    } else if (!$nome && !$nome_camisa && !$n_camisa && !$posicao && !$n_camisa) {
        header('location: jogador.php?cadastro=fail');
    } else if (!$nome) {
        header('location: jogador.php?cadastro=failNome');
    } elseif (!$nome_camisa) {
        header('location: jogador.php?cadastro=failNomeCamisa');
    } elseif (!$n_camisa) {
        header('location: jogador.php?cadastro=failNumeroCamisa');
    } elseif (!$idade) {
        header('location: jogador.php?cadastro=failIdade');
    } elseif (!$posicao) {
        header('location: jogador.php?cadastro=failPosicao');
    } elseif (count($sameShirtName) > 0) {
        header('location: jogador.php?cadastro=failSameShirtName');
    } elseif (count($sameShirtNumber) > 0) {
        header('location: jogador.php?cadastro=failShirtNumber');
    }

    if (empty($msgErro)) {
        $sql = 'INSERT INTO players(nome, idade, n_camisa, posicao, nome_camisa)' . ' VALUES(?, ?, ?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $idade, $n_camisa, $posicao, $nome_camisa]);
        $_GET['cadastro'] = 'success';
        header("location: jogador.php?cadastro=success");
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

    <?php

    if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'success') {
        echo '<audio src="paysandu.mp3" hidden autoplay style="width: 0;"></audio>';
    }

    ?>
    <div class="container">

        <div class="cont1">
            <img src="https://upload.wikimedia.org/wikipedia/pt/2/2f/PaysanduSC.png" id="img-left" alt="">
        </div>

        <div class="form">
            <div id="msg">
                <h1 id="titulo"><?php echo $titulo; ?></h1>
            </div>

            <form action="" method="POST">



                <div class="linha1">
                    <div class="input">
                        <label for="nome" class="label">Nome</label>
                        <input type="text" name="nome" id="nome" placeholder="Insira o nome do jogador" minlength="3" value="<?php
                                                                                                                                echo $nome; ?>">
                    </div>

                    <div class="input">
                        <label for="nome_camisa" class="label">Nome no uniforme</label>
                        <input type="text" name="nome_camisa" id="nome_camisa" placeholder="Insira o nome no uniforme" minlength="3" value="<?php
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

                <div class="positionLabel">
                    <label id="position">Posição</label>
                </div>
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
                        <label for="gol">Goleiro</label>
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
                        <input type="reset" value="Limpar campos" id="limpar">
                    </div>
                </div>
            </form>
        </div>

        <div class="cont2">
            <img src="https://4.bp.blogspot.com/-PlwN9Qaw3q4/Tw-jaiLLILI/AAAAAAAAA7s/pCcXdEygHQM/s320/masc_paysandu.png" id="img-right" alt="">
        </div>
    </div>

    <div class="tip">
        <p id="dica">Olhe na tabela se o jogador foi cadastrado com uscesso.</p>
    </div>


</body>

</html>
