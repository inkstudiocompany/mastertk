<?php
	define ('BASE', realpath('./') . '/');

	require BASE . 'vendor/autoload.php';
	require BASE . 'app/src/AppClass.php'; 
	require BASE . 'app/src/config.php';

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Application\App as App;
	use Application\Controller\HomeController;


	$app = App::getInstance();

	$app::Router()->get('/', function(){
		$home = new HomeController();
		echo $home->index();
	});

	$app::Router()->get('/home', function(){
		$home = new HomeController();
		echo $home->index();
	});

	$app::Router()->run();
	/*$capsule = new Capsule;

	$app = App::getInstance();

	/*$capsule->addConnection([
	 'driver' => $app->get('driver'),
	 'host' => $app->get('db_host'),
	 'database' => $app->get('database'),
	 'username' => $app->get('db_username'),
	 'password' => $app->get('db_password'),
	 'charset' => 'utf8',
	 'collation' => 'utf8_unicode_ci',
	 'prefix' => '',
	]);
	
	$capsule->bootEloquent();*/