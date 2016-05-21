<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    use Application\App as App;
    use Application\Controller\RolController;
    use Application\Controller\RequestParse;
    use Illuminate\Database\Eloquent;

    /**
     * Roles Routes
     **/

    $app::Router()->get($app->path('roles'), function(){
        $rol = new RolController();
        echo $rol->index();
    });

    $app::Router()->get($app->path('new_rol'), function(){
        $rol = new RolController();
        echo $rol->addForm();
    });

    $app::Router()->post($app->path('save_rol'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);

        $params = [
            'id' => $parse->get('id'),
            'nombre' => $parse->get('nombre'),
            'descripcion' => $parse->get('descripcion')
        ];

        RolController::Save($params);

        return $response->withRedirect(App::getInstance()->path('roles'), 301);
    });

    $app::Router()->get($app->path('edit_rol'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $rol = new RolController();
        echo $rol->editForm($parse->get('id'));
    });

    $app::Router()->post($app->path('delete_rol'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $dataResponse = [];

        if ($id = $parse->get('id')) {
            $rol = new RolController();
            $dataResponse['status'] = (boolean) $rol->delete($id);
        }

        return $response->withJson($dataResponse);
    });