$(document).ready(function (){
    var agregarProyecto =$("form#agregar_proyecto");
    agregarProyecto.teams =[];
    agregarProyecto.validate({
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
            start: "Debe ingresar el INICIO del Proyecto",
            end: "Debe ingresar el FIN del Proyecto",
            productivoProyecto: "Debe ingresar SI / NO, esta Productivo",
            idLider:"Debe seleccionar un LIDER"
        }
    });


    agregarProyecto.find('#wizard').steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        /* Events */
        onStepChanging: function (event, currentIndex, newIndex) { return true; },
        onStepChanged: function (event, currentIndex, priorIndex) { },
        onCanceled: function (event) { },
        onFinishing: function (event, currentIndex) { return true; },
        onFinished: function (event, currentIndex) { },

    /* Labels */
        labels: {
            cancel: "Cancelar",
            current: "Paso actual:",
            pagination: "Paginacion",
            finish: "Finalizar",
            next: "Siguiente",
            previous: "Anterior",
            loading: "Cargando ..."
        }
    });

    var usuarioDS = function(query, process) {
        var $items = [];
        $items = [""];
        $.ajax({
            url: '/usuarios/find/'+query,
            dataType: "json",
            type: "GET",
            success: function(data) {
                var usuarios = data.usuarios;
                $.map(usuarios, function(usuario){
                    var group;
                    group = {
                        id: usuario.idUsuario,
                        name: usuario.nombreCompleto +' - '+ usuario.nombreRol,
                        toString: function () {
                            return JSON.stringify(this);
                            //return this.app;
                        },
                        toLowerCase: function () {
                            return this.name.toLowerCase();
                        },
                        indexOf: function (string) {
                            return String.prototype.indexOf.apply(this.name, arguments);
                        },
                        replace: function (string) {
                            var value = '';
                            value +=  this.name;
                            console.log(this.name);
                            if(typeof(this.rol) != 'undefined') {
                                value += ' <span class="pull-right muted">';
                                value += this.rol;
                                value += '</span>';
                            }
                            return String.prototype.replace.apply('<div style="padding: 10px; font-size: 1.5em;">' + value + '</div>', arguments);
                        }
                    };
                    $items.push(group);
                });

                process($items);
            }
        });
    };

    agregarProyecto.find("#lider" ).typeahead({
        source: usuarioDS,
        property: 'name',
        hint: true,
        highlight: true,
        items: 10,
        minLength: 3,
        updater: function (item) {
            var usuario = JSON.parse(item);
            $('#idLider').val(usuario.id);
            return usuario.name;
        }
    });

    agregarProyecto.find('.input-daterange').datepicker({
        format: "mm/dd/yyyy",
        language: "es",
        todayHighlight: true,
        autoclose: true
    });

    agregarProyecto.find('#proyectoproductivo').bootstrapSwitch({
        onText:'SI',
        offText:'NO',
        size:'small'
    });

    /*Equipos*/

 /*   agregarProyecto.find('#teamTable').bootstrapTable({
        data: agregarProyecto.teams
    });
*/
    agregarProyecto.find("#teamLeader" ).typeahead({
        source: usuarioDS,
        property: 'name',
        items: 10,
        minLength: 3
        /*updater: function (item) {
            var item = JSON.parse(item);
            $('#idLider').val(item.id);
            return item.name;
        }*/
    });
});

