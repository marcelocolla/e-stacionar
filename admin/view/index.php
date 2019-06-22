<?php require_once 'includes/header.php'; ?>

<body class="bg-gradient-primary">
<?php require_once 'includes/app-heading.php'; ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-lg-center">
        <div class="col col-lg-6">
            <div class="justify-content-center text-center mt-5">

                <form class="user" action="Contagem.php" method="get" role="form">
                    <div class="form-group row">
                        <div class="col-9">
                            <input type="text" id="placa" class="form-control form-control-user"
                                   placeholder="Digite uma placa" name="placa" required>
                        </div>
                        <div class="col-3 box-play">
                            <button type="submit" class="btn btn-play">
                                <i class="icon fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <?php
                require_once('../controller/DBConect.php');
                require_once('../controller/DBUtils.php');
                require_once('../model/veiculo.php');

                function returnSelect($_prCondicao)
                {
                    $veiculo = new veiculo();
                    $campos = 'placa';
                    $sql = sprintf("SELECT %s FROM %s WHERE %s",
                        $campos,
                        $veiculo->getCampo('tabela'),
                        $_prCondicao
                    );
                    return $sql;
                }

                function listarPlacaUsuario()
                {
                    $con = new DBConect();
                    $con->Conectar();
                    $db = $con->getConexao();
                    $user = $_SESSION['user'];
                    $condicao = sprintf("Id_usuario = %s", $user['Id_usuario']);
                    $result = mysqli_query($db, returnSelect($condicao));
                    // Initialize array variable
                    $response = array();

                    // Fetch into associative array
                    while ($row = mysqli_fetch_assoc($result)) {
                        $response[] = $row;
                    }
                    return $response;
                }

                $placas = listarPlacaUsuario();
                if (count($placas) > 0) {
                    ?>
                    <ul class="list-veiculo">
                        <?php
                        for ($i = 0; $i < count($placas); $i++) :
                            $placa = $placas[$i]['placa'];
                            $link = 'Contagem.php?placa=' . $placa;
                            ?>
                            <li>
                                <a href="<?php echo $link; ?>" class="list-item">
                                    <span class="placa"><?php echo $placa; ?></span>
                                    <i class="icon fas fa-play"></i>
                                </a>
                            </li>
                        <?php
                        endfor;
                        ?>
                    </ul>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>

</div>

<script src="js/validator.js"></script>
<script>
    $(document).ready(function () {
        $("#placa").inputmask({
            mask: ['AAA-9999', 'AAA-9A99']
        });
      
    })
</script>
</body>

</html>