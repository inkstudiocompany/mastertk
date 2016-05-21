<?php

	namespace Application\Controller;

	use Illuminate\Database\Eloquent\Collection;
	use Model\ORM\Estado;
	use Model\ORM\TipoItem as tipoitem;
	use Model\ORM\Workflow;


	class TipoItemController extends ControllerBase
	{
		public static function getIntialsStates()
		{
			$estados = new Collection();
			$estadoInicial = new Estado();
			$estadoInicial -> nombreEstado ="Abierto";
			$estadoFinal = new Estado();
			$estadoFinal -> nombreEstado ="Cerrado";
			$estados ->add($estadoInicial);
			$estados ->add($estadoFinal);
			return $estados;
		}

		public static function getByProject($id)
		{
			$tipoitems = tipoitem::first()
				-> where ('idProyecto','=',$id)
				-> get();
			return $tipoitems;
		}

		public static function getWorkflows($id)
		{
			$workflows = Workflow::first()
				->join("Estado as ea", "ea.idEstado","=","idEstadoActual")
				->join("Estado as es", "es.idEstado","=","idEstadoSiguiente")
				->where("deleted","=",0)
				->where(function($query) use($id) {
					return $query->where("ea.idTipoItem","=",$id)
						->orWhere("es.idTipoItem","=",$id);
				})
				-> get();


			return $workflows;
		}

		public static function updateWorkflows($id, $nuevosWorkflows)
		{
			$workflows =  self::getWorkflows($id);
			foreach($workflows as $workflow){
				$workflow -> deleted ='1';
				$workflow ->save();
			}
			foreach($nuevosWorkflows as $workflow){
				$workflow ->save();
			}

		}

		public function index()
		{
			return $this->render('tipoitems/listado.html.twig',[
		           'tipoitems' => self::listAll()
				]);
		}
	

		public function listado()
		{
			$tipoitems = tipoitem::with('estados')
			->join('Estado', 'Estado.idTipoItem', '=', 'TipoItem.idTipoItem')
			-> get();
			
			return $this->render('tipoitems/listado.html.twig', [
				'tipoitems' => $tipoitems
			]);
		}

        public function edit_tipoitem($id)
        {
			$tipoitems = tipoitem::with('estados')
			->join('Estado', 'Estado.idTipoItem', '=', 'TipoItem.idTipoItem')
			-> get();
			
            return  $this->render('tipoitems/tipoitemsForm.html.twig',[
                'title' => 'Editar Item'
            ]);
        }

/*
   		public function addForm()
		{
			return  $this->render('tipoitems/agregar.html.twig');
		}
*/

/*
        public function createNew($nombreEquipo,$idProyecto,$idUsuario){
            $equipo = new equipo();
            $equipo -> nomEquipo = $nombreEquipo;
            
            $equipo = ProyectController::getById($idProyecto);
            //$equipo -> lider() -> associate($usuario);

            $equipo = UserController::getById($idUsuario);
            //$equipo -> lider() -> associate($usuario);
            
            $equipo -> save();
            return $proyecto;
        }
*/
        public static function listAll()
        {
            return TipoItem::all();
        }


        public function delete($id = 0) 
        {
            $tipoitem = TipoItem::find($id);
            return $tipoitem->delete();
        }

	}