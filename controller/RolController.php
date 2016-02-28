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

        public static function listAll()
        {
            return rol::all();
        }

        // public function listado()
        // {
        // 	echo $this->render('proyectos/listado.html.twig');
        // }
    }