<?php

namespace Model\ORM;

class Item extends EntityBase{
    
  protected $table = "Item";

  protected $primaryKey = 'idItem';

	public function proyecto()
	{
		return $this->belongsTo('Model\ORM\Proyecto','idProyecto','idProyecto');
  }

  public function tipoItem()
  {
	  return $this->belongsTo('Model\ORM\TipoItem', 'idTipoItem', 'idTipoItem');
  }

  public function estado()
  {
	  return $this->belongsTo('Model\ORM\Estado', 'estadoActual', 'idEstado');
  }

  public function asignado()
  {
	    return $this->belongsTo('Model\ORM\UsuarioRolEquipo', 'responsable', 'idUsuarioRolEquipo');
  }

  public function transiciones()
  {
	  return $this->hasMany('Model\ORM\TransicionItem','idItem','idItem');
  }
        
	public function scopeDetalle($query, $id)
	{
		return $query->whereRaw('idItem = ' . $id);
	}

}
