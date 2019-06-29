<?php require_once 'includes/header.php'; ?>

<body class="bg-gradient-primary">
    <?php include 'includes/app-heading.php'; ?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-lg-center">
            <div class="col col-lg-6">
                <div class="justify-content-center text-center mt-3">

                    <form class="user" id="formConsultar" role="form ">
                        <div class="form-group row">
                            <div class="col-9">
                                <input type="text" id="placa" class="form-control form-control-user" placeholder="Digite uma placa" name="placa" required >
                            </div>
                            <div class="col-3 box-play">
                                <button type="submit" class="btn btn-play">
                                    <i class="icon fas fa-check"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

                <ul id="historico" class="list-veiculo">
                    <li class="list-item text-center">Pesquise por placa!</li>
                </ul>
            </div>
        </div>
    </div>

<script src="js/moment.min.js"></script>
<script>
    $(document).ready(function () {
        var form = $('#formConsultar'),
            inputPlaca = $('#placa'),
            url = '/admin/api/consultaPg.php';


        form.on('submit', submit);

        inputPlaca.inputmask({
            mask: ['AAA-9999', 'AAA-9A99']
        });
        
        function submit(){
            var data = {
                    Placa: inputPlaca.val()
                },
                req = $.ajax({ type: 'POST', url, data });

            req.then(function (response) {

                if (response.result) {
                    insertData(response.result);
                } else {
                    $('#historico').html('<li class="list-item text-center">Nenhum histórico foi encontrado.</li>');
                }

            }, function (response) {
                alert('Erro ao consultar histórico veículo!');
            });

            return false;
        }

       
        function insertData (result) {
            var html = '';


                html += '<li class="list-item text-center">';
                html += '<section class="col-12">'
                html += '<div class="h2"><b>' + result.Placa + '</b></div>';
                html += '<span class="h5">' + moment(result.T_inicial).format('L') + '</span>';

                html += '<article class="row historico separator">';
                html += '  <div class="col-6">Hora Inicio </div>';
                html += '  <div class="col-6">Hora final </div>';
                html += '</article>';

                html += '<div class="row historico">';
                html += '  <div class="col-6"><b>' + moment(result.T_inicial).format('HH:mm') + ' </b></div>';
                html += '  <div class="col-6"><b>' + moment(result.T_final).format('HH:mm') + ' </b></div>';
                html += '</div>';

                html += '<div class="row historico">';
                html += '  <div class="col-6"><b>' + result.ativo + ' </b></div>';
                html += '  <div class="col-6"><b>' + result.situacao + ' </b></div>';
                html += '</div>';

                html += '</section></li>';
                
                
                $('#historico').html(html);
            }
        
    })
</script>
</body>

</html>