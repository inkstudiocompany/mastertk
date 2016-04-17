$(document).ready(function (){
    var agregarProyecto =$("form#agregar_proyecto");
    agregarProyecto.validate({
        rules: {
            nomProyecto: { lettersonly: true},
            objProyecto: { lettersonly: true},
            inicioProyecto: "required",
            finProyecto: "required",
            productivoProyecto: "required",
            lider: {
                required: function (element) {
                    return $("form#agregar_proyecto").find("#idLider").val() === "";
                }
            }

		},
        messages: {
            nomProyecto: "No se permiten caracteres especiales",
            objProyecto: "No se permiten caracteres especiales",
            start: "Debe ingresar el INICIO del Proyecto",
            end: "Debe ingresar el FIN del Proyecto",
            productivoProyecto: "Debe ingresar SI / NO, esta Productivo",
            lider:"Debe seleccionar un LIDER"
        }
    });


    agregarProyecto.find('#wizard').bootstrapWizard({
        nextSelector: '.button-next',
        previousSelector: '.button-previous',
        onTabClick: function (event, currentIndex, newIndex) { console.log(event, currentIndex, newIndex    )},
        onNext: function (event, currentIndex, priorIndex) { console.log(event, currentIndex, priorIndex)     }
    });

    agregarProyecto.find('#wizard').find('.button-finish').click(function () {
        var validator = agregarProyecto.validate();
        if(validator.form()){
            var teams = agregarProyecto.find('#teamTable').bootstrapTable('getData');
            teams.forEach(function( team ) {
                $('<input>').attr({ type: 'hidden', name: 'nombreEquipo[]', value: team.nombre}).appendTo(agregarProyecto);
            });
            var itemTypes = agregarProyecto.find('#itemTypeTable').bootstrapTable('getData');
            itemTypes.forEach(function( team ) {
                $('<input>').attr({ type: 'hidden', name: 'tipoItem[]', value: team.nombre}).appendTo(agregarProyecto);
            });

            agregarProyecto.submit();
        }
    });

    agregarProyecto.find("#lider" ).typeahead({
       minLength: 3,
       maxItem: 8,
       maxItemPerGroup: 6,
       order: "asc",
       searchOnFocus: false,
       display: ["name", "city", "division"],
       correlativeTemplate: true,
        mustSelectItem: true,
       emptyTemplate: function (query) {
            return '<span> No se encontraron registros </span>';
        },
       template: '<span>' +
       '<span class="name">{{nombreCompleto}}</span>' +
       '<span class="division"> ({{rol_principal.nombreRol}})</span>' +
       '</span>',

       source: {
           users:["/usuarios/all" , "data.usuarios"]
           },
       callback: {
           onClickBefore: function (node, form, item, event) {
                    $('#idLider').val(item.idUsuario);
                }
       }
    });
    agregarProyecto.find('.input-daterange').datepicker({
        format: "yyyy/mm/dd",
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
    agregarProyecto.find('#teamTable').bootstrapTable({
        pagination:true,
        pageSize:5
    });




    agregarProyecto.find('#addTeam.btn-primary').click(function() {
        var messages= {
                nombreVacio: "Debe ingresar un nombre de Equipo",
                nombreExistente: "Ya existe un equipo con el mismo nombre"
            },
            nombreEquipo =agregarProyecto.find('#nombreEquipo').val(),
            teams = agregarProyecto.find('#teamTable').bootstrapTable('getData'),
            alert= agregarProyecto.find('#new-team .error-msg');
        if($.trim( nombreEquipo ) === '' ){
            alert.html('<i class="glyphicon glyphicon-exclamation-sign"></i> ' + messages.nombreVacio).show();
            setTimeout(function () {
                alert.hide();
            }, 3000);
            return;
        }else{
            var exist = teams.find(function(element, index, array) {
                return element.nombre === nombreEquipo;
            });
            if(exist){
                alert.html('<i class="glyphicon glyphicon-exclamation-sign"></i> ' + messages.nombreExistente).show();
                setTimeout(function () {
                    alert.hide();
                }, 3000);
                return;
            }
        }
        alert.hide();
        agregarProyecto.find('#nombreEquipo').val('');
        agregarProyecto.find('#teamTable').bootstrapTable('append', { nombre:nombreEquipo});

    });
    /*Eventos*/

    window.teamEventFormatter= function(value, row, index) {
        return [
            '<div id="toolbarTeams" class="btn-group">',
            '<button type="button" class="remove-team btn btn-default">',
            '<i class="glyphicon glyphicon-trash"></i>',
            '</button>',
            '</div>'
        ].join('');
    };

    window.itemTypeEventFormatter= function(value, row, index) {
        return [
            '<div id="toolbarItemType" class="btn-group">',
            '<button type="button" class="remove-item-type btn btn-default">',
            '<i class="glyphicon glyphicon-trash"></i>',
            '</button>',
            '</div>'
        ].join('');
    };

    window.actionEvents = {
        'click .remove-team': function (e, value, row) {
            agregarProyecto.find('#teamTable').bootstrapTable('remove', {
                field: 'nombre',
                values: [row.nombre]
            });
        },
        'click .remove-item-type': function (e, value, row) {
            agregarProyecto.find('#itemTypeTable').bootstrapTable('remove', {
                field: 'nombre',
                values: [row.nombre]
            });
        }
    };
    /*TiposDeItem*/
    agregarProyecto.find('#itemTypeTable').bootstrapTable({
        pagination:true,
        pageSize:5
    });


    agregarProyecto.find('#addItemType.btn-primary').click(function() {
        var messages= {
                nombreVacio: "Debe ingresar un nombre para el tipo de Item",
                nombreExistente: "Ya existe un tipo de item con el mismo nombre"
            },
            nombre =agregarProyecto.find('#nombreTipoItem').val(),
            types = agregarProyecto.find('#itemTypeTable').bootstrapTable('getData'),
            alert= agregarProyecto.find('#new-item-type .error-msg');
        if($.trim( nombre ) === '' ){
            alert.html('<i class="glyphicon glyphicon-exclamation-sign"></i> ' + messages.nombreVacio).show();
            setTimeout(function () {
                alert.hide();
            }, 3000);
            return;
        }else{
            var exist = types.find(function(element, index, array) {
                return types.nombre === nombre;
            });
            if(exist){
                alert.html('<i class="glyphicon glyphicon-exclamation-sign"></i> ' + messages.nombreExistente).show();
                setTimeout(function () {
                    alert.hide();
                }, 3000);
                return;
            }
        }
        alert.hide();
        agregarProyecto.find('#nombreTipoItem').val('');
        agregarProyecto.find('#itemTypeTable').bootstrapTable('append', { nombre:nombre});

    });
    agregarProyecto.find('.error-msg').hide();
});

