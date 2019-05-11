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
        dataFinal = null,
        atual = null,
        duracao = null,
        timer = null;

    $( "#salvarPlaca").on( "click", function() {
        salvarPlaca();
    });

    $( "#stopTimer").on( "click", function() {
        stopPlaca();
    });

    consultarPlaca();

    function consultarPlaca () {
        var url = origin + '/admin/api/contador.php',
            data = { placa },
            req = $.ajax({ type: 'GET', url, data });

        req.then(function (response) {
            var result = JSON.parse(response),
                dataInicio = moment(result.data_inicio),
                dataFinal = moment(result.data_final);

            duracao = moment.duration(dataFinal - dataInicio, 'milliseconds'),
            timer = setInterval(updateTimer, 1000),

            updateTimer();
        }, function (response) {
            alert('Erro ao consultar placa do veículo!');
        });
    }

    function salvarPlaca () {
        var url = origin + '/admin/api/salvar-placa.php',
            data = { placa },
            req = $.ajax({ type: 'GET', url, data });

        req.then(function (response) {
            var result = JSON.parse(response);

            debugger;
        }, function (response) {
            alert('Erro ao salvar a placa!');
        });
    }

    function stopPlaca () {
        var url = origin + '/admin/api/contador-stop.php',
            data = { placa },
            req = $.ajax({ type: 'GET', url, data });

        req.then(function (response) {
            finishTimer();
        }, function (response) {
            alert('Erro ao executar stop da contagem!');
        });
    }

    function updateTimer () {
        var hours = duracao.hours(),
            minutes = duracao.minutes(),
            seconds = duracao.seconds();

        duracao = moment.duration(duracao - 1000, 'milliseconds');

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

})();
