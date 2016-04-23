<?php

		use Application\Controller\TicketController;
		use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    use Application\Controller\RequestParse;
    use Illuminate\Database\Eloquent;

    /**
     * Items Routes
     **/

    $app::Router()->get($app->path('item_detail'), function(Request $request, Response $response, $args){
      $parse = new RequestParse($request, $args);

	    $ticketController = new TicketController();
	    $response = $ticketController->detalle($parse->get('id'));

	    if (true === $response instanceof \Slim\Http\Response) {
		    return $response;
	    }

	    echo $response;
    });