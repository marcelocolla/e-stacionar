<?php require_once 'includes/header.php'; ?>

<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-lg-center">
            <div class="col col-lg-6">
                <div class="justify-content-center text-center mt-5">
                    <img src="img/logo.png" class="img-fluid max-width: 10%" alt="Responsive image">

                    <div class="text-center mt-4 mb-4">
                        <h1 class="h5 text-white">Adicionar crédito</h1>
                    </div>
                    <form class="user form-validator" form-validator="credito" role="form" method="post">
                        <div class="form-group">
                            <input type="text" id="cartao" class="form-control form-control-user" placeholder="Número do cartão" name="Ncard" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" placeholder="Titular do cartão" name="NomeCartao" required>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <input type="text" id="vldcard" class="form-control form-control-user" placeholder="Validade do cartão" name="Vcard" required>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <input type="text" id="cdseg" class="form-control form-control-user" placeholder="Código de segurança" name="CodSeg" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="vlrcredt" class="form-control form-control-user" placeholder="R$ 0,00" name="Valor" required data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': 'R$ ', 'placeholder': '0'">
                            <div class="help-block with-errors"></div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">Comprar crédito</button>

                        <div class="alert d-none mt-4" role="alert"></div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="js/validator.js"></script>

    <script>
        $(document).ready(function() {
            $("#cartao").inputmask({
                mask: ['9999.9999.9999.9999']
            });

            $("#vldcard").inputmask({
                mask: ['99/99']
            });

            $("#cdseg").inputmask({
                mask: ['999']
            });
            $(":input").inputmask();

        })
    </script>


</body>

</html>