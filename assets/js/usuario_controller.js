

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

                        rolPrincipal: { required: true },
                        tipoDocumento: { required: true },
                        usuario:  { lettersonly: true },
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
                        numDocumento: "Debe ingresar un nro. de documento",
                        nombreCompleto: "Debe ingresar un nombre" ,
                        email: "Debe ingresar un email valido" ,
                        usuario: "No se permiten caracteres especiales" ,
                        password: "Debe contener contener 5 caracteres como minimo",
                        confirm_password: "Debe coincidir con la password escrita anteriormente",
                        rolPrincipal:"Debe seleccionar uno",
                        tipoDocumento:"Debe seleccionar uno"
                    }
                });
});

