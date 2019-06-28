<?php require_once 'includes/header.php'; ?>

<body class="bg-gradient-primary">
    <?php include 'includes/app-heading.php'; ?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-lg-center">
            <div class="col col-lg-6">
                <div class="justify-content-center text-center mt-1">

                    <form class="user" action="Extrato.php" method="get" role="form">
                        <div class="form-group row">

                            <div class="col-3 box-play">
                            </div>
                        </div>
                    </form>

                    <ul id="historico" class="list-veiculo">
                        <li class="list-item text-center">Carregando...</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<script src="js/moment.min.js"></script>
<script>
    $(document).ready(function () {
        var url = '/E-stacionar/admin/api/historico.php',
            req = $.ajax({ type: 'POST', url });

        req.then(function (response) {

            if (response.result.length) {
                insertData(response.result);
            } else {
                $('#historico').html('<li class="list-item text-center">Nenhum histórico foi encontrado.</li>');
            }

        }, function (response) {
            alert('Erro ao consultar histórico veículo!');
        });

        function insertData (result) {
            var html = '';

            $.each(result, function(index, rec) {

                html += '<li class="list-item text-center">';
                html += '<section class="col-12">'
                html += '<div class="h2"><b>' + rec.Placa + '</b></div>';
                html += '<span class="h5">' + moment(rec.T_inicial).format('L') + '</span>';

                html += '<article class="row historico separator">';
                html += '  <div class="col-6">Hora Inicio </div>';
                html += '  <div class="col-6">Hora final </div>';
                html += '</article>';

                html += '<div class="row historico">';
                html += '  <div class="col-6"><b>' + moment(rec.T_inicial).format('HH:mm') + ' min</b></div>';
                html += '  <div class="col-6"><b>' + moment(rec.T_final).format('HH:mm') + ' min</b></div>';
                html += '</div>';

                html += '</section></li>';
            });


            $('#historico').html(html);
        }
    })
</script>
</body>

</html>
