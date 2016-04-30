<?php

namespace Model\ORM;

class TransicionItem extends EntityBase{
    
    protected $table = "TransicionItem";
    
    protected $primaryKey = 'idTransicionItem';

    public function item(){
    	$this->belongsTo('Model\ORM\Item','idItem','idItem');
    }
    
    public function usuario(){
        $this->belongsTo('Model\ORM\Usuario','idiUsuario','idUsuario');
    }
}
