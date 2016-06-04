<?php

use Model\ORM\UsuarioRolEquipo;
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


    $app::Router()->post($app->path('new_equipo'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request);
        $params = [
            'id' => $parse->get('id'),
            'idProyecto' => $parse->get('idProyecto'),
            'nombreEquipo' => $parse->get('nombreEquipo'),
        ];
        TeamController::Save($params);
        echo json_encode(true);
    });

    $app::Router()->post($app->path('lider_equipo'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request,$args);
        $idEquipo = $parse->get('id');
        $idUsuarioRolEquipo  = $parse -> get('lider');
        // var_dump($params);
        TeamController::updateLiderEquipo($idEquipo, $idUsuarioRolEquipo);
        echo json_encode(true);
    });

    $app::Router()->post($app->path('usuario_equipo'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $idEquipo = $parse -> get('id');
        $body = file_get_contents("php://input");
        $body_params = json_decode($body);
        $items = new Eloquent\Collection();

        foreach($body_params -> usuarios as $usuario){
            $item = new UsuarioRolEquipo();
            $item -> equipo() -> associate($idEquipo);
            $item -> usuario() -> associate($usuario -> usuario);
            $item -> rol() ->associate($usuario -> rol);
            $item -> esLider = 0;
            $items ->add($item);
        }

        $resultado = TeamController::updateUsuariosRolEquipo($idEquipo, $items);
        json_encode(true);
    });

    $app::Router()->get($app->path('usuario_equipo'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $idEquipo = $parse -> get('id');
        $resultado = TeamController::listarUsuariosRolEquipo($idEquipo);
        echo json_encode($resultado);
    });




