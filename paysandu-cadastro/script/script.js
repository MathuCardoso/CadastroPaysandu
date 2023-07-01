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