<?php
	namespace Model\ORM;

    class Rol extends EntityBase
    {
            
	    protected $table = "Rol";
        protected $primaryKey = 'idRol';

		public function usuarios(){
			return $this->hasMany('Model\ORM\Usuario','idRolPrincipal', 'idRol');
		}

	}
        
        
        