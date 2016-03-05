/* jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^([a-zA-Z]+\s)*[a-zA-Z]+$/.test(value);
}, "Ingrese caracteres alfanumericos solamente"); 

jQuery.validator.addMethod("numberslettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z0-9 "!?.-]+$/.test(value);
<<<<<<< HEAD
}, "Ingrese caracteres permitidos solamente "); 
=======
}, "Ingrese caracteres permitidos solamente (a-z ; A-Z; 0-9; ; !; ?; .; -)"); */
>>>>>>> f24b436465829e880ea9efdfff533067cbb228ad

$(document).ready(function (){ 
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
<<<<<<< HEAD
                        idRolPrincipal: { required },
                        idTipoDocumento: { required },
                        usuario:  { lettersonly: true}
=======
                        idRolPrincipal: {},
                        usuario:  { lettersonly: true },
>>>>>>> f24b436465829e880ea9efdfff533067cbb228ad
                        password: {
                            required: true,
                            minlength: 5
                        },
                        confirm_password: {
                            required: true,
                            minlength: 5,
                            equalTo: "#password"
                        }
					},


                    messages: {
<<<<<<< HEAD
                        numDocumento: "Debe ingresar un nro. de documento" ,
=======
                        numDocumento: "Debe ingresar un nro. de documento", 
>>>>>>> f24b436465829e880ea9efdfff533067cbb228ad
                        nombreCompleto: "Debe ingresar un nombre" ,
                        email: "Debe ingresar un email valido" ,
                        usuario: "No se permiten caracteres especiales" ,
                        password: "Debe contener contener 5 caracteres como minimo",
<<<<<<< HEAD
                        confirm_password: "Debe coincidir con la password escrita anteriormente"
=======
                        confirm_password: "Debe coincidir con la password escrita anteriormente",
                        descripcion: "No se permiten caracteres especiales" ,
>>>>>>> f24b436465829e880ea9efdfff533067cbb228ad
                    }
                });
})

