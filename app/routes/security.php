<?php

use Application\App;
use Application\Controller\SecurityController;
    use Application\Controller\RequestParse;
    use Illuminate\Database\Eloquent;
    use Model\Security\Cookie;

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

/**
     * Security
     **/

    $app::Router()->get($app->path('login'), function(){
        $security = new SecurityController();
        echo $security->index();
    });

    $app::Router()->get($app->path('logout'), function(Request $request, Response $response){
        SecurityController::logout();
        $response = Cookie::deleteCookie($response, 'Rememberme');
        App::Router()->respond($response);

        return $response->withRedirect('/');
    });

    $app::Router()->post($app->path('auth'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);

        $email      = $parse->get('email');
        $password   = $parse->get('password');
        $rememberme = $parse->get('rememberme');

        $security = new SecurityController();
        $responseData = $security->authenticate($email, $password, $rememberme);

        return $response->withJson($responseData);
    });