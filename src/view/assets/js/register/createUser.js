$('#send_form_register').submit(function(e) {

    e.preventDefault()

    var formDataObj = {};
    $.each($(this).serializeArray(), function(_, field) {
        formDataObj[field.name] = field.value;
    });

    if(formDataObj.senha !== formDataObj.confirm_senha) {
        console.log('Senha tem que ser iguais')
    }

    $.ajax({
        url: "http://"+HOST+"/_API",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(formDataObj),
        success: function(response) {
            console.log(response)
            const resp = JSON.parse(response);
            showSuccessNotification(resp.info, '/login');
        },
        error: function(e) {
            
        }
    })
})


