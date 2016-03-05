jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z0-9 "!?.-]+$/.test(value);
}, "Ingrese caracteres permitidos solamente (a-z ; A-Z; 0-9; "; !; ?; .; -")"); 

$(document).ready(function (){ 
	console.log('consoll ');
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
