            var limpar = document.getElementById('limpar');
            limpar.onclick = function() {
            document.getElementById('nome').value = '';
            document.getElementById('idade').value = '';
            document.getElementById('n_camisa').value = '';
            document.getElementById('nome_camisa').value = '';
            var posicao = document.getElementsByName('posicao');

            for (var i = 0; i < posicao.length; i++) {
                posicao[i].checked = false;
            }
        }

        var img1 = document.getElementById('img-left');
        var img2 = document.getElementById('img-right');
        var audio = document.getElementById('audio');

        img1.onclick = function() {
            audio.play();
        }

        img2.onclick = function() {
            audio.play();
        }

        function msgSucesso() {
            var nome = document.getElementById('nome').value;
            var idade = document.getElementById('idade').value;
            var n_camisa = document.getElementById('n_camisa').value;
            var nome_camisa = document.getElementById('nome_camisa').value;
            var posicao = document.querySelector('input[name="posicao"]:checked').value;
            var audio = document.getElementById('audio');
            var msgErro = document.getElementById('msgErro');

            if (nome && nome_camisa && idade && n_camisa && posicao) {
                audio.play();
                alert('Cadastro realizado com sucesso. Bem vindo(a) ao Paysandu, ' + nome + ".");
                return true;
            } else {
                msgErro.textContent('Preencha os campos corretamente');
                return false;
            }

        }