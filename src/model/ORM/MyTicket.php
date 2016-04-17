<?php
	namespace Model\ORM;

    class MyTicket extends EntityBase
	{
        protected $table = 'Proyecto';
		
	    protected $primaryKey = 'idProyecto';
		
        public function tickets(){
            return $this ->hasMany('Model\ORM\MyTicket','idProyecto','idProyecto' );

        }
        
	}