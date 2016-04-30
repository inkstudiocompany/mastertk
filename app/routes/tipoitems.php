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
        $tipoitemController = new TipoItemController();
        echo $tipoitemController->index();
    });


    $app::Router()->get($app->path('edit_tipoitem'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $tipoitemController = new TipoItemController();
        echo $tipoitemController->edit_tipoitem($parse->get('id'));
    });


/*
    $app::Router()->post($app->path('save_tipoitem'), function( Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);

        $params = [
            'id' => $parse->get('id'),
            'idProyecto' => $parse->get('idProyecto'),
            'descripcion' => $parse->get('descripcion')
        ];

        TipoItemController::Save($params);

        return $response->withRedirect(App::getInstance()->path('users'), 301);
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

    */