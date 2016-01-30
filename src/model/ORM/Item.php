<?php

namespace Model\ORM;

class Item extends EntityBase{
    
    protected $table = "Item";
    
    protected $primaryKey = 'idItem';

	public function proyecto(){
                return $this->belongsTo('Model\ORM\Proyecto','idProyecto','idProyecto');
            }

            public function tipoItem(){
                return $this->belongsTo('Model\ORM\TipoItem', 'idTipoItem', 'idTipoItem');
            }

}
