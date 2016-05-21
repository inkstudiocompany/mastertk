<?php

namespace Model\ORM;

class TransicionItem extends EntityBase{
    
    protected $table = "TransicionItem";
    
    protected $primaryKey = 'idTransicionItem';

    public function item(){
    	return $this->belongsTo('Model\ORM\Item','idItem','idItem');
    }
    
    public function usuario(){
        return $this->hasOne('Model\ORM\Usuario','idUsuario','idUsuario');
    }
}
