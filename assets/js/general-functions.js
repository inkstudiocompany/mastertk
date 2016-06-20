'use strict';
/* Funcionalidades generales */


$.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^([a-zA-Z]+\s)*[a-zA-Z]+$/.test(value);
}, "Ingrese caracteres alfanumericos solamente");

$.validator.addMethod("numberslettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z0-9 "!?.-]+$/.test(value);
}, "Ingrese caracteres permitidos solamente (a-z ; A-Z; 0-9; ; !; ?; .; -)");

$.fn.createCookie = function(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
};

$.fn.getCookie = function(name) {
    if (document.cookie.length > 0) {
        var c_start = document.cookie.indexOf(name + "=");
        if (c_start != -1) {
            c_start = c_start + name.length + 1;
            var c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return '';
};


$(document).ready(function(){
	$('button[rol="backButton"]').on('click', function(){
        window.history.go(-1);
	});

    $('button[role-button="guardar"]').guardar();

	$('button[role-button="editar"]').editar();

	$('button[role-button="eliminar"]').borrar();

    $('button[role-button="detalle"]').detalle();

    $.fn.ajaxLoaderInit();
});



