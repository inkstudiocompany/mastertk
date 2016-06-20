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
            return  $this->render('roles/rolForm.html.twig', [
                'title' => 'Nuevo Rol'
            ]);
        }

        public function editForm($id)
        {
            $rol = Rol::find($id);
            return  $this->render('roles/rolForm.html.twig', [
                'title' => 'Editar Rol',
                'rol' => $rol
            ]);
        }

        public static function listAll()
        {
            return Rol::with(['Usuarios'])
                ->where('estado', '=', '1')
                ->get();
        }

        public static function getById($id)
        {
            return Rol::find($id);
        }

        public static function Save($params)
        {
            $id = self::getInput($params, 'id');
            $nombre = self::getInput($params, 'nombre');
            $descripcion = self::getInput($params, 'descripcion');

            $rol = new Rol();
            if (false === empty($id) && $id !== false && (int) $id > 0) {
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
            $rol->estado = 0;
            return $rol->save();
        }
    }