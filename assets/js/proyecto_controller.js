$(document).ready(function (){ 
    $("#agregar_proyecto").validate({
        rules: {
            nomProyecto: { lettersonly: true},
            objProyecto: { lettersonly: true},
            inicioProyecto: "required",
            finProyecto: "required",
            productivoProyecto: "required",
            idLider: {required: true}

		},
        messages: {
            nomProyecto: "No se permiten caracteres especiales",
            objProyecto: "No se permiten caracteres especiales",
            inicioProyecto: "Debe ingresar el INICIO del Proyecto",
            finProyecto: "Debe ingresar el FIN del Proyecto",
            productivoProyecto: "Debe ingresar SI / NO, esta Productivo",
            idLider:"Debe seleccionar un LIDER"
        }
    });

    $('#agregar_proyecto #rol').change(function() {
        console.log( this.value );
        var value = this.value;
        var option = $('<option />');
        option.attr('value', '').text('- Seleccione Uno -');
        $("#agregar_proyecto #idLider").empty().append(option);
        $.ajax({
            method: 'GET',
            url: '/usuarios/get/'+value,
            success: function(response) {
                if (response.usuarios) {
                    $(response.usuarios).each(function() {
                        console.log(this.idUsuario, this.nombreCompleto);
                        var option = $('<option />');
                        option.attr('value', this.idUsuario).text(this.nombreCompleto);
                        $('#agregar_proyecto #idLider').append(option);
                    });
                }
            }
        });
    });

});

