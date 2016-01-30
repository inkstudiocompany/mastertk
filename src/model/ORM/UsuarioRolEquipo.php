<?php

namespace Model\ORM;

class UsuarioRolEquipo extends EntityBase{
    
    protected $table = "UsuarioRolEquipo";
    
    protected $primaryKey = 'idUsuarioRolEquipo';

            public function usuario(){
                return $this->belongsTo('Model\ORM\Usuario','idUsuario','idUsuario');
            }

            public function rol(){
                return $this->belongsTo('Model\ORM\Rol', 'idRol', 'idRol');
            }

            public function equipo(){
                return $this->belongsTo('Model\ORM\Equipo','idEquipo','idEquipo');
            }
        
}
