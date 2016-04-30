<?php

namespace Model\ORM;

class Comentario extends EntityBase{
    
  protected $table = "Comentario";

  protected $primaryKey = 'idComentario';

	public function item()
	{
		return $this->belongsTo('Model\ORM\Item','idItem','idItem');
  }

	public function usuario()
	{
		return $this->hasOne('Model\ORM\Usuario','idUsuario','idUsuario');
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
