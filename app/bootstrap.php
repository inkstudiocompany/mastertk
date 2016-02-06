<?php
	define ('BASE', realpath('./') . '/');

	$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

	require BASE . 'vendor/autoload.php';
	require BASE . 'app/src/AppClass.php'; 
	require BASE . 'app/src/config.php';
    require BASE . 'app/src/capsule.php';

	use Application\App as App;
	use Application\Controller\HomeController;
	use Application\Controller\ProjectController;

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

	$app::Router()->run();
?>