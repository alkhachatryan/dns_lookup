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
                    $form.append('<div class="dns-form-error-msg alert alert-danger">'+ errors[key] +'</div>')
                });
                $('.loading').hide();
            },
            success: function (res) {
                let html = '';

                Object.keys(res).forEach(function (key) {
                    const type   = res[key] ? 'success' : 'warning';
                    const status = res[key] ? 'enabled' : 'not enabled';

                    html += '<div class="dns-record-status-msg alert alert-'+ type +'">'+ key.toLocaleUpperCase() +' DNS record '+ status +'</div>';
                });

                $form.append(html);
                $('.loading').hide();
            }
        })
    });

    $('#rua-report-form').on('submit', function(e){
        e.preventDefault();
        $('.rua-report-form-error-msg').remove();
        $('.loading').show();

        $("#report-results-domain span").text('');
        $("#report-results-start-date span").text('');
        $("#report-results-end-date span").text('');
        $("#report-results-email-provider span").text('');
        $("#report-results-report-id span").text('');
        $("#report-results-table tbody").html('');

        const $form = $(this);

        $.ajax({
            url: $form.attr('action'),
            method: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,

            error: function (res) {
                $(".report-result").hide();

                const errors = res.responseJSON.errors.report;

                Object.keys(errors).forEach(function (key) {
                    $form.append('<div class="rua-report-form-error-msg alert alert-danger">'+ errors[key] +'</div>')
                });
                $('.loading').hide();
            },
            success: function (res) {
                $(".report-result").show();

                $("#report-results-domain span").text(res.domain);
                $("#report-results-start-date span").text(res.start_date);
                $("#report-results-end-date span").text(res.end_date);
                $("#report-results-email-provider span").text(res.email_provider);
                $("#report-results-report-id span").text(res.report_id);

                Object.keys(res.rows).forEach(function (key) {
                    const record = res.rows[key];
                    const html = '<tr>' +
                                    '<td>'+ record.ip +'</td>' +
                                    '<td>'+ record.dkim.auth.fail +'</td>' +
                                    '<td>'+ record.dkim.auth.success +'</td>' +
                                    '<td>'+ record.dkim.alignment.fail +'</td>' +
                                    '<td>'+ record.dkim.alignment.success +'</td>' +
                                    '<td>'+ record.spf.auth.fail +'</td>' +
                                    '<td>'+ record.spf.auth.success +'</td>' +
                                    '<td>'+ record.spf.alignment.fail +'</td>' +
                                    '<td>'+ record.spf.alignment.success +'</td>' +
                                  '</tr>';

                    $("#report-results-table tbody").append(html)
                });

                $('.loading').hide();
            }
        });
    })
});
