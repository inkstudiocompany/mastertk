<?php

namespace Model\ORM;

class Workflow extends EntityBase{
    
    protected $table = "Workflow";
    
    protected $primaryKey = 'idWorkflow';

    public function transicionitem()
    {
    	$this->hasMany('Model\ORM\TransicionItem','idWorkFlow','idWorkFlow');
    }
}
