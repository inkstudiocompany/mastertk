'use strict';

$(document).ready(function (){
	$("#agregar_rol").validate({
        rules: {
            nombre: { lettersonly: true},
            descripcion: { numberslettersonly: true}
    	},
        messages: {
            nombre: "Por favor ingrese un ROL",
            descripcion: "No se permiten caracteres especiales"
        }
    });
});
