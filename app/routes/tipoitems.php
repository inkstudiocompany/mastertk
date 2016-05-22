<?php


use Application\Controller\ProjectController;
use Model\ORM\EquipoAtencion;
use Model\ORM\TipoItem;
use Model\ORM\Workflow;
use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    use Application\Controller\TipoItemController;
    use Application\Controller\EstadoController;
    use Application\Controller\RequestParse;
    use Illuminate\Database\Eloquent;

    /**
     * Tipo Items Routes
     **/

    $app::Router()->get($app->path('tipoitems'), function(){
        $tipoitem = new TipoItemController();
        echo $tipoitem->listado();
    });

    $app::Router()->get($app->path('new_tipoitem'), function(){
        $tipoitem = new TipoItemController();
        echo $tipoitem->addForm();
    });


    $app::Router()->post($app->path('new_tipoitem'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request);
        $tipoItem = new TipoItem();
        $tipoItem -> descripcion =  $parse ->get('nombreTipoItem');
        $tipoItem -> proyecto() ->associate($parse ->get('idProyecto'));
        TipoItemController::createNew($tipoItem);
        echo (new  ProjectController()) -> editItemTypeForm($parse ->get('idProyecto'));
    });


    $app::Router()->get($app->path('edit_tipoitem'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $tipoitemController = new TipoItemController();
        echo $tipoitemController->edit_tipoitem($parse->get('id'));

    });

    $app::Router()->post($app->path('delete_tipoitem'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $dataResponse = [];

        if ($id = $parse->get('id')) {
            $tipoitem = new TipoItemController();
            $dataResponse['status'] = (boolean) $tipoitem->delete($id);
        }
        return $response->withJson($dataResponse);
    });

    $app::Router()->get($app->path('tipoitem_workflow'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $estados    = EstadoController::getByItemTypeId($parse -> get('id'));
        $workflows  = TipoItemController::getWorkflows($parse -> get('id'));
        $resultado  = ["estados" => $estados, "workflows" => $workflows];
        echo json_encode($resultado);
    });

    $app::Router()->post($app->path('workflow_update'), function(Request $request, Response $response, $args){
        $workflows = new Eloquent\Collection();
        $body = file_get_contents("php://input");
        $body_params = json_decode($body);
        foreach($body_params ->workflows as $workflow){
            $item = new Workflow();
            $item ->estadoActual()-> associate ($workflow -> idEstadoActual);
            $item -> estadoSiguiente()-> associate($workflow -> idEstadoSiguiente);
            $workflows -> add($item);
        }
        TipoItemController::updateWorkflows($body_params ->idItemType, $workflows);
        json_encode(true);
    });

    $app::Router()->get($app->path('states_tipoitem'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $estados = EstadoController::getByItemTypeId($parse -> get('id'));
        $workflows = TipoItemController::getWorkflows($parse -> get('id'));
        $resultado = ["estados" => $estados, "workflows" => $workflows];
        echo json_encode($resultado);
    });

$app::Router()->get($app->path('equipos_atencion'), function(Request $request, Response $response, $args){
    $parse = new RequestParse($request, $args);
    $equiposAtencion = EstadoController::getEquiposDeAtencion($parse -> get('id'));
    $resultado = ["equipos" => $equiposAtencion];
    echo json_encode($resultado);
});

$app::Router()->post($app->path('equipos_atencion'), function(Request $request, Response $response, $args){
    $parse = new RequestParse($request, $args);
    $idEstado = $parse -> get('id');
    $body = file_get_contents("php://input");
    $body_params = json_decode($body);
    $equiposAtencion = new Eloquent\Collection();

    foreach($body_params ->equipos as $equipo){
        $item = new EquipoAtencion();
        error_log($equipo);
        $item -> equipo() -> associate($equipo);
        $item -> estado() -> associate($idEstado);
        $equiposAtencion ->add($item);
    }
    $resultado = EstadoController::updateEquiposAtencion($idEstado, $equiposAtencion);
    echo json_encode(true);
});


$app::Router()->post($app->path('new_estado'), function(Request $request, Response $response, $args){
    $parse = new RequestParse($request, $args);
    $body = file_get_contents("php://input");
    $body_params = json_decode($body);
    $estado = new \Model\ORM\Estado();
    $estado -> nombreEstado = $body_params -> nombreEstado;
    $estado -> tipoItem() ->associate( $body_params -> itemTypeId);
    EstadoController::saveNew($estado);
    echo json_encode(true);
});




