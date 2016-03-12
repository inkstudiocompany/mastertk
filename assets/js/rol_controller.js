'use strict';

$(document).ready(function (){
	$("#agregar_rol").validate({
        debug: true,
        errorClass: 'alert alert-danger',
        errorElement: 'div',
        onfocusout: function() {
            alert('asd');
        },
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
