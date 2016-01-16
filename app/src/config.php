<?php
	$config_path = BASE . 'app/config/parameters.ini';

	$parameters = parse_ini_file($config_path);	

	$app = App::getInstance();

	foreach($parameters As $key => $value)
	{
		$app->set($key, $value);
	}

	echo $app->get('username');


	//

	//var_dump($app);