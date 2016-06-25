<?php

	namespace Application\Controller;

	use Application\App;
	use Model\ORM\Comentario;
    use Model\ORM\EquipoAtencion;
    use Model\ORM\Item;
    use Model\ORM\Proyecto;
    use Model\ORM\TipoItem;
	use Model\ORM\TransicionItem;
    use Model\ORM\Estado;
    use Model\ORM\Usuario;
    use Model\ORM\UsuarioRolEquipo;
    use Slim\Http\Response;
    use Application\Controller\MailController;

	class TicketController extends ControllerBase
	{
		public static function getById($id)
		{
			return Item::find($id);
		}

		public function detalle($idTicket)
		{

            $response = Item::with([
                    'proyecto', 'asignado.usuario', 'status',
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
            $idproyecto = self::getInput($params, 'proyecto');
            $titulo     = self::getInput($params, 'titulo');
            $asignado   = self::getInput($params, 'asignado');
            $descripcion= self::getInput($params, 'descripcion');
			$id         = self::getInput($params, 'id');
			$tipoitem   = self::getInput($params, 'tipoitem');
			$estado     = self::getInput($params, 'estado');
            $asignado   = self::getInput($params, 'asignado');
			$prioridad  = self::getInput($params, 'prioridad');
			$comentario = self::getInput($params, 'comentario');

			$ticketUpdate   = true;
            $newticket      = true;
            $sendMail       = false;
			$dataLog = [];

			$item = new Item();
			$dataLog['accion'] = 'Ticket creado';
			if($id !== false) {
                $newticket                  = false;
				$ticketUpdate               = false;
				$item                       = self::getById($id);
				$dataLog['accion']          = 'Nuevo Comentario';
				$dataLog['Detalles:']['']   = '';
			} else {
                $item -> fechacreacion = Date('Y-m-d H:i:s');
            }

            if (false !== $idproyecto) {
                $item -> idProyecto   = $idproyecto;
                $ticketUpdate         = true;
                $dataLog['ticket']['Proyecto']  = Proyecto::find($idproyecto)->nomProyecto;
            }

            if (false !== $titulo) {
                $item -> tituloItem   = $titulo;
                $ticketUpdate         = true;
                $dataLog['ticket']['Titulo']  = $titulo;
            }

            if (false !== $asignado) {
                $item -> responsable  = $asignado;
                $ticketUpdate         = true;
                $usuarioAsignado      = UsuarioRolEquipo::with('usuario')->find($asignado)->usuario;
                $dataLog['ticket']['Asignado a'] = $usuarioAsignado->nombreCompleto;
                $sendMail = true;
            }

            if (false !== $descripcion) {
                $item -> descItem  = $descripcion;
                $ticketUpdate         = true;
                $dataLog['ticket']['Descripcion'] = $descripcion;
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

            /*if (false !== $asignado) {
                $item -> responsable    = $asignado;
                $ticketUpdate           = true;
                $dataLog['ticket']['Asignado a']  = UsuarioRolEquipo::with('usuario')->find($asignado)->usuario->nombreCompleto;
            }*/

			if (false !== $prioridad) {
				$item -> prioridad    = $prioridad;
				$ticketUpdate         = true;
				$dataLog['ticket']['prioridad'] = $prioridad;
			}

			if (true === $ticketUpdate && false === $newticket) {
				$dataLog['accion']    = 'Ticket actualizado';
			}

            if($item -> save()) {
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

                if (true === $sendMail) {
                    try {
                        global $app;
                        $urlTicket = $app->path('item_detail', ['id'=>$item -> idItem], true);
                        $subject = 'Te han asignado un ticket. #' . $item -> idItem;
                        $from    = 'MasterTicket <ticket@sandbox2155.mailgun.org>';
                        $to      = $usuarioAsignado->nombreCompleto . '<'.$usuarioAsignado->email.'>';
                        $message = 'Puedes ver el detalle del ticket en el siguiente enlace
                                    <a href="'.$urlTicket.'">'.$urlTicket.'</a>';
                        $mail = new MailController();
                        $mail->sendMessage($from, $to, $subject, $message);
                    } catch(Exception $e) {

                    }
                }
            }

			return $item;
		}

		public function editForm($idTicket)
		{
			$response = Item::with([
					'asignado',
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

            $Item           = new Item();
            $estadoActual   = $Item->estadoActual($idTicket)->get();
            $workflow       = $Item->workFlow($idTicket)->get();

            $states             = [];
            $states['workflow'] = [];
            $idEstado           = 0;
            foreach ($estadoActual As $key => $estado)
            {
                $states['workflow'][] = [
                    'id'      => $estado->idEstado,
                    'nombre'  => $estado->nombreEstado,
                    'tipo'    => $estado->tipoEstado,
                ];
                $idEstado = $estado->idEstado;
            }
            foreach ($workflow As $key => $estado)
            {
                $states['workflow'][] = [
                    'id'      => $estado->idEstado,
                    'nombre'  => $estado->nombreEstado,
                ];
            }

            $tipoItems = TipoItem::tipoItemsProyecto($response->proyecto->idProyecto)->get();

            $usuarios_atencion = $this->usersByState($idEstado);

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
                    'workflow'    => $states['workflow'],
                    'equipo'      => $usuarios_atencion
			]);
		}

        public function createForm($id)
        {
            $response = Proyecto::with([
                    'tipoItem.estados'
                ]) -> find($id);

           // $tipoItems = TipoItemController::getByProject($id);

            $tipoItems = TipoItem::with([
                'estadoInicial.equiposAtencion.equiposActivos.usuariosRolActivos.miniUsuario',
                'estadoInicial.equiposAtencion.equiposActivos.usuariosRolActivos.rol'])
                ->where('estado', '=', '1')
                ->where('idProyecto', '=', $id)
                ->get();

            $data_relations['tipo_items'] = [];
            foreach ($tipoItems As $index => $tipoitem)
            {
                $data['items'][$index] = [
                    'id'      => $tipoitem->idTipoItem,
                    'nombre'  => $tipoitem->descripcion,
                    'estados' => []
                ];

                foreach ($tipoitem->estadoInicial As $key => $estado)
                {
                    $data['items'][$index]['estados'][$key] = [
                        'id'      => $estado->idEstado,
                        'nombre'  => $estado->nombreEstado
                    ];
                }
            }
            $data_relations['tipo_items'] = $data['items'];
            $usuarios_atencion = $this->usersByState($data_relations['tipo_items'][0]['estados'][0]['id']);
            return $this->render('tickets/agregar.html.twig', [
                'proyecto'      => $response,
                'relaciones'    => $data_relations,
                'workflow'      => $data_relations['tipo_items'][0]['estados'],
                'equipo'        => $usuarios_atencion
            ]);
        }

        public function usersByState($idEstado)
        {
            $equipoAtencion = new EquipoAtencion();
            /** @var \Illuminate\Database\Eloquent\Collection $usuarios */
            $usuarios = $equipoAtencion->usersByState($idEstado)->get();

                if (true === $usuarios->isEmpty()) {
                    $usuarios[] = Usuario::with([])
                        ->Join('UsuarioRolEquipo', 'UsuarioRolEquipo.idUsuario', '=', 'Usuario.idUsuario')
                        ->select('Usuario.idUsuario', 'Usuario.nombreCompleto', 'UsuarioRolEquipo.idUsuarioRolEquipo')
                        ->find(App::getInstance()->user->id());
                }

            return $usuarios;
        }

        public function delete($id = 0)
        {
            $ticket = Item::find($id);
            $ticket->estado = 0;
            return $ticket->save();
        }
	}