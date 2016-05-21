<?php

    namespace Application\Controller;

    use Model\ORM\Usuario as usuario;
    use Model\Security\UserSession;
    use PHPEncryptData\Simple;


    class SecurityController extends ControllerBase
    {
        public static $session = 'mastertkSecurity';

        public static function securityStart()
        {
            session_name(self::$session);
            @session_start();
        }

        public static function logout()
        {
            $usuario = usuario::find($_SESSION[self::$session]['USER']->id());
            $usuario->accessToken = '';
            $usuario->save();
            session_destroy();
        }

        public function index()
        {
            echo $this->render('security/login.html.twig');
        }

        public function profile($id)
        {
            $usuario = usuario::find($id);
            echo $this->render('security/profile.html.twig', [
                'usuario' => $usuario,
                'tiposDocumento'=> $this->getParameter('document_types')
            ]);
        }

        public function authenticate($email = false, $password = false, $rememberme = false)
        {
            $response = [
                'authenticated' => false,
                'rememberme'    => false
            ];

            if (false === $email || false === $password) {
                $response['authenticated'] = false;
            }

            /** @var Usuario $usuario */
            $usuario = usuario::auth($email, $password)->get()->first();

            if (false != $usuario) {
                $this->createUserSession($usuario);
                $response['authenticated'] = true;
            }

            $usuario->accessToken = '';
            if (true === filter_var($rememberme, FILTER_VALIDATE_BOOLEAN)) {
                $usuario->accessToken = $response['rememberme'] = self::generateAccessToken($_SESSION[self::$session]['USER']);
            }
            $usuario->save();

            return $response;
        }

        public function tockenAuthenticate($tocken_access)
        {
            $response = [
                'authenticated' => false,
                'rememberme'    => $tocken_access
            ];

            /** @var Usuario $usuario */
            $usuario = usuario::accessTockenAuth($tocken_access)->get()->first();

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

        public static function generateAccessToken($userSession)
        {
            $encryptionKey  = 'Qf4pv2cW8ZnHahGukx8K+FtGzTGwoErv7Kt4XArO+xI=';
            $macKey         = 'yA2Shj2v8K5Ra/L0oUTZd3jM3FuzMljjjA1KRLrfWyA=';

            $phpcrypt = new Simple($encryptionKey, $macKey);

            return $phpcrypt->encrypt($userSession->id().$userSession->nombre().date('YmdHis'));
        }
    }