<?php
    namespace Model\Security;

    class UserSession
    {
        private $id;
        private $usuario;
        private $nombre;
        private $email;

        public function __construct($usuario)
        {
            $this->id = $usuario->idUsuario;
            $this->usuario = $usuario->usuario;
            $this->nombre = $usuario->nombreCompleto;
            $this->email = $usuario->email;
        }

        public function id()
        {
            return $this->id;
        }

        public function nombre()
        {
            return $this->nombre;
        }

        public function email()
        {
            return $this->email;
        }

        public function usuario()
        {
            return $this->usuario;
        }
    }