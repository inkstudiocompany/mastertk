<?php

namespace Model\ORM;

class Estado extends EntityBase{
    
    protected $table = "Estado";
    protected $primaryKey = 'idEstado';

    public function tickets(){
        return $this->hasMany('Model\ORM\Item', 'estadoActual', 'idEstado');
    }

    public function tipoItem(){
        return $this->belongsTo('Model\ORM\TipoItem', 'idTipoItem', 'idTipoItem');
    }

    public function equiposAtencion(){
        return $this -> hasMany('Model\ORM\EquipoAtencion','idEstado','idEstado');
    }

    public function workflows(){
        return $this->hasMany('Model\ORM\Workflow', 'idEstadoActual', 'idEstado');
    }

    public function scopeWorkflowsSiguientes(){
        return $this -> workflows() -> with(['estadoSiguiente.equipos']) -> where ('Workflow.deleted',0) ;
    }

    public function scopeEquipos(){
        return $this -> equiposAtencion() -> with(['equipo.usuarios']);
    }

}
