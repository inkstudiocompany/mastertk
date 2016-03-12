'use strict';

$(document).ready(function (){
	$("#agregar_rol").appValidate({
        rules: {
            nombre: { lettersonly: true},
            descripcion: { numberslettersonly: true}
    	},
        messages: {
            nombre: "Por favor ingrese un nombre para el rol",
            descripcion: "No se permiten caracteres especiales"
        }
    });
});
