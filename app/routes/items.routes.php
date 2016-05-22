<?php

use Application\App;
use Application\Controller\TicketController;
use Model\ORM\Item;
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

    $app::Router()->post($app->path('save_ticket'), function(Request $request, Response $response, $args){
			$parse = new RequestParse($request, $args);



			$params = [
                    'proyecto'      => $parse->get('proyecto'),
                    'titulo'        => $parse->get('tituloItem'),
                    'asignado'      => $parse->get('asignado'),
                    'descripcion'   => $parse->get('descripcion'),
					'id'            => $parse->get('id'),
					'tipoitem'      => $parse->get('tipoitem'),
					'estado'        => $parse->get('estado'),
					'prioridad'     => $parse->get('prioridad'),
					'comentario'    => $parse->get('comentario'),
			];

			$ticket = TicketController::Save($params);

			$path = App::getInstance()->path('my_tickets');
			if ($ticket->idItem) {
				$path = App::getInstance()->path('item_detail', ['id' => $ticket->idItem]);
			}

			return $response->withRedirect($path, 301);
		});

    $app::Router()->get($app->path('new_ticket'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);

        $ticketController = new TicketController();
        $response = $ticketController->createForm($parse->get('id'));

        if (true === $response instanceof \Slim\Http\Response) {
            return $response;
        }

        echo $response;
    });

    $app::Router()->get($app->path('edit_ticket'), function(Request $request, Response $response, $args){
			$parse = new RequestParse($request, $args);

			$ticketController = new TicketController();
			$response = $ticketController->editForm($parse->get('id'));

			if (true === $response instanceof \Slim\Http\Response) {
				return $response;
			}

			echo $response;
		});

    $app::Router()->post($app->path('users_allows_ticket'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);

        $ticketController = new TicketController();

        $response->withJson($ticketController->usersByState($parse->get('id')));

        if (true === $response instanceof \Slim\Http\Response) {
            return $response;
        }
    });

