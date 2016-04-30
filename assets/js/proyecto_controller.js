$(document).ready(function (){


    var agregarProyecto =$("form#agregar_proyecto");
    var editTeamForm =  $("div#team-edition");

    agregarProyecto.validate({
        rules: {
            nomProyecto: { numberslettersonly: true},
            objProyecto: { numberslettersonly: true},
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
        onTabClick: function (event, newIndex, currentIndex) {
            if(currentIndex ===0){
                var validator = agregarProyecto.validate();
                return validator.form();
            }
        },
        onNext: function (event, currentIndex, priorIndex) {
            if(priorIndex ===1){
                var validator = agregarProyecto.validate();
                return validator.form();
            }
        }
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
       display: ["name", "city", "division"],
       correlativeTemplate: true,
       cache:true,
       emptyTemplate: function (query) {
            return '<span> No se encontraron registros </span>';
        },
       template: '<span>' +
       '<span class="name">{{nombreCompleto}}</span>' +
       '<span class="division"> ({{rol_principal.nombreRol}})</span>' +
       '</span>',
        source: {
           users: ['/usuarios/all','data.usuarios']
           // data: agregarProyecto.usuarios
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
        pageSize:5,
        columns: [{
            field: 'nombre',
            valign:'middle',
            halign:'center',
            title: 'Nombre Equipo'
        },{
            title: 'Acciones',
            class:'col-md-2',
            align:'center',
            formatter: function(value, row, index) {
                return [
                    '<button type="button" class="btn btn-sm btn-danger remove-team" role-button="eliminar">',
                    'Eliminar<i class="glyphicon glyphicon-trash"></i></button>'
                ].join('');
            },
            events:{
                'click .remove-team': function (e, value, row) {
                    agregarProyecto.find('#teamTable').bootstrapTable('remove', {
                        field: 'nombre',
                        values: [row.nombre]
                    });
                }}

        }]
    });

    agregarProyecto.find('#addTeam.btn-primary').click(function() {
        var messages= {
                nombreVacio: "Debe ingresar un nombre de Equipo",
                nombreExistente: "Ya existe un equipo con el mismo nombre"
            },
            nombreEquipo =$.trim( agregarProyecto.find('#nombreEquipo').val()),
            teams = agregarProyecto.find('#teamTable').bootstrapTable('getData'),
            alert= agregarProyecto.find('#new-team .error-msg');
        if(nombreEquipo  === '' ){
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

    /*TiposDeItem*/

    agregarProyecto.find('#itemTypeTable').bootstrapTable({
        pagination:true,
        pageSize:5,
        columns: [{
            field: 'nombre',
            valign:'middle',
            halign:'center',
            title: 'Nombre Item'
        },{
            title: 'Acciones',
            class:'col-md-2',
            align:'center',
            formatter: function(value, row, index) {
                return [
                    '<button type="button" class="btn btn-sm btn-danger remove-item-type" role-button="eliminar">',
                    'Eliminar<i class="glyphicon glyphicon-trash"></i></button>'
                ].join('');
            },
            events:{
                'click .remove-item-type': function (e, value, row) {
                    agregarProyecto.find('#itemTypeTable').bootstrapTable('remove', {
                        field: 'nombre',
                        values: [row.nombre]
                    });
                }
            }

        }]
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

    /*Edicion de Equipos*/

    editTeamForm.ajaxUpdate = function(url, method,team ,callback, error ){
        $.ajax({
            url: url,
            type: method,
            data:  team,
            success: callback ,
            error:  error
        });

    };

    editTeamForm.find('#teamTable').bootstrapTable({
        pagination:true,
        pageSize:5,
        method: 'get',
        url: '/proyectos/equipos-listar/'+editTeamForm.find('#idProyecto').val(),
        columns: [{
            field: 'nombreEquipo',
            valign:'middle',
            halign:'center',
            class:'col-md-5',
            title: 'Nombre Equipo',
            formatter: function(value, row, index) {
                return [
                    '<a href="#" class="btn-sm" data-toggle="modal" data-target="#edit-team-name"',
                    'data-id="', row.idEquipo,'" data-nombre= "', value,'"  title="Cambiar Nombre">',
                    '<i class="glyphicon glyphicon-pencil"></i></a>  ',
                    value

                ].join('');
            }

        },{
            field: 'lider.nombreCompleto',
            valign:'middle',
            halign:'center',
            title: 'Lider',
            formatter: function(value, row, index) {
                if(value){
                    return [
                        '<a href="#" class="btn-sm" data-toggle="modal" data-target="#edit-team-lider"',
                        'data-id="', row.idEquipo,'" data-lider= "', value,'"  title="Cambiar Lider">',
                        '<i class="glyphicon glyphicon-king"></i></a>  ',
                        value

                    ].join('');

                }else{
                    return [
                        '<a href="#" class="btn-sm" data-toggle="modal" data-target="#edit-team-lider"',
                        'data-id="', row.idEquipo,'" data-lider= ""  title="Seleccionar Lider">',
                        '<i class="glyphicon glyphicon-tower"></i>Seleccionar lider</a> '

                    ].join('');
                }
            }
        },{
            title: 'Acciones',
            class:'col-md-3',
            align:'center',
            formatter: function(value, row, index) {
                return [
                    '<button type="button" class="btn btn-sm btn-info team-members" >',
                    'Integrantes<i class="glyphicon glyphicon-user"></i></button>',
                    '<button type="button" class="btn btn-sm btn-danger remove-team" role-button="delete">',
                    'Eliminar<i class="glyphicon glyphicon-trash"></i></button>'
                ].join('');
            },
            events:{
                'click .remove-team': function (e, value, row) {
                    editar.find('#teamTable').bootstrapTable('remove', {
                        field: 'nombre',
                        values: [row.nombre]
                    });
                },
                'click .team-members': function (e, value, row) {
                    console.log( row.idEquipo);
                }
            }
        }]
    });

    editTeamForm.find('#addTeam.btn-primary').click(function() {
        var messages= {
                nombreVacio: "Debe ingresar un nombre de Equipo",
                nombreExistente: "Ya existe un equipo con el mismo nombre"
            },
            nombreEquipo =editTeamForm.find('#nombreEquipo').val(),
            teams = editTeamForm.find('#teamTable').bootstrapTable('getData'),
            alert= editTeamForm.find('#new-team .error-msg');
        if($.trim( nombreEquipo ) === '' ){
            alert.html('<i class="glyphicon glyphicon-exclamation-sign"></i> ' + messages.nombreVacio).show();
            setTimeout(function () {
                alert.hide();
            }, 3000);
            return;
        }else{
            var exist = teams.find(function(element, index, array) {
                return element.nombreEquipo === nombreEquipo;
            });
            if(exist){
                alert.html('<i class="glyphicon glyphicon-exclamation-sign"></i> ' + messages.nombreExistente).show();
                setTimeout(function () {
                    alert.hide();
                }, 3000);
                return;
            }
        }
        alert.hide();    });

    editTeamForm.find('#edit-team-name').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            modal = $(this);

        modal.find('#nombre').val(button.data('nombre'));
        modal.find('#nombreOriginal').val(button.data('nombre'));
        modal.find('#idEquipo').val(button.data('id'));


    });

    editTeamForm.find('#edit-team-name').find('.btn-primary').click(function(){
        var  messages= {
                nombreVacio: "Debe ingresar un nombre de Equipo",
                nombreExistente: "Ya existe un equipo con el mismo nombre" },
            modal = editTeamForm.find('#edit-team-name'),
            alert= modal.find('.error-msg'),
            teams = editTeamForm.find('#teamTable').bootstrapTable('getData'),
            team = { nombreEquipo:  modal.find('#nombre').val(),
                idEquipo:  modal.find('#idEquipo').val()
            };
        alert.hide();
        if(modal.find('#nombre').val() == modal.find('#nombreOriginal').val()){
            modal.modal('hide');
            return null;
        }
        if(team.nombreEquipo  === '' ){
            alert.html('<i class="glyphicon glyphicon-exclamation-sign"></i> ' + messages.nombreVacio).show(0).delay(5000).hide(0);
            return null;
        }else{
            var exist = teams.find(function(element, index, array) {
                return ((element.nombreEquipo === team.nombreEquipo) && (element.idEquipo != team.idEquipo));
            });
            if(exist){
                alert.html('<i class="glyphicon glyphicon-exclamation-sign"></i> ' + messages.nombreExistente).show(0).delay(5000).hide(0);
                return null;
            }
        }
        editTeamForm.ajaxUpdate('/equipos/renombrar','POST',team,function(){
            console.log();
            editTeamForm.find('#teamTable').bootstrapTable('refresh');
            modal.modal('hide');
        });

    });
});

