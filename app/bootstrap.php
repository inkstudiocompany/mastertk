<?php
    define ('BASE', realpath('./') . '/');

	$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

	require BASE . 'vendor/autoload.php';
	require BASE . 'app/src/AppClass.php';
	require BASE . 'app/src/config.php';
	require BASE . 'app/src/capsule.php';

#	use Model\ORM\Equipo;
#	use Model\ORM\TipoItem;
#	use \Psr\Http\Message\ServerRequestInterface as Request;
#	use \Psr\Http\Message\ResponseInterface as Response;
	
	use Application\App as App;
    use Application\Controller\SecurityMiddleware;
	use Application\Controller\SecurityController;
#	use Application\Controller\HomeController;
#	use Application\Controller\ProjectController;
#	use Application\Controller\MyProjectController;
#	use Application\Controller\MyTicketController;
#	use Application\Controller\TeamController;
#	use Application\Controller\TipoItemController;
#	use Application\Controller\RolController;
 #   use Application\Controller\UserController;
 #   use Application\Controller\RequestParse;
    use Illuminate\Database\Eloquent;

	SecurityController::securityStart();
    $app = App::getInstance();

	$app::Router()->add(new SecurityMiddleware($app));

	require BASE . 'app/routes/security.php';
	require BASE . 'app/routes/application.php';
	require BASE . 'app/routes/proyectos.php';
	require BASE . 'app/routes/equipos.php';
	require BASE . 'app/routes/roles.php';
	require BASE . 'app/routes/tipoitems.php';
	require BASE . 'app/routes/usuarios.php';

	$app::Router()->run();
?>