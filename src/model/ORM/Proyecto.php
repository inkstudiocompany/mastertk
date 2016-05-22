<?php
	namespace Model\ORM;

    class Proyecto extends EntityBase
	{
        protected $table = 'Proyecto';
	    protected $primaryKey = 'idProyecto';
		
        public function lider(){
            return $this->hasOne('Model\ORM\Usuario','idUsuario','idLider');
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
	}