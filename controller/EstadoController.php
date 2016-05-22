<?php

namespace Application\Controller;


use Model\ORM\EquipoAtencion as equipoAtencion;
use Model\ORM\Estado as estado;

class EstadoController extends ControllerBase
{

    public static function getById($id)
    {
        $estado = estado::find($id);
        return $estado;
    }


    public static function getByItemTypeId($id=0)
    {
        $estados = estado::where('idTipoItem','=',$id) -> get();
        return $estados;
    }

    public static function getEquiposDeAtencion($id)
    {
        $equipos = equipoAtencion::where('idEstado', '=',$id) -> get();
        return $equipos;

    }

    public static function updateEquiposAtencion($idEstado, $equiposAtencion)
    {
        equipoAtencion::where('idEstado', '=',$idEstado) -> delete();
        $estado = self::getById($idEstado);
        $estado -> equiposAtencion() ->saveMany ($equiposAtencion);
        //$estado-> save();
    }


}