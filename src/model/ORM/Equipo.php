<?php

namespace Model\ORM;

class Equipo extends EntityBase{
    
    protected $table = "Equipo";
    
    protected $primaryKey = 'idEquipo';
    
    public function proyecto(){
        return $this->belongsTo('Model\ORM\Proyecto','idProyecto','idProyecto');
    }

    public function usuarioRolEquipo(){
        return $this ->hasMany('Model\ORM\UsuarioRolEquipo','idEquipo','idEquipo');
    }



}