<?php

	namespace Application\Controller;

	use Model\ORM\Rol;


    class RolController extends ControllerBase implements EntityController
    {
        public function index()
        {
            return  $this->render('roles/listado.html.twig', [
                    'roles' => self::listAll()
                ]);

        }

        public function addForm()
        {
            return  $this->render('roles/agregar.html.twig');
        }

        public static function listAll()
        {

            return Rol::all();
        }

        public static function getById($id)
        {
            return Rol::find($id);
        }

        public  function createNew($nombre, $descripcion){
            $rol= new Rol();
            $rol -> nombreRol = $nombre;
            $rol -> descripcion= $descripcion;
            $rol -> save();
            return $rol;
        }
    }