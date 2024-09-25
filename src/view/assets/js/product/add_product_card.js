$('#add_product_card').on('submit', function(e) {
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
            showSuccessNotification(resp.info, '/card');

        },
        error: function(erro) {
            console.error(erro);
        }
    });
});