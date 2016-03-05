$(document).ready(function (){
    $("#agregar_equipo").validate({
        rules: {
            nombreEquipo: { lettersonly: true}
		},
        messages: {
            nombreEquipo: "No se permiten caracteres especiales"
        }
    });
})
