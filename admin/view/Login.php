<?php
    require_once 'includes/head.php';
?>

<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-lg-center">
            <div class="col col-lg-6">
                <div class="justify-content-center text-center mt-5">
                    <img src="img/logo.png" class="img-fluid max-width: 10%" alt="Responsive image">

                    <div class="text-center mt-4 mb-4">
                        <h1 class="h5 text-white">Faça seu login.</h1>
                    </div>

                    <form class="user form-validator" form-validator="login" role="form">
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Digite seu e-mail" name="email" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" placeholder="Senha" name="senha" required>
                            <div class="help-block with-errors"></div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">Entrar</button>

                        <div class="alert d-none mt-4" role="alert"></div>
                    </form>
                </div>

                <div class="text-center mt-4">
                    <a class="white" href="Cadastro.php">Criar nova conta.</a>
                </div>
            </div>
        </div>

    </div>

    <script src="js/validator.js"></script>
</body>
</html>
