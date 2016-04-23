<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    use Application\Controller\SecurityController;
    use Application\Controller\RequestParse;
    use Illuminate\Database\Eloquent;

    /**
     * Security
     **/

    $app::Router()->get($app->path('login'), function(){
        $security = new SecurityController();
        echo $security->index();
    });

    $app::Router()->get($app->path('logout'), function(Request $request, Response $response){
        SecurityController::logout();
        return $response->withRedirect('/');
    });

    $app::Router()->post($app->path('auth'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $email = $parse->get('email');
        $password = $parse->get('password');

        $security = new SecurityController();
        $responseData = $security->authenticate($email, $password);

        return $response->withJson($responseData);
    });