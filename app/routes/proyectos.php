<?php

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

    $app::Router()->post($app->path('new_project'), function( Request $request, Response $response, $args){

        $parse = new RequestParse($request);
        $nomProyecto = $parse->get('nomProyecto');
        $objProyecto = $parse->get('objProyecto');
        $inicioProyecto = $parse->get('start');
        $finProyecto = $parse->get('end');
        $productivoProyecto = $parse->get('proyectoproductivo');
        $idLider = $parse->get('idLider');
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
            $tipoItem -> descripcion= $nombre;
            $tiposItem -> add($tipoItem);
        }

        $project = new ProjectController();
        $project -> createNew($nomProyecto,$objProyecto,$inicioProyecto,$finProyecto,$productivoProyecto,$idLider, $equipos, $tiposItem);

        echo $project->listado();
    });

    $app::Router()->get($app->path('edit_project'), function( Request $request, Response $response, $args){
        $project = new ProjectController();
        echo $project -> editForm($args['id']);
    });