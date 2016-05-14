<?php

	namespace Application\Controller;

	use Application\App;
	use Model\ORM\Comentario;
	use Model\ORM\Item;
	use Model\ORM\TipoItem;
	use Model\ORM\TransicionItem;
    use Model\ORM\Estado;
	use Slim\Http\Response;

	class TicketController extends ControllerBase
	{
		public static function getById($id)
		{
			return Item::find($id);
		}

		public function detalle($idTicket)
		{

            $response = Item::with([
                    'proyecto', 'asignado.usuario', 'estado',
                    'tipoItem',
                    'transiciones' => function($query){
                        $query->orderBy('TransicionItem.fechahora' ,'Desc');
                    },
                    'transiciones.usuario',
                    'comentarios' => function($query){
                        $query->orderBy('Comentario.fechahora', 'Desc');
                    },
                    'comentarios.usuario'])->find($idTicket);

			if (true === is_null($response)) {
				$response = new Response();
				return $response->withRedirect($this->container->path('my_tickets', true));
			}

			return $this->render('tickets/detalle.html.twig', [
				'ticket'  => $response
			]);
		}

		public static function Save($params)
		{
			$id         = self::getInput($params, 'id');
			$tipoitem   = self::getInput($params, 'tipoitem');
			$estado     = self::getInput($params, 'estado');
			$prioridad  = self::getInput($params, 'prioridad');
			$comentario = self::getInput($params, 'comentario');

			$ticketUpdate = true;
			$dataLog = [];

			$item = new Item();
			$dataLog['accion'] = 'Ticket nuevo';
			if($id !== false) {
				$ticketUpdate         = false;
				$item                 = self::getById($id);
				$dataLog['accion']    = 'Nuevo Comentario';
				$dataLog['Detalles:']['']  = '';
			}

			if (false !== $tipoitem) {
				$item -> idTipoItem   = $tipoitem;
				$ticketUpdate         = true;
				$dataLog['ticket']['Tipo Item']  = TipoItem::find($tipoitem)->descripcion;
			}

			if (false !== $estado) {
				$item -> estadoActual     = $estado;
				$ticketUpdate             = true;
                $dataLog['ticket']['Estado']  = Estado::find($estado)->nombreEstado;
			}

			if (false !== $prioridad) {
				$item -> prioridad    = $prioridad;
				$ticketUpdate         = true;
				$dataLog['ticket']['prioridad'] = $prioridad;
			}

			if (true === $ticketUpdate) {
				$dataLog['accion']    = 'Ticket actualizado';
				$item -> save();
			}

			if (false !== $comentario && false === empty($comentario)) {
				$comment = new Comentario();

				$comment -> idItem      = $item -> idItem;
				$comment -> idUsuario   = App::getInstance()->user->id();
				$comment -> fechahora   = date('Y-m-d H:i:s', time());
				$comment -> comentario  = $comentario;

				$item -> comentarios() -> save($comment);

				$dataLog['comentario']  = $comentario;
			}

			$transicion = new TransicionItem();
			$transicion -> idItem      = $item -> idItem;
			$transicion -> idUsuario   = App::getInstance()->user->id();
			$transicion -> fechahora   = date('Y-m-d H:i:s', time());
			$transicion -> data        = json_encode($dataLog, JSON_FORCE_OBJECT);

			$item -> transiciones() -> save($transicion);

			return $item;
		}

		public function editForm($idTicket)
		{
			$response = Item::with([
					//'proyecto',
					'asignado.usuario',
					'tipoItem',
                    'transiciones' => function($query){
                        $query->orderBy('TransicionItem.fechahora' ,'Desc');
                    },
                    'transiciones.usuario',
                    'comentarios' => function($query){
                        $query->orderBy('Comentario.fechahora', 'Desc');
                    },
                    'comentarios.usuario'
			])->find($idTicket);

            if (true === is_null($response)) {
				$response = new Response();
				return $response->withRedirect($this->container->path('my_tickets', true));
			}

            $Item = new Item();
            $estadoActual = $Item->estadoActual($idTicket)->get();
            $workflow = $Item->workFlow($idTicket)->get();

            $states            = [];
            $states['workflow'] = [];
            foreach ($estadoActual As $key => $estado)
            {
                $states['workflow'][] = [
                    'id'      => $estado->idEstado,
                    'nombre'  => $estado->nombreEstado,
                ];
            }
            foreach ($workflow As $key => $estado)
            {
                $states['workflow'][] = [
                    'id'      => $estado->idEstado,
                    'nombre'  => $estado->nombreEstado,
                ];
            }

            $tipoItems = TipoItem::tipoItemsProyecto($response->proyecto->idProyecto)->get();

			$data_relations = [];
			$data_relations['tipo_items'] = [];
			foreach ($tipoItems As $tipoitem)
			{
				$data = [];
				$data['id']             = $tipoitem->idTipoItem;
				$data['descripcion']    = $tipoitem->descripcion;
				$data['estados']        = [];

				foreach ($tipoitem->estados()->get() As $key => $estado)
				{
					$data['estados'][$key] = [
						'id'      => $estado->idEstado,
						'nombre'  => $estado->nombreEstado,
					];
				}
				array_push($data_relations['tipo_items'], $data);
			}

			return $this->render('tickets/editar.html.twig', [
					'ticket'      => $response,
					'relaciones'  => '',
                    'workflow'    => $states['workflow']
			]);
		}
	}