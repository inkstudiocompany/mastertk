<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Application\App as App;
use Application\Controller\ProjectController;
use Application\Controller\RequestParse;
use Illuminate\Database\Eloquent;
use Application\Controller\TeamController;
use Application\Controller\TipoItemController;
use Model\ORM\Equipo;
use Model\ORM\TipoItem;

    /**
     * Proyectos Routes
     **/

    $app::Router()->get($app->path('admin_project'), function(){
        $project = new ProjectController();
        echo $project->listado();
    });

    $app::Router()->get($app->path('new_project'), function(){
        $project = new ProjectController();
        echo $project->addForm();
    });

    $app::Router()->get($app->path('edit_project'), function( Request $request, Response $response, $args){
        $project = new ProjectController();
        $parse = new RequestParse($request,$args);
        echo $project -> editForm($parse -> get('id'));
    });

    $app::Router()->post($app->path('save_project'), function( Request $request, Response $response, $args){
        $parse = new RequestParse($request,$args);
        $equiposNombre = $parse->get('nombreEquipo');
        $nombreTiposItem = $parse->get('tipoItem');
        $equipos = new Eloquent\Collection();
        $tiposItem = new Eloquent\Collection();

        foreach($equiposNombre as $equipoNombre){
            $equipo = new Equipo();
            $equipo->nombreEquipo = $equipoNombre;
            $equipos ->add($equipo);
        }

        foreach($nombreTiposItem as $nombre){
            $tipoItem = new TipoItem();
            $tipoItem -> descripcion= $nombre;
            $tiposItem -> add($tipoItem);
        }
        $params = [
            "idProyecto" => $parse->get('idProyecto'),
            "nomProyecto" => $parse->get('nomProyecto'),
            "objProyecto" => $parse->get('objProyecto'),
            "inicioProyecto" => $parse->get('start'),
            "finProyecto" => $parse->get('end'),
            "productivoProyecto" => $parse->get('proyectoproductivo'),
            "idLider" => $parse->get('idLider'),
            "equipos" =>$equipos,
            "tiposItem"=>$tiposItem
        ];
        ProjectController::save($params);
        echo (new ProjectController()) -> listado();
    });

    $app::Router()->get($app->path('edit_project_teams'), function( Request $request, Response $response, $args){
        $parse = new RequestParse($request,$args);
        echo (new  ProjectController()) -> editTeamForm($parse -> get('id'));
    });

    $app::Router()->post($app->path('delete_project'), function( Request $request, Response $response, $args){
        $parse = new RequestParse($request,$args);
        $resultado = ProjectController::delete($parse ->get("id"));
        http_response_code(200);
        echo json_encode($resultado);
    });


    $app::Router()->get($app->path('list_project_teams'), function( Request $request, Response $response, $args){
        $parse = new RequestParse($request,$args);
        $equipos = TeamController::getByProject($parse -> get('id'));
        echo json_encode($equipos);
    });


    $app::Router()->get($app->path('edit_project_item_types'), function( Request $request, Response $response, $args){
        $parse = new RequestParse($request,$args);
        echo (new  ProjectController()) -> editItemTypeForm($parse -> get('id'));
    });

    $app::Router()->get($app->path('project_detail'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);

        $proyectController = new ProjectController();
        $response = $proyectController->detalle($parse->get('id'));

        if (true === $response instanceof \Slim\Http\Response) {
            return $response;
        }

        echo $response;
    });