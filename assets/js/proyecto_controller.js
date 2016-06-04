$(document).ready(function (){


    var agregarProyecto =$("form#agregar_proyecto");
    var editTeamForm =  $("div#team-edition");
    var editItemType = $("div#item-type-edition");

    /*ALTA DE PROYECTOS*/

    /*Validador de Datos Basicos del alta de Proyectos*/
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
            start: "Debe ingresar el inicio del Proyecto",
            end: "Debe ingresar el fin del Proyecto",
            productivoProyecto: "Debe ingresar SI / NO, esta Productivo",
            lider:"Debe seleccionar un lider"
        }
    });

    /*Definicion de wizard del alta de Proyectos*/
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

    /*Evento del boton de salvado del formulario de alta de proyecto*/
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

    /*Autocomplete para el lider de proyecto*/
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

    /*Calendario para la fecha de inicio y fin del proyecto en  alta de Proyectos*/
    agregarProyecto.find('.input-daterange').datepicker({
        format: "yyyy/mm/dd",
        language: "es",
        todayHighlight: true,
        autoclose: true
    });

    /*Estilo boostrap para el check de productivo en alta de proyecto*/
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
        },{ field: 'nombreCompleto',
            valign:'middle',
            halign:'center',
            title: 'Lider',
            formatter: function(value, row, index) {
                if(value){
                    return [
                        '<a href="#" class="btn-sm" data-toggle="modal" data-target="#edit-team-leader"',
                        'data-id="', row.idEquipo,'" data-lider= "', value,'"  title="Cambiar Lider">',
                        '<i class="glyphicon glyphicon-user"></i></a> ',
                        value

                    ].join('');

                }else{
                    return [
                        '<a href="#" class="btn-sm" data-toggle="modal" data-target="#edit-team-leader"',
                        'data-id="', row.idEquipo,'" data-lider= "', value,'"  title=" Seleccionar Lider">',
                        '<i class="glyphicon glyphicon-tower"></i> Seleccionar lider</a> '

                    ].join('');
                }
            }
        },{
            title: 'Acciones',
            class:'col-md-3',
            align:'center',
            formatter: function(value, row, index) {
                return [
                    '<button type="button" class="btn btn-sm btn-info team-members"  data-id="', row.idEquipo,'" data-toggle="modal" data-target="#edit-team-members">',
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
        alert.hide();
        var team = { nombreEquipo:  nombreEquipo,
            idProyecto:  editTeamForm.find('#idProyecto').val()
        };
        editTeamForm.ajaxUpdate('/equipos/nuevo','POST',team,function(){
            editTeamForm.find('#teamTable').bootstrapTable('refresh');
            editTeamForm.find('#nombreEquipo').val('');
        });

    });

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
            editTeamForm.find('#teamTable').bootstrapTable('refresh');
            modal.modal('hide');
        });

    });

    editTeamForm.find("[name='usuario-equipo']").bootstrapSwitch({
        onText:'SI',
        offText:'NO',
        size:'mini',
        onColor:'success'
    });

    editTeamForm.find('#edit-team-members').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            idEquipo = button.data('id'),
            modal = $(this),
            callback = function(data){
                data =JSON.parse(data);
                data.forEach(function(item){
                    editTeamForm.find("[id='rol-"+item.idUsuario+"']").val(item.idRol);
                    editTeamForm.find("[name='usuario-equipo'][value="+item.idUsuario+"]").bootstrapSwitch('state', true, true);
                });

            };
        editTeamForm.find("[name='usuario-equipo']").bootstrapSwitch('state', false, false);
        modal.find('#idEquipoIntegrantes').val(idEquipo);
        editTeamForm.ajaxUpdate('/equipos/integrantes/'+idEquipo,'GET',[],callback);

    });

    editTeamForm.find('#edit-team-members').find('.btn-primary').click(function(){
        var modal = editTeamForm.find('#edit-team-members'),
           idEquipo= modal.find('#idEquipoIntegrantes').val(),
           usuarios =[], data =[];
        editTeamForm.find("[name='usuario-equipo']:checked").each(function() {
            usuarios.push({usuario:this.value,
                rol: editTeamForm.find("[id='rol-"+this.value+"']").val()
            });

        });
        data = JSON.stringify({equipo:idEquipo,usuarios:usuarios});
        editTeamForm.ajaxUpdate('/equipos/integrantes/'+idEquipo,'POST',data,function(){
            modal.modal('hide');
            editTeamForm.find('#teamTable').bootstrapTable('refresh');
        });

    });

    editTeamForm.find('#edit-team-leader').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            idEquipo = button.data('id'),
            modal = $(this);
        editTeamForm.teamToChangeLeader = idEquipo;
        editTeamForm.find('#edit-team-leader #members-list').bootstrapTable('resetView');
        editTeamForm.find('#edit-team-leader #members-list').bootstrapTable('refresh', {url:'/equipos/integrantes/'+idEquipo});
        editTeamForm.find("#edit-team-leader #members-list [name='leader']").bootstrapSwitch({
            onText:'SI',
            offText:'NO',
            size:'mini',
            onColor:'success'
        })

    });

    editTeamForm.find('#edit-team-leader #members-list').bootstrapTable({
        method: 'get',
        columns: [
            {
                field: 'usuario.nombreCompleto',
                valign:'middle',
                halign:'center',
                class:'col-md-5',
                title: 'Nombre Integrante'
            },
            {   field: 'rol.nombreRol',
                valign:'middle',
                halign:'center',
                title: 'Rol en el Equipo'
            },
            {
                title: 'Lider',
                field: 'idUsuarioRolEquipo',
                halign:'center',
                class:'col-md-1',
                formatter: function(value, row, index) {
                    var checked = row.esLider ==1?' checked':'';
                    return [
                        '<input type="radio" name="leader" value="', row.idUsuarioRolEquipo,'" ',checked,'/> '
                    ].join('');
                }
            }],
        onPostBody:function(){
            editTeamForm.find("#edit-team-leader #members-list [name='leader']").bootstrapSwitch({
                onText:'SI',
                offText:'NO',
                size:'mini',
                onColor:'success'
            })
        }
    });

    editTeamForm.find('#edit-team-leader .btn-primary').click(function (){
        var idLider= editTeamForm.find("#edit-team-leader [name='leader']:checked").val(),
            modal = editTeamForm.find('#edit-team-leader'),
            callback = function(data){
                modal.modal('hide');
                editTeamForm.find('#teamTable').bootstrapTable('refresh');
            };
        var url = '/equipos/lider/'+editTeamForm.teamToChangeLeader+'/'+idLider;
        editTeamForm.ajaxUpdate(url,'POST',[],callback,function(){});
    });

    /*Edition de Tipos de Item*/

    editItemType.find("[name='equipo-estado']").bootstrapSwitch({
        onText:'SI',
        offText:'NO',
        size:'mini',
        onColor:'success'
    });

    editItemType.find("#edit-item-type-wz").bootstrapWizard({
        onTabClick: function (tab, navigation, index) {
            return false;
        }
    });

    editItemType.find("#edit-item-type-wz .wf-ed").click(function (){
        var id = this.dataset.id;
        editItemType.itemTypeId = id;
        editItemType.find("#edit-item-type-wz .title").html(this.dataset.name);
        editItemType.find("#edit-item-type-wz").bootstrapWizard('show',2);
        editItemType.workflow = new Workflow(id);
        editItemType.workflow.draw();
    });

    editItemType.find("#edit-item-type-wz .st-ed").click(function (){
        var id = this.dataset.id;
        editItemType.itemTypeId = id;
        editItemType.find("#edit-item-type-wz .title").html(this.dataset.name);
        editItemType.find("#idTipoItem").val(id);
        editItemType.find("#edit-item-type-wz").bootstrapWizard('show',1);
        editItemType.find("#nombreEstado").val('');
        editItemType.find("#edit-item-type-wz #states-table").bootstrapTable('refresh', {url:'/tipoitems/workflow/'+id});

    });

    editItemType.find("#edit-item-type-wz #states-table").bootstrapTable({pagination:true,
        pageSize:10,
        method: 'get',
        url:  '',
        responseHandler: function(data){
            return data.estados;
        },
        columns: [{
            field: 'nombreEstado',
            valign:'middle',
            halign:'center',
            class:'col-md-5',
            title: 'Nombre Estado',
            formatter: function(value, row, index) {
                var disabled = '';
                if (row.tickets.length > 0) {
                    disabled = ' disabled ';
                }

                return [
                    '<a href="#" class="btn-sm" data-toggle="modal" data-target="#edit-team-name"',
                    'data-id="', row.idEstado,'" data-nombre= "', value,'"  title="Cambiar Nombre">',
                    '<i class="glyphicon glyphicon-pencil"></i></a>  ',
                    value,
                    '<div class="pull-right"><button type="button" class="btn btn-sm btn-danger remove-item-type" title="Eliminar"',  disabled,'>',
                    '<i class="glyphicon glyphicon-trash"></i></button>',
                    '<button type="button" class="btn btn-sm btn-info state-team-btn" title="Equipos Atenci&oacute;n">',
                    '<i class="glyphicon glyphicon-tags"></i></button> </div>'
                ].join('');
            },
            events:{
                'click .state-team-btn': function (e, value, row) {
                    console.log(e, value, row);
                    editItemType.find("[name='equipo-estado']").bootstrapSwitch('state', false, false);
                    editItemType.find("#edit-item-type-wz #idState").val(row.idEstado);
                    var callback = function(data){
                        data.equipos.forEach(function(team){
                            editItemType.find("[name='equipo-estado'][value="+team.idEquipo+"]").bootstrapSwitch('state', true, true);
                        });
                        editItemType.find("#edit-item-type-wz #states-team-table").show();
                    };
                    $.ajax({
                        url: "/estado/equipos-atencion/"+row.idEstado,
                        type: "GET",
                        success: callback,
                        dataType: 'json',
                        error:  function(data){console.log(data)}
                    });
                }}
        }
        ]
    });

    editItemType.find("#edit-item-type-wz .button-previous").click(function (){
        editItemType.find("#edit-item-type-wz").bootstrapWizard('show',0);
    });

    editItemType.find("#edit-item-type-wz .button-save-workflow").click(function (){
        var data = { idItemType: editItemType.itemTypeId,
                     workflows :    editItemType.workflow.obtenerWorkflows()},
            callback = function(data){
                editItemType.find("#edit-item-type-wz").bootstrapWizard('show',0);
            };
        $.ajax({
            url: "/workflow/update",
            type: "POST",
            data:  JSON.stringify(data),
            dataType: 'json',
            success: callback,
            error:  function(data){console.log(data)}
        });
    });

    editItemType.find("#edit-item-type-wz #states-team-table #assign-teams").click(function(){
        $.fn.ajaxIn();

        var equipos = [],
            idEstado = editItemType.find("#edit-item-type-wz #idState").val();

        editItemType.find("[name='equipo-estado']:checked").each(function() {
            equipos.push(this.value);
        });
        var data = {
            equipos: equipos,
            estado : idEstado
        };
        $.ajax({
            url: "/estado/equipos-atencion/"+idEstado,
            type: "POST",
            success: function(data){
                console.log(data);
                $.fn.ajaxOut();
            },
            dataType: 'json',
            data:  JSON.stringify(data),
            error:  function(data){console.log(data)}
        });
    });

    editItemType.find('#addItemType.btn-primary').click(function() {
        var messages= {
                nombreVacio: "Debe ingresar un nombre para el tipo de Item",
                nombreExistente: "Ya existe un tipo de item con el mismo nombre"
            },
            nombre =editItemType.find('#nombreTipoItem').val(),
            alert= editItemType.find('#new-item-type .error-msg');
        if($.trim( nombre ) === '' ){
            alert.html('<i class="glyphicon glyphicon-exclamation-sign"></i> ' + messages.nombreVacio).show();
            setTimeout(function () {
                alert.hide();
            }, 3000);
            return;
        }
        console.log(nombre);
        /*else{
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

        agregarProyecto.find('#itemTypeTable').bootstrapTable('append', { nombre:nombre});
*/
    });

    editItemType.find("#new-item-type").appValidate({
        rules: {
            nombreTipoItem:  {required: true}
        },
        messages: {
            nombreTipoItem: "No Puede estar vacio el nombre"
        }
    });

    editItemType.find("#addNewState").click(function(){

        var data = {
                itemTypeId: editItemType.itemTypeId,
                nombreEstado : editItemType.find("#nombreEstado").val()
            },
            callback = function(data){
                editItemType.find("#nombreEstado").val('');
                editItemType.find("#edit-item-type-wz #states-table").bootstrapTable('refresh', {url:'/tipoitems/workflow/'+editItemType.itemTypeId});
                $.fn.ajaxOut();
            };

        if ('' === $.trim(data.nombreEstado)) {
            $.fn.modalAlert({
                title   : 'Nombre Requerido!',
                message : 'Para crear un nuevo registro es necesario que ingreses un nombre para el estado.'
            });
            return;
        }

        $.fn.ajaxIn();
        $.ajax({
            url: "/estado/nuevo",
            type: "POST",
            success: callback,
            dataType: 'json',
            data:  JSON.stringify(data),
            error:  function(data){console.log(data)}
        });

    })
});

