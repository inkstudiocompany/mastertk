$(document).ready(function (){ 
    $("#agregar_rol").validate({
        rules: {
            nombre: "required",
            descripcion: { lettersonly: true}
		},
        messages: {
            nombre: "Por favor ingrese un ROL",
            descripcion: "No se permiten caracteres especiales"
        }
    });
})
