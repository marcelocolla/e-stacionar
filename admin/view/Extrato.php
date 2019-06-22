<?php require_once 'includes/header.php'; ?>

<body class="bg-gradient-primary">
    <?php include 'includes/app-heading.php'; ?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-lg-center">
            <div class="col col-lg-6">
                <div class="justify-content-center text-center mt-5">

                    <form class="user" action="Extrato.php" method="get" role="form">
                        <div class="form-group row">

                            <div class="col-3 box-play">
                            </div>
                        </div>
                    </form>

                    <ul class="list-veiculo">
                        <?php
                        for ($i = 0; $i < 1; $i++) :
                            $placa = 'ABR-3U' . rand(10, 99);
                            ?>
                            <li class="list-item text-center">
                                <div class="col-12">
                                    <div class=" h2"><?php echo $placa; ?></div>
                                    <span class="h4">21/04/2019</span>
                                    
                                    <div class="row">
                                        <div class="col-6">Hora Inicio</div>
                                        <div class="col-6">Hora final</div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-6">08:25</div>
                                        <div class="col-6">09:30</div>
                                    </div>
                                </div>
                            </li>
                        <?php
                    endfor;
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function () {
      
        var url = '/e-stacionar/admin/api/historico.php',
            data = { Id_usuario: '12' },
            req = $.ajax({ type: 'POST', url, data });

        req.then(function (result) {
            console.log(result)
        }, function (response) {
            alert('Erro ao consultar placa do veículo!');
        });
    })
</script>
</body>

</html>