<?php

    namespace Application\Controller;

    use Model\ORM\Usuario as usuario;


    class UserController extends ControllerBase
    {

        public static function listUserByRol($rolId){
            $usuarios = RolController::getById($rolId) -> usuarios;
            return $usuarios;
        }




    }