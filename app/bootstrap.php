<?php
	define ('BASE', realpath('./') . '/');

	require BASE . 'vendor/autoload.php';
	require BASE . 'app/src/AppClass.php'; 
	require BASE . 'app/src/config.php';
    require BASE . 'app/src/capsule.php';
    
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
?>