<?php require_once'includes/header.php'; ?>

<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-lg-center">
            <div class="col col-lg-6">
                <div class="justify-content-center text-center mt-5">
                    <img src="img/logo.png" class="img-fluid max-width: 10%" alt="Responsive image">

                    <div class="text-center mt-4 mb-4">
                        <h1 class="h5 text-white">Registrar-se</h1>
                    </div>

                    <form class="user form-validator" form-validator="cadastro" role="form" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" placeholder="Nome" name="Nome" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" placeholder="CPF" id="Cpf" name="Cpf" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" placeholder="E-mail" name="Email" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" placeholder="Senha" name="Senha" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" placeholder="Confirme sua senha">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">Registrar</button>

                        <div class="alert d-none mt-4" role="alert"></div>
                    </form>
                </div>

                <div class="text-center mt-4 mb-4">
                    <a class="white" href="Login.php">Fazer login</a>
                </div>
            </div>
        </div>

    </div>

    <script src="js/validator.js"></script>
    <script>
        $(document).ready(function() {
            $("#Cpf").inputmask({
                mask: ['999.999.999-99']
            });
        })
    </script>
</body>
</html>
