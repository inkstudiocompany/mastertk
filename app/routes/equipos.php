<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    use Application\App as App;
    use Application\Controller\TeamController;
    use Application\Controller\RequestParse;
    use Illuminate\Database\Eloquent;

    /**
     * Equipos Routes
     **/

    $app::Router()->get($app->path('equipos'), function(){
        $equipo = new TeamController();
        echo $equipo->listado();
    });

    $app::Router()->get($app->path('new_equipo'), function(){
        $equipo = new TeamController();
        echo $equipo->addForm();
    });

    $app::Router()->post($app->path('save_equipo'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);

        $params = [
            'id' => $parse->get('id'),
            'idProyecto' => $parse->get('idProyecto'),
            'nombreEquipo' => $parse->get('nombre'),
        ];

        TeamController::Save($params);

        return $response->withRedirect(App::getInstance()->path('equipos'), 301);
    });

    $app::Router()->get($app->path('edit_equipo'), function( Request $request, Response $response, $args){
        $equipo = new TeamController();
        $parse = new RequestParse($request,$args);
        echo $equipo-> editForm($parse -> get('id'));
    });


    $app::Router()->post($app->path('delete_equipo'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $dataResponse = [];

        if ($id = $parse->get('id')) {
            $equipo = new TeamController();
            $dataResponse['status'] = (boolean) $equipo->delete($id);
        }

        return $response->withJson($dataResponse);
    });

    $app::Router()->post($app->path('rename_equipo'), function(Request $request, Response $response, $args){
    $parse = new RequestParse($request);
    $nomEquipo = $parse->get('nombreEquipo');
    $idEquipo = $parse->get('idEquipo');
    $teamController = new TeamController();
    $result = $teamController -> rename($nomEquipo, $idEquipo);

    echo json_encode($result);
});


/*
$app::Router()->get($app->path('team'), function(){
    //var_dump("En EQUIPOS");
    $equiposController = new TeamController();
    echo $equiposController->index();
});

$app::Router()->get($app->path('new_team'), function(){
    $equiposController = new TeamController();
    echo $equiposController->addForm();
});

$app::Router()->post($app->path('new_team'), function( Request $request, Response $response, $args){
        $parse = new RequestParse($request);

        $nomEquipo = $parse->get('nomEquipo');
        $idUsuario = $parse->get('tipoDocumento');
        $idProyecto = $parse->get('rolPrincipal');
        $equiposController = new TeamController();
        $equiposController -> createNew($nomEquipo,$idUsuario,$idProyecto);

        echo $equiposController->index();
});
*/