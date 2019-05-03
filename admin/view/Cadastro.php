<?php include 'includes/header.php'; ?>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <img src="img/logo.png" class="img-fluid max-width: 10%" alt="Responsive image">
                                <br>
                                <br>
                                <h1 class="h5 text-gray-900 mb-4">Registre-se</h1>
                            </div>
                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Nome">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="cpf" value="rCpf(cpf.value)" id="exampleLastName" placeholder="CPF">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="E-mail">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Senha">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Confirme sua senha">
                                    </div>
                                </div>
                                <a href="" class="btn btn-primary btn-user btn-block">
                                    Registrar
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/validator.js">
        function rCpf(value) {
            if (typeof value === "undefined") {
                return "";
            }
            if (value != "") {
                value = value.replace(/\D/g, "");                 //Remove tudo o que não é dígito
                value = value.replace(/(\d{3})(\d)/, "$1.$2");    // Coloca ponto entre o terceiro e o quarto digito
                value = value.replace(/(\d{3})(\d)/, "$1.$2");    // Coloca ponto entre o sexto e o sétimo digito
                value = value.replace(/(\d{3})(\d)/, "$1-$2");    // Coloca hífen entre o nono e décimo digito
            }
            return value;
        }
    </script>
</body>

</html>