<?php

namespace Model\ORM;

class TransicionItem extends EntityBase{
    
    protected $table = "TransicionItem";
    
    protected $primaryKey = 'idTransicionItem';

    public function workflow(){
    	$this->belongsTo('Model\ORM\WorkFlow','idWorkFlow','idWorkFlow');
    }
    
    public function item(){
    	$this->belongsTo('Model\ORM\Item','idItem','idItem');
    }
    
    public function actor(){
        $this->belongsTo('Model\ORM\Usuario','actor','idUsuario');
    }
}
