(function ($) {
    $.fn.serializeFormJSON = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }

                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
})(jQuery);

;(function () {
    var form = $('.form-validator'),
        origin = window.location.origin + || '',
        alertMessage = form.find('.alert'),
        routes = {
            login: origin + '/admin/api/auth.php',
            cadastro: origin + '/admin/api/clientes.php',
            placa: origin + '/admin/api/placa.php'
        };

    form.validator().on('submit', function (e) {
        alertMessage
            .removeClass('d-none alert-warning')
            .hide();

        if (e.isDefaultPrevented()) {
            alertMessage
                .addClass('alert-warning')
                .text('Prencha todos os campos!')
                .show();
        } else {
            var path = e.target.getAttribute('form-validator'),
                route = routes[path];

            switch (path) {
                case 'login':
                    formLogin(route);
                    break;
                case 'cadastro':
                    formCadastro(route);
                    break;
                case 'contagem':
                    formContagem(route);
                    break;

            }
        }

        e.preventDefault();
    });

    function formLogin (url) {
        sendForm(form, url)
            .then(function (response) {
                form.trigger('reset');

                window.location.href = origin + "/admin/view/index.php";
            }, function (response){
                var message = response.responseJSON.message;

                showAlert(message);
            });
    }

    function formContagem (url) {
        window.location.href = origin + "/admin/view/Contagem.php";
    }

    function formCadastro (url) {
        sendForm(form, url)
            .then(function (response) {
                var message = response.message;

                form.trigger('reset');

                showAlert(message, 'success');
            }, function (response){
                var message = response.responseJSON.message;

                showAlert(message);
            });
    }

    function showAlert (message, state) {
        state = state || 'warnig';

        alertMessage
            .addClass('alert-' + state)
            .text(message)
            .show();
    }

    function sendForm (target, url) {
        var url = url || target.attr('action'),
            type = target.attr('method') || 'GET',
            data = target.serializeFormJSON();

        return $.ajax({ type, url, data });
    }

})();
