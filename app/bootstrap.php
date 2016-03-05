<?php
	define ('BASE', realpath('./') . '/');

	$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

	require BASE . 'vendor/autoload.php';
	require BASE . 'app/src/AppClass.php'; 
	require BASE . 'app/src/config.php';
    require BASE . 'app/src/capsule.php';

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;


	use Application\App as App;
	use Application\Controller\HomeController;
	use Application\Controller\ProjectController;
	use Application\Controller\RolController;
    use Application\Controller\UserController;

	$app = App::getInstance();

	$app::Router()->get('/', function(){
		$home = new HomeController();
		echo $home->index();
	});

	$app::Router()->get($app->path('homepage'), function(){
		$home = new HomeController();
		echo $home->index();
	});

	$app::Router()->get($app->path('my_projects'), function(){
		$home = new HomeController();
		echo $home->index();
	});

	$app::Router()->get($app->path('admin_project'), function(){
		$project = new ProjectController();
		echo $project->listado();
	});

	$app::Router()->get($app->path('new_project'), function(){
		$project = new ProjectController();
		echo $project->addForm();
	});

	$app::Router()->get($app->path('roles'), function(){
		$project = new RolController();
		echo $project->index();
	});

	$app::Router()->get($app->path('new_rol'), function(){
		$project = new RolController();
		echo $project->addForm();
	});

	$app::Router()->post($app->path('new_rol'), function( Request $request, Response $response, $args){
            $params = $request->getParsedBody();
            $nombre = $params['nombre'];
            $descripcion = $params['descripcion'];
			$rolController = new RolController();
            $rolController -> createNew($nombre, $descripcion);
            echo $rolController->index();
	});


	# USUARIO#

	$app::Router()->get($app->path('users'), function(){
		//var_dump("En usuarios");
		$usuariosController = new UserController();
		echo $usuariosController->index();
	});

	$app::Router()->get($app->path('new_user'), function(){
		$usuariosController = new UserController();
		echo $usuariosController->addForm();
	});


$app::Router()->post($app->path('new_usuario'), function( Request $request, Response $response, $args){
            $params = $request->getParsedBody();
            $numDocumento = $params['numDocumento'];
            $nombreCompleto = $params['nombreCompleto'];
            $email = $params['email'];
            $usuario = $params['usuario'];
            $password = $params['password'];
            $confirm_password = $params['confirm_password'];
            $descripcion = $params['descripcion'];
			$idTipoDocumento = $params['idTipoDocumento'];
			$idRolPrincipal = $params['idRolPrincipal'];
			$usuariosController = new UserController();
            $usuariosController -> createNew($numDocumento,$nombreCompleto,$email,$usuario,$password,$descripcion,$idTipoDocumento,$idRolPrincipal);
            echo $usuariosController->index();
	});


	$app::Router()->run();
?>