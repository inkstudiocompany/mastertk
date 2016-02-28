jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Ingrese caracteres ALFABETICOS solamente"); 

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