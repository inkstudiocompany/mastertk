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
            return  $this->render('roles/rolForm.html.twig');
        }

        public function editForm($id)
        {
            $rol = Rol::find($id);
            return  $this->render('roles/rolForm.html.twig', [
                'rol' => $rol
            ]);
        }

        public static function listAll()
        {

            return Rol::all();
        }

        public static function getById($id)
        {
            return Rol::find($id);
        }

        public static function Save($params)
        {
            $id = false;
            if(isset($params['id']) && !empty($params['id'])) {
                $id = $params['id'];
            }

            $nombre = '';
            if(isset($params['nombre']) && !empty($params['nombre'])) {
                $nombre = $params['nombre'];
            }

            $descripcion = '';
            if(isset($params['descripcion']) && !empty($params['descripcion'])) {
                $descripcion = $params['descripcion'];
            }

            $rol = new Rol();
            if($id !== false) {
                $rol = self::getById($id);
            }

            $rol -> nombreRol = $nombre;
            $rol -> descripcion= $descripcion;
            $rol -> save();
            return $rol;
        }

        public function delete($id = 0) 
        {
            $rol = Rol::find($id);
            return $rol->delete();
        }
    }