<?php

    namespace Application\Controller;

    use Model\ORM\Usuario as usuario;


    class UserController extends ControllerBase implements EntityController
    {

        public static function listUserByRol($rolId){
            $usuarios = RolController::getById($rolId) -> usuarios;
            return $usuarios;
        }


        public static function getById($id)
        {
            usuario::find($id);
        }

        public function index()
        {
            return  $this->render('usuarios/listado.html.twig', [
                'usuarios' => self::listAll()
            ]);

        }

        public static function listAll()
        {
            return usuario::all();
        }

        public function addForm()
        {
            return  $this->render('usuarios/agregar.html.twig',[
                'roles'=> RolController::listAll(),
                'tiposDocumento'=> DocumentTypeController::listAll()

            ]);
        }


    }