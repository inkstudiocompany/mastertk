<?php
	namespace Model\ORM;

    class Proyecto extends EntityBase
	{
        protected $table = 'Proyecto';
	    protected $primaryKey = 'idProyecto';

        public function lider(){
            return $this->belongsTo('Model\ORM\Usuario','idLider','idUsuario');
        }
        
        public function equipos(){
            return $this ->hasMany('Model\ORM\Equipo','idProyecto','idProyecto' );
        }
        
        public function tipoItem(){
            return $this ->hasMany('Model\ORM\TipoItem','idProyecto','idProyecto' );
        }
        public function items(){
            return $this->hasMany('Model\ORM\Item','idProyecto','idProyecto');
        }

        public function scopeTipoItemActivos(){

            return $this -> tipoItem() -> where('estado',1);
        }

        public function scopeEquiposActivos(){
            return $this -> equipos() -> where('estado',1);
        }

        public function scopeCuentaItemsPorEstado(){
          return $this -> items()
                -> join('Estado' ,'item.estadoActual', '=', 'Estado.idEstado')
                -> selectRaw('count(idItem) as cuentaItems, idProyecto, Estado.tipoEstado')
                -> groupBy(['idProyecto', 'Estado.tipoEstado']);
        }

	}