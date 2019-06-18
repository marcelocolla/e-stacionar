<?php include 'includes/header.php'; ?>

<body class="bg-gradient-primary">
    <?php include 'includes/app-heading.php'; ?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-lg-center">
            <div class="col col-lg-6">
                <div class="justify-content-center text-center mt-5">

                    <form class="user" action="Contagem.php" method="get" role="form">
                        <div class="form-group row">
                            <div class="col-9">
                                <input type="text" id="placa" class="form-control form-control-user" placeholder="Digite uma placa" name="placa" required>
                            </div>
                            <div class="col-3 box-play">
                                <button type="submit" class="btn btn-play">
                                    <i class="icon fas fa-check"></i>
                                </button>
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

                                    <div class="row">
                                        <div class="col-6">Ativo</div>
                                        <div class="col-6">Tempo excedido</div>
                                    </div>
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

    <script src="js/validator.js"></script>
    <script>
        $(document).ready(function() {
            $("#placa").inputmask({
                mask: ['AAA-9999', 'AAA-9A99']
            });
        })
    </script>
</body>

</html>