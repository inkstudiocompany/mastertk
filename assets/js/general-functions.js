'use strict';
/* Funcionalidades generales */

$(document).ready(function(){
	$('button[rol="backButton"]').on('click', function(){
		window.history.go(-1);
	});
});