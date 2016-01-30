<?php
	namespace Model\ORM;

	class Usuario extends EntityBase{
            
            protected $table = "Usuario";
            protected $primaryKey = "idUsuario";

            public function idRolPrincipal(){
                return $this->belongsTo('Model\ORM\Rol','idRolPrincipal','idRol');
            }
            
            public function idTipoDocumento(){
                return $this->belongsTo('Model\ORM\TipoDocumento','idTipoDocumento','idTipoDocumento');
            }
               
        }