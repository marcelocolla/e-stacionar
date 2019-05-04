<?php
    require_once 'includes/head.php';
?>

<body class="bg-gradient-primary">
    <?php include 'includes/app-heading.php'; ?>

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-lg-center">
            <div class="col col-lg-6">
                <div class="justify-content-center text-center mt-5">

                    <header class="wrap-contador">
                        <h2 id="contador" class="timer">
                            01:33
                        </h2>
                        <p class="label">Tempo restante</p>
                    </header>

                    <button type="button" id="stop" class="btn btn-stop mt-4 mb-4">Stop</button>

                    <p class="placa-veiculo">Placa do Veículo: <b>AFT-4F56</b></p>

                    <button type="button" id="salvar" class="btn btn-salvar mt-3">Salvar Placa</button>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
