<?php

use Application\Controller\TeamController;
use Application\Controller\TipoItemController;
use Model\ORM\Equipo;
    use Model\ORM\TipoItem;
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    use Application\Controller\ProjectController;
    use Application\Controller\RequestParse;
    use Illuminate\Database\Eloquent;

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

        foreach($equiposNombre as $nombre){
            $equipo = new Equipo();
            $equipo->nombreEquipo = $nombre;
            $equipos ->add($equipo);
        }

        foreach($nombreTiposItem as $nombre){
            $tipoItem = new TipoItem();
            $tipoItem -> estados -> add(TipoItemController::getIntialsStates());
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

    $app::Router()->get($app->path('list_project_teams'), function( Request $request, Response $response, $args){
        $parse = new RequestParse($request,$args);
        $equipos = TeamController::getByProject($parse -> get('id'));
        echo json_encode($equipos);
    });





