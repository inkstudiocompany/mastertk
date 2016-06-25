
function Workflow(itemTypeId){
    console.log('Nueva instancia ...');
    var workflow = this;
        workflow.idItemType = itemTypeId,
        workflow.instance =null,
        workflow.estados = [],
        workflow.workflows = [],
        workflow.canvas = document.getElementById("canvas"),
        workflow.states = function(){return jsPlumb.getSelector(".workflow .state");},
        workflow.instance = jsPlumb.getInstance({
            Container: "canvas",
            Endpoint : ["Dot", {radius:2}],
            Connector : [ "Bezier", { curviness:100 } ],
            HoverPaintStyle : {strokeStyle:"#df3261", lineWidth:3 },
            ConnectionOverlays : [[ "Arrow", {
                location:1,
                id:"arrow",
                length:10,
                foldback:0.7,
                width:7
            }]
            ]
        });
    workflow.crearEventos(workflow.instance, workflow.canvas);
}

Workflow.prototype = {
    constructor: Workflow,
    draw: function() {
        $(this.canvas).empty();
        console.log('Inicializando la vista del Workflow..');
        console.log(this.idItemType, this.procesarDatos);
            if(this.idItemType !== undefined && this.canvas !== undefined) {
                this.obtenerDatos(this.idItemType, this.procesarDatos);
            }
        },
    obtenerDatos: function(id, callback){
            console.log('Buscando datos para el id:', id);
            var me = this;
            var _callback= function(response){
                callback.call(me,response);
            };
            $.getJSON('/tipoitems/workflow/'+id, _callback);
        },
    procesarDatos: function(response){
            var  me = this;
            console.log('Procesando los datos obtenidos del json ...');
            me.parsearDatos(response);
            if(me.estados.length >0){
                me.dibujarEstados(me.canvas, me.estados);
                me.inicializarEventos();
                if(me.workflows.length >0){
                    me.dibujarRelaciones(me.instance, me.workflows);
                }
            }


        },
    parsearDatos: function(data){
            var  me = this;
            console.log('Parseando los datos obtenidos del json ...');
            me.estados=data.estados;
            me.workflows =data.workflows;
        },

    dibujarEstados: function (container, estados){
            var  me = this;
            console.log('Dibujando estados ...');
            estados.forEach(function(estado){
                var div = ["<div class='state' id='",estado.idEstado,"'>",
                    estado.nombreEstado,
                    "<div class='ep'></div></div>"].join('');
                $(div).appendTo(me.canvas);
            });
        },

    dibujarRelaciones: function(instance, workflows){
        workflows.forEach(function(wf){
            instance.connect({
                source: ""+wf.idEstadoActual,
                target: ""+wf.idEstadoSiguiente

            });
        });

    },

    inicializarNodo: function(el, instance) {
        console.log('Inicializando Nodo ...');
        instance.draggable(el);
        instance.makeSource(el, {
            filter: ".ep",
            anchor: "Continuous",
            connectorStyle: {
                strokeStyle: "#5c96bc",
                lineWidth: 2,
                outlineColor: "transparent",
                outlineWidth: 4
            },
            maxConnections: -1,
            onMaxConnections: function (info, e) {
                alert("Maximum connections (" + info.maxConnections + ") reached");
               }
        });
        instance.makeTarget(el, {
            dropOptions: {
                hoverClass: "dragHover"
            },
            anchor: "Continuous",
            allowLoopback: false
        });
    },

    crearEventos: function(instance, canvas){
        var me = this;
        console.log('Creando eventos ...');
        instance.unbind( "click" );
        instance.bind("click", function (c) {
            instance.detach(c);
        });
        instance.on(me.canvas, "dblclick", function (e) {
            //newNode(e.offsetX, e.offsetY);
        });
    },

    inicializarEventos(){
        var me = this,
            instance = me.instance;
        instance.batch(function () {
            var top = 60, left =60,
                states= me.states();
            for (var i = 0; i < states.length; i++) {
                var node = states[i];
                node.style.top = top+"px";
                node.style.left = left+"px";
                me.inicializarNodo(node, instance);
                top = Math.ceil(300*(Math.random()))+120;
                left = Math.ceil(420*(Math.random()))+120;
            }
        });
        instance.unbind("connection");
        instance.bind("connection", function (info) {
            var label = info.connection.source.innerText+ ' -> ' + info.connection.target.innerText;
            info.connection.setLabel({
                label:label,
                location:0.5,
                id:"label",
                cssClass:"label"
            });
            if(info.connection.source.innerText === "Cerrado"  || instance.select({source:info.sourceId, target:info.target}).length >1){
                instance.detach(info.connection);
            }
        });
    },
    obtenerWorkflows(){
        var me = this,
        workflows =[],
        connections= me.instance.getConnections();
        connections.forEach(function(connection){
            console.log(connection.source.innerText,' -> ', connection.target.innerText);
            workflows.push({
                idEstadoActual: connection.sourceId,
                idEstadoSiguiente:connection.targetId
            });
        });
        return workflows;

    }
};

