<?php

namespace Model\ORM;

class TipoItem extends EntityBase{
    
    protected $table = "TipoItem";
    
    protected $primaryKey = 'idTipoItem';
	
    public function proyecto(){
        return $this->belongsTo('Model\ORM\Proyecto','idProyecto','idProyecto');
    }
        
    public function estados(){
        return $this ->hasMany('Model\ORM\Estado','idTipoItem','idTipoItem');
    }

		public function scopeTipoItemsProyecto($query, $idProyecto)
		{
			return $query->whereIdproyecto($idProyecto);
		}
}
