<?php

namespace Model\ORM;

use Illuminate\Database\Eloquent\Collection;

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

    public function scopeUserEdit($query, $id)
    {
        return $query
            ->join('Proyecto', 'Proyecto.idProyecto', '=', 'Item.idProyecto')
            ->join('UsuarioRolEquipo', 'UsuarioRolEquipo.idUsuarioRolEquipo', '=', 'Item.responsable')
            ->where('Item.idItem', '=', $this->idItem)
            ->where('UsuarioRolEquipo.idUsuario', '=', $id)
            ->orWhere('Proyecto.idLider', '=', $id);
    }

    public function isEditable($idUsuario)
    {
        /** @var Collection $response */
        $response = $this->userEdit($idUsuario)->get();
        return !$response->isEmpty();
    }


    public function estadoA()
    {
        return $this->belongsTo('Model\ORM\Estado', 'estadoActual', 'idEstado');
    }

}
