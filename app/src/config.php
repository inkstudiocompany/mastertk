<?php
	$config_path = BASE . 'app/config/parameters.ini';

	$parameters = parse_ini_file($config_path);	

	$app = Application\App::getInstance();

	foreach($parameters As $key => $value)
	{
		$app->set($key, $value);
	}