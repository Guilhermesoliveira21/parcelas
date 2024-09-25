$(document).ready(function() {
    $('#send_form_product_create').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this); 

        $.ajax({
            url: 'http://'+HOST+'/_API_product',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {

                const resp = JSON.parse(response);
                showSuccessNotification(resp.info, '/painel/produtos-cadastrados');

            },
            error: function(erro) {
                console.error(erro);
            }
        });
    });
});
