<?php

    namespace Application\Controller;

    use Model\ORM\Usuario as usuario;
    use Model\Security\UserSession;

    class SecurityController extends ControllerBase
    {
        public static $session = 'mastertkSecurity';

        public static function securityStart()
        {
            session_name(self::$session);
            session_start();
        }

        public static function logout()
        {
            session_destroy();
        }

        public function index()
        {
            echo $this->render('security/login.html.twig');
        }

        public function authenticate($email = false, $password = false)
        {
            $response = [
                'authenticated' => false
            ];

            if (false === $email || false === $password) {
                $response['authenticated'] = false;
            }

            $usuario = usuario::auth($email, $password)->get()->first();

            if (false != $usuario) {
                $this->createUserSession($usuario);
                $response['authenticated'] = true;
            }

            return $response;
        }

        private function createUserSession($usuario)
        {
            $_SESSION[self::$session]['USER'] = new UserSession($usuario);
        }

        public static function user()
        {
            if (true === self::AppAuthorization()) {
                return $_SESSION[self::$session]['USER'];
            }
            return false;
        }

        public static function AppAuthorization()
        {
            $auth = false;

            if (false === is_null($_SESSION) && false === empty($_SESSION)) {
                if (false !== isset($_SESSION[self::$session])
                    && false !== isset($_SESSION[self::$session]['USER'])) {
                    $auth = true;
                }
            }

            return $auth;
        }
    }