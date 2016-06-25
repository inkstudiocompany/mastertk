$(document).ready(function (){

    var proyectStats = $("#project-stats");



    proyectStats.on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            idProyecto = button.data('id'),
            modal = $(this),
            callback = function(response){
                var proyecto = response[0],
                    ticketsByType = [],
                    ticketsByTeam =[],
                    ticketsByState=[];
                ticketsByType.push(['Tipo Item', 'Items']);
                ticketsByTeam.push(['Equipo', 'Items']);
                ticketsByState.push(['Tipo de Estado', 'Items']);
                console.log(proyecto);
                proyecto.tipo_item_activos.forEach(function(item, index, ar) {
                    var cantidad = item.cuenta_tickets[0]?item.cuenta_tickets[0].cuentaItems:0;
                    ticketsByType.push([item.descripcion, parseInt(cantidad)]);
                });

                proyecto.equipos_activos.forEach(function(item, index, ar) {
                    var cantidad = item.cuenta_items_asignados[0]?item.cuenta_items_asignados[0].cuentaItems:0;
                    ticketsByTeam.push([item.nombreEquipo, parseInt(cantidad)]);
                });


/*
                proyecto.cuenta_items_por_estado.forEach(function(item, index, ar) {
                    ticketsByState.push(['Abierto', 0]);
                    ticketsByState.push(['Transito', 0]);
                    ticketsByState.push(['Cerrado', 0]);
                });
*/
                if(proyecto.cuenta_items_por_estado){
                    var abierto = proyecto.cuenta_items_por_estado.filter(function(item){
                            return item.tipoEstado ==1;
                        });
                    var transito= proyecto.cuenta_items_por_estado.filter(function(item){
                        return item.tipoEstado ==3;
                    });

                    var cerrado = proyecto.cuenta_items_por_estado.filter(function(item){
                        return item.tipoEstado ==2;
                    });
                     abierto = abierto[0]? abierto[0].cuentaItems:0;
                    transito = transito[0]? transito[0].cuentaItems:0;
                    cerrado = cerrado[0]? cerrado[0].cuentaItems:0;

                    ticketsByState.push(['Abierto', parseInt(abierto)]);
                    ticketsByState.push(['Transito', parseInt(transito)]);
                    ticketsByState.push(['Cerrado', parseInt(cerrado)]);
                }

console.log(ticketsByState);


                modal.find('#tickets-by-type').columnsChart(ticketsByType,'Tickets Por Tipo');
                modal.find('#tickets-by-team').barsChart(ticketsByTeam,'Tickets Asignados Por Equipos');
                modal.find('#tickets-by-state').piesChart(ticketsByState,'Tickets Por tipo de Estado');


            };

        $.ajax({
            method: 'GET',
            url: '/proyecto/estadisticas/'+idProyecto,
            dataType: 'json',
            success: callback
        });

    });

});
