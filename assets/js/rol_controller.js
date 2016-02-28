$(document).ready(function (){ 
	console.log('consoll ');
                $("#agregar_rol").validate({
                    rules: {
                        nombre: "required",
                        descripcion:{
                                required: function(element) {
                                	var valor = $("#descripcion").val();
                                	console.log ('Nombre',valor);

                                	if (valor) {
                                		var letters = /^[A-Za-z]+$/;	
                                		return valor.value.match(letters);
	                                } 
	                                return false;

							}
						}
					},
                    messages: {
                        nombre: "Por favor ingrese un Nombre de ROL",
                        descripcion: "No se permiten caracteres especiales"
                    }
                });
})