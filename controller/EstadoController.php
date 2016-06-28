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
        $estados = estado::with([
                'tickets'
            ])
            -> where ('estado',1)
            -> where('idTipoItem','=',$id) -> get();
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
    }

    public static function saveNew($estado)
    {
        return $estado ->save();
    }

    public static function getEstadosSiguientes($estadoActual)
    {
        $estado=  estado::with(['workflowsSiguientes.estadoSiguiente.equipos'])
            -> where('estado',1)
            -> where('idEstado',$estadoActual) -> first();

        return $estado -> workflowsSiguientes;



    }

    public function delete($id)
    {
        $estado = self::getById($id);
        $estado -> estado = 0;
        return $estado -> save();
    }

    public function rename($nombre, $id)
    {
        $estado =  self::getById($id);
        $estado -> nombreEstado = $nombre;
        return $estado -> save();
    }


}