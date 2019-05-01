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
    var form = $('#form-validator');

    form.validator().on('submit', function (e) {
        if (e.isDefaultPrevented()) {
            // handle the invalid form...
        } else {
            e.preventDefault();
            sendForm(form);
        }
    });

    function sendForm (form) {
        var url = form.attr('action'),
            data = form.serializeFormJSON(),
            req = $.ajax({ type: 'POST', url, data });

        req.done(function (response) {
            // form.reset();
            // alert(result.message);
        })
        .fail(function (response) {
            // alert('Erro: ' + response.message);
        });
    }
})();
