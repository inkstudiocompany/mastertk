<?php

use Application\Controller\TeamController;
use Model\ORM\UsuarioRolEquipo;
use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    use Application\App as App;
    use Application\Controller\UserController;
    use Application\Controller\RequestParse;
    use Illuminate\Database\Eloquent;

    /**
     * Usuarios Routes
     **/

    $app::Router()->get($app->path('users'), function(){
        $usuariosController = new UserController();
        echo $usuariosController->index();
    });

    $app::Router()->get($app->path('new_user'), function(){
        $usuariosController = new UserController();
        echo $usuariosController->addForm();
    });

    $app::Router()->get($app->path('edit_user'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $usuariosController = new UserController();
        echo $usuariosController->editForm($parse->get('id'));
    });


    $app::Router()->post($app->path('selfie_edit'), function(Request $request, Response $response, $args){
        $parameters = json_decode(file_get_contents('php://input')); 
        $usuariosController = new UserController();
        $responsedata = $usuariosController->selfie($parameters->id,$parameters->path);

        return $response -> withJson($responsedata);
    });

    $app::Router()->post($app->path('save_user'), function( Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);

        $params = [
            'id'            => $parse->get('id'),
            'numDocumento'  => $parse->get('numDocumento'),
            'nombreCompleto'=> $parse->get('nombreCompleto'),
            'email'         => $parse->get('email'),
            'nombreUsuario' => $parse->get('usuario'),
            'password'      => $parse->get('password'),
            'tipoDocumento' => $parse->get('tipoDocumento'),
            'rolPrincipal'  => $parse->get('rolPrincipal'),
            'profile'       => $parse->get('profile'),
        ];

        $user = UserController::Save($params);

        if ('user' === $parse->get('from'))
        {
            return $response->withRedirect(App::getInstance()->path('edit_user',["id"=> $user->idUsuario], true), 301);
        } else {
            return $response->withRedirect(App::getInstance()->path('profile',["id"=> $user->idUsuario], true), 301);
        }
    });

    $app::Router()->post($app->path('delete_user'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $dataResponse = [];

        if ($id = $parse->get('id')) {
            $usuario = new UserController();
            $dataResponse['status'] = (boolean) $usuario->delete($id);
        }

        return $response->withJson($dataResponse);
    });

    $app::Router()->get($app->path('get_user'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $dataResponse = [];
        if ($id = $parse->get('id')) {
            $dataResponse['usuarios'] = UserController::listUserByRol($id);
        }

        return $response->withJson($dataResponse);
    });

    $app::Router()->get($app->path('find_user'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $dataResponse = [];
        if ($query = $args["query"]) {
            $dataResponse['usuarios'] = UserController::findUserByRolOrName($query);
        }

        return $response->withJson($dataResponse);
    });

    $app::Router()->get($app->path('all_users'), function(Request $request, Response $response, $args){
        echo json_encode(array(
            "status" => true,
            "error"  => null,
            "data"   => array(
                "usuarios" => UserController::listWithRolAll()
            )
        ));
    });

    $app::Router()->get($app->path('history'), function(){
        $usuariosController = new UserController();
        echo $usuariosController->history();
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



?>