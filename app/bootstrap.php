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
    use Application\Controller\RequestParse;
    
	$app = App::getInstance();

	$app::Router()->get('prueba', function(){
		$home = new HomeController();
		echo $home->index();
	});

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

	/**
	 * Proyectos
	 */
	$app::Router()->get($app->path('admin_project'), function(){
		$project = new ProjectController();
		echo $project->listado();
	});

	$app::Router()->get($app->path('new_project'), function(){
		$project = new ProjectController();
		echo $project->addForm();
	});

	$app::Router()->post($app->path('new_project'), function( Request $request, Response $response, $args){
            $parse = new RequestParse($request);
            $nomProyecto = $parse->get('nomProyecto');
            $objProyecto = $parse->get('objProyecto');
            $inicioProyecto = $parse->get('inicioProyecto');
            $finProyecto = $parse->get('finProyecto');
            $productivoProyecto = $parse->get('productivoProyecto');
			$idLider = $parse->get('idLider');

			$project = new ProjectController();
            $project -> createNew($nomProyecto,$objProyecto,$inicioProyecto,$finProyecto,$productivoProyecto,$idLider);

            echo $project->index();
	});

	/**
	* Roles
	*/
	$app::Router()->get($app->path('roles'), function(){
		$rol = new RolController();
		echo $rol->index();
	});

	$app::Router()->get($app->path('new_rol'), function(){
		$project = new RolController();
		echo $project->addForm();
	});

	$app::Router()->post($app->path('new_rol'), function(Request $request, Response $response, $args){
		$parse = new RequestParse($request);
		$nombre = $parse->get('nombre');
        $descripcion = $parse->get('descripcion');

		$rolController = new RolController();
        $rolController -> createNew($nombre, $descripcion);

        echo $rolController->index();
	});

	$app::Router()->get($app->path('edit_rol'), function(){
		$rol = new RolController();
		echo $rol->addForm();
	});

	$app::Router()->post($app->path('delete_rol'), function(Request $request, Response $response, $args){
		$parse = new RequestParse($request, $args);
		$dataResponse = [];

		if ($id = $parse->get('id')) {
			$rol = new RolController();
			$dataResponse['status'] = (boolean) $rol->delete($id);
		}
		
		return $response->withJson($dataResponse);
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

	$app::Router()->post($app->path('new_user'), function( Request $request, Response $response, $args){
            $parse = new RequestParse($request);
            $numDocumento = $parse->get('numDocumento');
            $nombreCompleto = $parse->get('nombreCompleto');
            $email = $parse->get('email');
            $usuario = $parse->get('usuario');
            $password = $parse->get('password');
			$idTipoDocumento = $parse->get('tipoDocumento');
			$idRolPrincipal = $parse->get('rolPrincipal');
			$usuariosController = new UserController();
            $usuariosController -> createNew($numDocumento,$nombreCompleto,$email,$usuario,$password,$idTipoDocumento,$idRolPrincipal);
            
            echo $usuariosController->index();
	});


	$app::Router()->run();
?>