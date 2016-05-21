<?php

    namespace Application\Controller;

    use Model\ORM\Usuario as usuario;


    class UserController extends ControllerBase implements EntityController
    {

        public static function listUserByRol($rolId){
            $usuarios = RolController::getById($rolId) -> usuarios;
            return $usuarios;
        }


        public static function selfie($id,$path)
        {
            $usuario = usuario::find($id);
            $usuario -> selfie = $path;
            return $usuario -> save();
        }

        public static function getById($id)
        {
            return usuario::find($id);
        }

        public static function findUserByRolOrName($filter)
        {
           $usuarios = usuario::with('rolPrincipal')
               -> join('Rol', 'idRolPrincipal','=','idRol')
               -> where('nombreCompleto','like','%'.$filter.'%')
               -> orWhere('nombreRol','like','%'.$filter.'%')
               -> get() ;

            return $usuarios;
        }

        public function index()
        {
            $usuarios = usuario::with('rolPrincipal')->get();
            return  $this->render('usuarios/listado.html.twig', [
                'usuarios' => $usuarios,
                'tiposDocumento' => $this->getParameter('document_types')
            ]);

        }

        public static function listAll()
        {
            return usuario::all();
        }

        public static function listWithRolAll()
        {
            $usuarios = usuario::with('rolPrincipal')-> get() ;
            return $usuarios;
        }

        public function addForm()
        {
            return  $this->render('usuarios/usuarioForm.html.twig',[
                'title' => 'Agregar Usuario',
                'roles'=> RolController::listAll(),
                'tiposDocumento'=> $this->getParameter('document_types')

            ]);
        }

        public function editForm($id)
        {
            $usuario = usuario::find($id);

            return  $this->render('usuarios/usuarioForm.html.twig',[
                'title' => 'Editar Usuario',
                'usuario' => $usuario,
                'roles' => RolController::listAll(),
                'tiposDocumento'=> $this->getParameter('document_types')

            ]);
        }

        public function delete($id = 0)
        {
            $usuario = usuario::find($id);
            return $usuario->delete();
        }

        public static function Save($params){

            $id = self::getInput($params, 'id');
            $tipoDocumento = self::getInput($params, 'tipoDocumento');
            $numDocumento = self::getInput($params, 'numDocumento');
            $nombreCompleto = self::getInput($params, 'nombreCompleto');
            $email = self::getInput($params, 'email');
            $nombreUsuario = self::getInput($params, 'nombreUsuario');
            $password = self::getInput($params, 'password');
            $rolPrincipal = self::getInput($params, 'rolPrincipal');

            $usuario = new usuario();
            if (false === empty($id) && $id !== false && (int) $id > 0) {
                $usuario = self::getById($id);
            }

            $usuario -> idTipoDocumento   = $tipoDocumento;
            $usuario -> numDocumento      = $numDocumento;
            $usuario -> nombreCompleto    = $nombreCompleto;
            $usuario -> email             = $email;
            $usuario -> usuario           = $nombreUsuario;

            if ($password !== false) {
                $usuario->password = $password;
            }

            $rol = RolController::getById($rolPrincipal);
            $usuario -> rolPrincipal()-> associate($rol);

            $usuario -> save();

            return $usuario;
        }

    }