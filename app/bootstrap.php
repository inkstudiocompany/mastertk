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
	use Application\Controller\TeamController;	
	use Application\Controller\RolController;
    use Application\Controller\UserController;
    use Application\Controller\RequestParse;
    
	$app = App::getInstance();

	$app::Router()->get('prueba', function(){
		$home = new HomeController();
		echo $home->index();
	});

	$app::Router()->get($app->path('message_confirm'), function(Request $request, Response $response, $args){
		$dataResponse = [];
		$parse = new RequestParse($request, $args);
		
		$options = [];
		$options['title'] = $parse->get('title');
		$options['message'] = $parse->get('message');
		$dataResponse['html'] = App::getInstance()->Message()->confirm($options);
		$dataResponse['status'] = true;

		return $response->withJson($dataResponse);
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
            $productivoProyecto = $parse->get('proyectoproductivo');
			$idLider = $parse->get('idLider');

			$project = new ProjectController();
            $project -> createNew($nomProyecto,$objProyecto,$inicioProyecto,$finProyecto,$productivoProyecto,$idLider);

            echo $project->index();
	});



	# EQUIPO#

	$app::Router()->get($app->path('equipos'), function(){
		$equipo = new TeamController();
		echo $equipo->index();
	});

	$app::Router()->get($app->path('new_equipo'), function(){
		$team = new TeamController();
		echo $team->addForm();
	});

	$app::Router()->post($app->path('new_equipo'), function(Request $request, Response $response, $args){
		$parse = new RequestParse($request);
		$nomEquipo = $parse->get('nomEquipo');
        $idProyecto = $parse->get('idProyecto');

		$teamController = new TeamController();
        $teamController -> createNew($nomProyecto, $idProyecto);

        echo $teamController->index();
	});

	$app::Router()->get($app->path('edit_equipo'), function(){
		$equipo = new TeamController();
		echo $equipo->addForm();
	});

	$app::Router()->post($app->path('delete_equipo'), function(Request $request, Response $response, $args){
		$parse = new RequestParse($request, $args);
		$dataResponse = [];

		if ($id = $parse->get('id')) {
			$equipo = new TeamController();
			$dataResponse['status'] = (boolean) $equipo->delete($id);
		}
		
		return $response->withJson($dataResponse);
	});


/*
	$app::Router()->get($app->path('team'), function(){
		//var_dump("En EQUIPOS");
		$equiposController = new TeamController();
		echo $equiposController->index();
	});

	$app::Router()->get($app->path('new_team'), function(){
		$equiposController = new TeamController();
		echo $equiposController->addForm();
	});

	$app::Router()->post($app->path('new_team'), function( Request $request, Response $response, $args){
            $parse = new RequestParse($request);
 
            $nomEquipo = $parse->get('nomEquipo');
			$idUsuario = $parse->get('tipoDocumento');
			$idProyecto = $parse->get('rolPrincipal');
			$equiposController = new TeamController();
            $equiposController -> createNew($nomEquipo,$idUsuario,$idProyecto);
            
            echo $equiposController->index();
	});

*/

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

	$app::Router()->post($app->path('save_rol'), function(Request $request, Response $response, $args){
		$parse = new RequestParse($request, $args);

        $params = [
            'id' => $parse->get('id'),
            'nombre' => $parse->get('nombre'),
            'descripcion' => $parse->get('descripcion')
        ];

		RolController::Save($params);

        return $response->withRedirect(App::getInstance()->path('roles'), 301);
	});

	$app::Router()->get($app->path('edit_rol'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $rol = new RolController();
		echo $rol->editForm($parse->get('id'));
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


    /**
     * Usuarios
     */
	$app::Router()->get($app->path('users'), function(){
		$usuariosController = new UserController();
		echo $usuariosController->index();
	});

	$app::Router()->get($app->path('new_user'), function(){
		$usuariosController = new UserController();
		echo $usuariosController->addForm();
	});

    $app::Router()->get($app->path('edit_user'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $usuariosController = new UserController();
        echo $usuariosController->editForm($parse->get('id'));
    });

	$app::Router()->post($app->path('save_user'), function( Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);

        $params = [
            'id' => $parse->get('id'),
            'numDocumento' => $parse->get('numDocumento'),
            'nombreCompleto' => $parse->get('nombreCompleto'),
            'email' => $parse->get('email'),
            'nombreUsuario' => $parse->get('usuario'),
            'password' => $parse->get('password'),
            'tipoDocumento' => $parse->get('tipoDocumento'),
            'rolPrincipal' => $parse->get('rolPrincipal')
        ];

        UserController::Save($params);

        return $response->withRedirect(App::getInstance()->path('users'), 301);
	});

    $app::Router()->post($app->path('delete_user'), function(Request $request, Response $response, $args){
        $parse = new RequestParse($request, $args);
        $dataResponse = [];

        if ($id = $parse->get('id')) {
            $usuario = new UserController();
            $dataResponse['status'] = (boolean) $usuario->delete($id);
        }

        return $response->withJson($dataResponse);
    });

	$app::Router()->get($app->path('get_user'), function(Request $request, Response $response, $args){
		$parse = new RequestParse($request, $args);
		$dataResponse = [];
		if ($id = $parse->get('id')) {
			$dataResponse['usuarios'] = UserController::listUserByRol($id);
		}

		return $response->withJson($dataResponse);
	});

	$app::Router()->get($app->path('find_user'), function(Request $request, Response $response, $args){
		$parse = new RequestParse($request, $args);
		$dataResponse = [];
		if ($query = $args["query"]) {
			$dataResponse['usuarios'] = UserController::findUserByRolOrName($query);
		}

		return $response->withJson($dataResponse);
	});




	$app::Router()->run();
?>