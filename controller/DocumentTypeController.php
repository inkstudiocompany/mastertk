<?php


namespace Application\Controller;


use Model\ORM\TipoDocumento as tipoDocumento;

class DocumentTypeController extends ControllerBase
{

    public static function listAll(){
        return tipoDocumento::all();
    }

}