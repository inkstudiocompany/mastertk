<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    use Application\Controller\TipoItemController;
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
    //		$nomEquipo = $parse->get('nomEquipo');
    //      $idProyecto = $parse->get('idProyecto');

        $tipoitemController = new TipoItemController();
    //        $itemController -> createNew($nomProyecto, $idProyecto);

        echo $tipoitemController->index();
    });


    $app::Router()->get($app->path('edit_tipoitem'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $tipoitem = new TipoItemController();
        echo $tipoitem->addForm();
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