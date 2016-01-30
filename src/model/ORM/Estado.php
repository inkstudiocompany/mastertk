<?php

namespace Model\ORM;

class Estado extends EntityBase{
    
    protected $table = "Estado";
    
    protected $primaryKey = 'idEstado';
	
            public function tipoItem(){
                return $this->belongsTo('Model\ORM\TipoItem', 'idTipoItem', 'idTipoItem');
            }
	
}
