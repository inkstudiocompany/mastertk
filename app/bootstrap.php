<?php
	define ('BASE', realpath('./') . '/');

	require BASE . 'vendor/autoload.php';
	require BASE . 'app/src/AppClass.php'; 
	require BASE . 'app/src/config.php';
        require BASE . 'app/src/capsule.php';


	use Application\App as App;

	$app = App::getInstance();

	$app::Router()->get('/', function(){
		echo 'hello';
	});
	
	

	/** Twig **/

	$loader = new Twig_Loader_Filesystem(BASE . 'src/views');
	$twig = new Twig_Environment($loader, array(
    	'cache' => BASE . 'web/cache/views',
	));