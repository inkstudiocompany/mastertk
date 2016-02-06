<?php

namespace Model\ORM;

class Item extends EntityBase{
    
    protected $table = "Item";
    
    protected $primaryKey = 'idItem';

	public function proyecto(){
            return $this->belongsTo('Model\ORM\Proyecto','idProyecto','idProyecto');
        }

        public function tipoItem(){
            return $this->belongsTo('Model\ORM\TipoItem', 'idTipoItem', 'idTipoItem');
        }
        
        public function estadoActual(){
             return $this->belongsTo('Model\ORM\Estado', 'estadoActual', 'idEstado');
        }
        
        public function responsable(){
            return $this->belongsTo('Model\ORM\UsuarioRolEquipo', 'responsable', 'idUsuarioRolEquipo');
        }
        
        public function transiciones(){
            $this->hasMany('Model\ORM\TransicionItem','idItem','idItem');
        }
        
       

}
