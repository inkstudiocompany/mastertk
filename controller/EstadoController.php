<?php

namespace Application\Controller;


use Model\ORM\Estado as estado;

class EstadoController extends ControllerBase
{

    public static function getById($id)
    {
        $estado = estado::find($id);
    }


    public static function getByItemTypeId($id=0)
    {
        $estados = estado::where('idTipoItem','=',$id) -> get();
        return $estados;
    }


}