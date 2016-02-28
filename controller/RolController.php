<?php

	namespace Application\Controller;

	use Model\ORM\Rol as rol;


	class RolController extends ControllerBase
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
            return rol::all();
        }

        public static function getById($id)
        {
            return rol::find($id);
        }

        // public function listado()
        // {
        // 	echo $this->render('proyectos/listado.html.twig');
        // }
    }