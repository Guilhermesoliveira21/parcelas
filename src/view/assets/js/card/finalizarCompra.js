$('#send_form_card_pay').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this); 

    console.log(formData)

    $.ajax({
        url: 'http://'+HOST+'/_API_product',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
           
            window.location.href = '/painel/pedidos';
        },
        error: function(erro) {
            console.log(erro)
            const resp = JSON.parse(erro);
            showErrorNotification(resp.info);
        }
    });
});

$('.delete-button').on('click', function(e) {

    e.preventDefault();

    const buttonId = $(this).attr('id'); 
    const form = $(this).closest('form'); 

    form.find('.product-id').val(buttonId);

    const formData = new FormData(form[0]);

    $.ajax({
        url: 'http://'+HOST+'/_API_product',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
        
            window.location.reload()
      
        },
        error: function(erro) {
            const resp = JSON.parse(erro);
            showErrorNotification(resp.info);
        }
    });

})