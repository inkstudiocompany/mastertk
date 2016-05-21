<?php

namespace Model\ORM;

class Workflow extends EntityBase{
    
    protected $table = "WorkFlow";
    
    protected $primaryKey = 'idWorkFlow';

    public function estadoActual(){
        return $this->belongsTo('Model\ORM\Estado','idEstadoActual','idEstado');
    }
    
    public function estadoSiguiente(){
        return $this->belongsTo('Model\ORM\Estado','idEstadoSiguiente','idEstado');
    }
    
    
}
