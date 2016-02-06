<?php

namespace Model\ORM;

class Workflow extends EntityBase{
    
    protected $table = "Workflow";
    
    protected $primaryKey = 'idWorkflow';

    public function estadoActual(){
    	$this->hasMany('Model\ORM\Estado','idEstadoActual','idEstado');
    }
    
    public function estadoSiguiente(){
    	$this->hasMany('Model\ORM\Estado','idEstadoSiguiente','idEstado');
    }
    
    
}
