<?php
	namespace Model\ORM;

    class MyProyecto extends EntityBase
	{

        protected $table = 'Usuario';
	    protected $primaryKey = 'idUsuario';
		
        public function proyects(){
            return $this ->hasMany('Model\ORM\MyProyecto','idUsuario','idUsuario' );
        }

	}