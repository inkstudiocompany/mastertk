
$(document).ready(function (){
	$("#agregar_rol").validate({
        rules: {
            nombre: "required",
            descripcion: { numberslettersonly: true}
    	},
        messages: {
            nombre: "Por favor ingrese un ROL",
            descripcion: "No se permiten caracteres especiales"
        }
    });

    $('button[role-button="editar"]').editar();
})
