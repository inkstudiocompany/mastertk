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

	public function comentarios()
	{
		return $this->hasMany('Model\ORM\Comentario', 'idItem', 'idItem');
	}
        
	public function scopeDetalle($query, $id)
	{
		return $query->whereRaw('idItem = ' . $id);
	}

    public function scopeEstadoActual($query, $id)
    {
        return $query
            ->join('Estado', 'Item.estadoActual', '=', 'Estado.idEstado')
            ->where('Item.idItem', '=', $id)
            ->select('Estado.idEstado', 'Estado.nombreEstado');
    }

    public function scopeWorkFlow($query, $id)
    {
        return $query
            ->join('WorkFlow', 'Item.estadoActual', '=', 'WorkFlow.idEstadoActual')
            ->join('Estado', 'WorkFlow.idEstadoSiguiente', '=', 'Estado.idEstado')
            ->where('Item.idItem', '=', $id)
            ->select('Estado.idEstado', 'Estado.nombreEstado');
    }
}
