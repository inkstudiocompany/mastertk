<?php

namespace Model\ORM;

class TipoItem extends EntityBase{
    
    protected $table = "TipoItem";
    
    protected $primaryKey = 'idTipoItem';
	
        public function proyecto(){
                return $this->belongsTo('Model\ORM\Proyecto','idProyecto','idProyecto');
            }

}
