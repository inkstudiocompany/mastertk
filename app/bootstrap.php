<?php
    define ('BASE', realpath('./') . '/');
    define ('ENVIRONMENT', 'develop');

	$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

	require BASE . 'vendor/autoload.php';
	require BASE . 'app/src/AppClass.php';
	require BASE . 'app/src/config.php';
	require BASE . 'app/src/capsule.php';

	use Application\App as App;
	use Application\Controller\SecurityMiddleware;
	use Application\Controller\SecurityController;
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
	require BASE . 'app/routes/items.routes.php';

	$app::Router()->run();
?>