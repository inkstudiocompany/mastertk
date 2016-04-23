<?php
	namespace Model\ORM;

    class MyTicket extends EntityBase
	{
        protected $table = 'Item';
		
	    protected $primaryKey = 'idItem';
		
        public function tickets(){
            return $this ->hasMany('Model\ORM\MyTicket','idUsuario','idItem','idProyecto' );

        }
        
	}
