<?php

	namespace Application\Controller;

	use Illuminate\Database\Eloquent\Collection;
	use Model\ORM\Estado;
	use Model\ORM\TipoItem as tipoitem;
	use Model\ORM\Workflow as workflow;


	class TipoItemController extends ControllerBase
	{
		public static function getIntialsStates()
		{
			$estados = new Collection();
			$estadoInicial = new Estado();
			$estadoInicial -> nombreEstado ="Abierto";
			$estadoInicial -> tipoEstado = 1;
			$estadoFinal = new Estado();
			$estadoFinal -> nombreEstado ="Cerrado";
			$estadoFinal -> tipoEstado = 2;
			$estados ->add($estadoInicial);
			$estados ->add($estadoFinal);
			return $estados;
		}

		public static function getByProject($id)
		{
			$tipoitems = tipoitem::with('tickets')
				-> where ('estado',1)
				-> where ('idProyecto','=',$id)
				-> get();
			return $tipoitems;
		}

		public static function getWorkflows($id)
		{

			$workflows = workflow::where("deleted","=",0)
				->join("Estado as ea", "ea.idEstado","=","idEstadoActual")
				->join("Estado as es", "es.idEstado","=","idEstadoSiguiente")
				->where(function($query) use($id) {
					return $query->where("ea.idTipoItem","=",$id)
						->orWhere("es.idTipoItem","=",$id);
				})-> get();
			return $workflows;
		}

		public static function updateWorkflows($id, $nuevosWorkflows)
		{
			workflow::where("deleted","=",0)
				->join("Estado as ea", "ea.idEstado","=","idEstadoActual")
				->join("Estado as es", "es.idEstado","=","idEstadoSiguiente")
				->where(function($query) use($id) {
					return $query->where("ea.idTipoItem","=",$id)
						->orWhere("es.idTipoItem","=",$id);
				}) -> update(['deleted' => 1]);
			foreach($nuevosWorkflows as $workflow){
				$workflowDB =  workflow::buscarPorEstados($workflow -> idEstadoActual, $workflow -> idEstadoSiguiente)
					-> first();
				if(!is_null($workflowDB)){
					$workflowDB -> deleted = 0;
					$workflowDB -> save();
				}else{
					$workflow ->save();
				}
			}
		}

		public static function createNew($tipoItem)
		{
			$tipoItem -> save();
			$tipoItem -> estados() -> saveMany(self::getIntialsStates());
		}

		public function index()
		{
			return $this->render('tipoitems/listado.html.twig',[
		           'tipoitems' => self::listAll()
				]);
		}

		public function listado()
		{
			$tipoitems = tipoitem::with([
                'estados',
                'proyecto'
            ])
            ->distinct()
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
       public static function listAll()
        {
            return TipoItem::where('estado',1);
        }


        public function delete($id = 0) 
        {
            $tipoitem = TipoItem::find($id);
			$tipoitem -> estado = 0;
            return $tipoitem->save();
        }

		public static function getByProjectWithRelationship($id)
		{
			$tipoitems = tipoitem::with(['estados',
				'estados.equiposAtencion',
				'estados.equiposAtencion.equipo',
				'estados.equiposAtencion.equipo.UsuarioRolEquipo',
				'estados.equiposAtencion.equipo.UsuarioRolEquipo.usuario'])
			->where ('idProyecto','=',$id)
				-> get();
			return $tipoitems;
		}

		public function rename($descripcion, $id)
		{
			$tipoitem = TipoItem::find($id);
			$tipoitem -> descripcion = $descripcion;
			return $tipoitem -> save();
		}

	}