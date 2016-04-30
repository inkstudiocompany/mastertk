'use strict';
/* Funcionalidades generales */


$.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^([a-zA-Z]+\s)*[a-zA-Z]+$/.test(value);
}, "Ingrese caracteres alfanumericos solamente");

$.validator.addMethod("numberslettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z0-9 "!?.-]+$/.test(value);
}, "Ingrese caracteres permitidos solamente (a-z ; A-Z; 0-9; ; !; ?; .; -)"); 

$(document).ready(function(){
	$('button[rol="backButton"]').on('click', function(){
		window.history.go(-1);
	});

    $('button[role-button="guardar"]').guardar();

	$('button[role-button="editar"]').editar();

	$('button[role-button="eliminar"]').borrar();

    $('button[role-button="detalle"]').detalle();
});



