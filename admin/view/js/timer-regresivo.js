Number.prototype.pad = function(size) {
    var s = String(this);
    while (s.length < (size || 2)) {s = "0" + s;}
    return s;
}

;(function () {
    var origin = window.location.origin || '',
        placa = document.getElementById('placa').value,
        horaById = document.getElementById('hora'),
        minutosById = document.getElementById('minutos'),
        segundosById = document.getElementById('segundos'),
        dataInicio = null,
        dataFinal = null,
        atual = null,
        duracao = null,
        timer = null,
        btnSalvarPlaca = $( "#salvarPlaca");

    btnSalvarPlaca.on( "click", function() {
        salvarPlaca();
    });

    $( "#stopTimer").on( "click", function() {
        stopPlaca();
    });

    consultarPlaca();

    function consultarPlaca () {
        var url = origin + '/admin/api/contador.php',
            data = { placa },
            req = $.ajax({ type: 'POST', url, data });

        req.then(function (result) {
            var now = moment();

            dataInicio = moment(result.data_inicio);
            dataFinal = moment(result.data_final);

            if (dataFinal.diff(now) > 0) {
                timer = setInterval(updateTimer, 330);

                updateTimer();
            }
        }, function (response) {
            alert('Erro ao consultar placa do veículo!');
        });
    }

    function salvarPlaca () {
        var url = origin + '/admin/api/placa.php',
            data = { placa },
            req = $.ajax({ type: 'POST', url, data });

        req.then(function (response) {
            btnSalvarPlaca.hide();

            if (response && response.message) {
                alert(response.message)
            } else {
                alert('Placa foi gravada com sucesso!');
            }
        }, function (response) {
            alert('Erro ao salvar a placa!');
        });
    }

    function stopPlaca () {
        var url = origin + '/admin/api/stopContador.php',
            data = { placa },
            req = $.ajax({ type: 'POST', url, data });

        req.then(function (response) {
            finishTimer();
        }, function (response) {
            alert('Erro ao executar stop da contagem!');
        });
    }

    function updateTimer () {
        var now = moment(),
            diffDate = now.diff(dataInicio);

        dataInicio.add(diffDate, 'milliseconds');

        var duracao = moment.duration(dataFinal - dataInicio, 'milliseconds'),
            diffDate = now.diff(dataInicio),
            hours = duracao.hours(),
            minutes = duracao.minutes(),
            seconds = duracao.seconds();

        horaById.innerHTML = (hours).pad();
        minutosById.innerHTML = (minutes).pad();
        segundosById.innerHTML = (seconds).pad();

        if (!hours && !minutes && !seconds) {
            finishTimer();
        }
    }

    function finishTimer () {
        clearInterval(timer);

        horaById.innerHTML = '00';
        minutosById.innerHTML = '00';
        segundosById.innerHTML = '00';
    }

    /*function inserirCredito () {
        var url = origin + '/admin/api/InsertCredito.php',
            data = { vlrcredt },
            req = $.ajax({ type: 'POST', url, data });
        req.then(function (response) {
            var result = JSON.parse(response);

        }, function (response) {
            alert('Erro ao inserir creditos!');
        });
    }*/

})();
