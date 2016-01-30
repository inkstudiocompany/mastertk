<?php

namespace Model\ORM;

class Equipo extends EntityBase{
    
    protected $table = "Equipo";
    
    protected $primaryKey = 'idEquipo';
    
    public function idProyecto(){
                return $this->belongsTo('Model\ORM\Proyecto','idProyecto','idProyecto');
            }
}
