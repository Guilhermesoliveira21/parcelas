$('#send_form_login').submit(function(e) {

    e.preventDefault()

    var formDataObj = {};
    $.each($(this).serializeArray(), function(_, field) {
        formDataObj[field.name] = field.value;
    });

    $.ajax({
        url: "http://"+HOST+"/_API",
        type: "POST",
        contentType: "application/json",
        dataType: "json",
        data: JSON.stringify(formDataObj),
        success: function(response) {
            console.log(response)
            // const resp = JSON.parse(response);
            showSuccessNotification(response.info, '/');
        },
        error: function(e) {
            console.log(e);
        }
    })

})

$('#sair_sistema').click(function(e) {

    e.preventDefault()

    formDataObj={conteudo: 'logout'}

    $.ajax({
        url: "http://"+HOST+"/_API",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(formDataObj),
        success: function(response) {
            console.log(response);
            window.location.href = '/'
        },
        error: function(e) {
            console.log(e);
        }
    })

})

