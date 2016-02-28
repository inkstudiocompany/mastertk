'use strict';
/* Funcionalidades generales */

$(document).ready(function(){
	alert('macho puto!');
	$('button[rol="backButton"]').on('click', function(){
		window.history.go(-1);
	});
});