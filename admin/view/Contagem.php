<?php
    require_once 'includes/head.php';

    $placa = $_GET['placa'];

    if (!isset($placa)) {
        header("Location: index.php");
    }
?>

<body class="bg-gradient-primary">
    <?php include 'includes/app-heading.php'; ?>

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-lg-center">
            <div class="col col-lg-6">
                <div class="justify-content-center text-center mt-4 mb-5">

                    <header class="wrap-contador">
                        <h2 class="timer">
                            <span id="hora">00</span>:<span id="minutos">00</span><span class="segundos">:<span id="segundos">00</span></span>
                        </h2>
                        <p class="label">Tempo restante</p>
                    </header>

                    <button type="button" id="stopTimer" class="btn btn-stop mt-4 mb-4">Stop</button>

                    <p class="placa-veiculo">Placa do Veículo: <b><?php echo $placa; ?></b></p>
                    <input type="hidden" id="placa" value="<?php echo $placa; ?>">

                    <button type="button" id="salvarPlaca" class="btn btn-salvar mt-3">Salvar Placa</button>
                </div>
            </div>
        </div>
        <!-- Outer Row -->

    </div>

    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="js/timer-regresivo.js"></script>
</body>
</html>
