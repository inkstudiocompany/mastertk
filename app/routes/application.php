<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    use Application\App as App;
    use Application\Controller\HomeController;
    use Application\Controller\MyProjectController;
    use Application\Controller\MyTicketController;
    use Application\Controller\RequestParse;
    use Illuminate\Database\Eloquent;

    /**
     * Application Routes
     **/

    $app::Router()->get('/', function(){
        $home = new HomeController();
        echo $home->index();
    });

    $app::Router()->get($app->path('homepage'), function(){
        $home = new HomeController();
        echo $home->index();
    });

    $app::Router()->get($app->path('my_projects'), function(){
        $myproject = new MyProjectController();
        echo $myproject->proyects();
    });

    $app::Router()->get($app->path('my_tickets'), function(){
        $myticket = new MyTicketController();
        echo $myticket->tickets();
    });

    $app::Router()->get($app->path('message_confirm'), function(Request $request, Response $response, $args){
        $dataResponse = [];
        $parse = new RequestParse($request, $args);

        $options = [];
        $options['title'] = $parse->get('title');
        $options['message'] = $parse->get('message');
        $dataResponse['html'] = App::getInstance()->Message()->confirm($options);
        $dataResponse['status'] = true;

        return $response->withJson($dataResponse);
    });