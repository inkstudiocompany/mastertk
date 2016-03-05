/* jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^([a-zA-Z]+\s)*[a-zA-Z]+$/.test(value);
}, "Ingrese caracteres alfanumericos solamente"); 

jQuery.validator.addMethod("numberslettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z0-9 "!?.-]+$/.test(value);
}, "Ingrese caracteres permitidos solamente (a-z ; A-Z; 0-9; ; !; ?; .; -)"); */

$(document).ready(function (){ 
	console.log('consoll ');
                $("#agregar_usuario").validate({
                    rules: {
                        numDocumento:  { 
                            required: true,
                            number: true,
                            minlength: 7
                        },
                        nombreCompleto: { lettersonly: true},
                        email: { 
                            required: true,
                            email: true
                        },
                        idRolPrincipal: {},
                        usuario:  { lettersonly: true },
                        password: {
                            required: true,
                            minlength: 5
                        },
                        confirm_password: {
                            required: true,
                            minlength: 5,
                            equalTo: "#password"
                        },
                        descripcion: { numberslettersonly: true},
					},


                    messages: {
                        numDocumento: "Debe ingresar un nro. de documento", 
                        nombreCompleto: "Debe ingresar un nombre" ,
                        email: "Debe ingresar un email valido" ,
                        usuario: "No se permiten caracteres especiales" ,
                        password: "Debe contener contener 5 caracteres como minimo",
                        confirm_password: "Debe coincidir con la password escrita anteriormente",
                        descripcion: "No se permiten caracteres especiales" ,
                    }
                });
})

