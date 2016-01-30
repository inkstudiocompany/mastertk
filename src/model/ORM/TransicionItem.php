<?php

namespace Model\ORM;

class TransicionItem extends EntityBase{
    
    protected $table = "TransicionItem";
    
    protected $primaryKey = 'idTransicionItem';

    public function workflow()
    {
    	$this->belongsTo('Model\ORM\WorkFlow','idWorkFlow','idWorkFlow');
    }
}
