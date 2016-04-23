<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

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
        $team = new TeamController();
        echo $team->addForm();
    });

    $app::Router()->post($app->path('new_equipo'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request);
        $nomEquipo = $parse->get('nomEquipo');
        $idProyecto = $parse->get('idProyecto');

        $teamController = new TeamController();
        $teamController -> createNew($nomEquipo, $idProyecto);

        echo $teamController->index();
    });

    $app::Router()->get($app->path('edit_equipo'), function(){
        $equipo = new TeamController();
        echo $equipo->addForm();
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