$(document).ready(function () {
    $("#dns-form").on('submit', function (e) {
        e.preventDefault();
        $('.dns-form-error-msg').remove();
        $('.dns-record-status-msg').remove();
        $('.loading').show();

        const $form = $(this);
        const form_data = $form.serialize();

        $.ajax({
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            url: $form.attr('action'),
            data: form_data,
            error: function (res) {
                const errors = res.responseJSON.errors.domain;

                Object.keys(errors).forEach(function (key) {
                    $form.append('<p class="dns-form-error-msg"><span class="alert alert-danger">'+ errors[key] +'</span></p>')
                });
            },
            success: function (res) {
                let html = '';

                Object.keys(res).forEach(function (key) {
                    const type   = res[key] ? 'success' : 'warning';
                    const status = res[key] ? 'enabled' : 'not enabled';

                    html += '<div class="dns-record-status-msg alert alert-'+ type +'">'+ key.toLocaleUpperCase() +' DNS record '+ status +'</div>';
                });

                $form.append(html);
            }
        }).done(function () {
            $('.loading').hide();
        });
    })
});
