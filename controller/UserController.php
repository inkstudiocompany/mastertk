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

        public  function createNew($numDocumento,$nombreCompleto,$email,$usuario,$password,$descripcion,$idTipoDocumento,$idRolPrincipal){
            $usuario= new Usuario();
            $usuario -> numDocumento = $numDocumento;
            $usuario -> nombreCompleto = $nombreCompleto;
            $usuario -> email = $email;
            $usuario -> usuario = $usuario;
            $usuario -> password = $password;
            $usuario -> descripcion = $descripcion;
            $rol = RolController::getById($idRolPrincipal);
            $tipodedocumento = DocumentTypeController::getById($idTipoDocumento);
            $usuario -> rolPrincipal()-> associate($rol);
            $usuario -> tipoDocumento()-> associate($tipodedocumento);
            $usuario -> save();
            return $usuario;
        }

    }