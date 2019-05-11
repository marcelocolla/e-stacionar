<?php include 'includes/header.php'; ?>

<body class="bg-gradient-primary">
    <?php include 'includes/app-heading.php'; ?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-lg-center">
            <div class="col col-lg-6">
                <div class="justify-content-center text-center mt-5">

                    <form class="user form-validator" form-validator="contagem" role="form">
                        <div class="form-group row">
                            <div class="col-9">
                                <input type="text" class="form-control form-control-user" placeholder="Digite uma placa" name="placa" required>
                            </div>
                            <div class="col-3 box-play">
                                <button type="submit" class="btn btn-play">
                                    <i class="icon fas fa-play"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <ul class="list-veiculo">
                        <?php
                            for ($i=0; $i < 4; $i++) :
                                $placa = 'ABR-3U' . rand(100, 999);
                                $link = '/admin/view/Contagem.php?placa=' . $placa;
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

                </div>
            </div>
        </div>

    </div>

    <script src="js/validator.js"></script>

</body>
</html>
