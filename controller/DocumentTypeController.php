<?php


namespace Application\Controller;


use Model\ORM\TipoDocumento as tipoDocumento;

class DocumentTypeController extends ControllerBase implements EntityController
{

    public static function listAll(){
        return tipoDocumento::all();
    }


    public static function getById($id)
    {
        return tipoDocumento::find($id);
    }
}