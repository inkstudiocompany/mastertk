$(document).ready(function (){ 
    $("#agregar_tipodocumento").validate({
        rules: {
            nombreDocumento: { lettersonly: true}
            },
        messages: {
            nombreDocumento: "No se permiten caracteres especiales"
        }
    });
})
