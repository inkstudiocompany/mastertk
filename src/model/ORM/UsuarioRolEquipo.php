<?php

namespace Model\ORM;

class UsuarioRolEquipo extends EntityBase{
    
    protected $table = "UsuarioRolEquipo";
    
    protected $primaryKey = 'idUsuarioRolEquipo';

		    public function idUsuario(){
                return $this->belongsTo('Model\ORM\Usuario','idUsuario','idUsuario');
            }

            public function idRol(){
                return $this->belongsTo('Model\ORM\Rol', 'idRol', 'idRol');
            }

            public function idEquipo(){
                return $this->belongsTo('Model\ORM\Equipo','idEquipo','idEquipo');
            }
        
}
