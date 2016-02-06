<?php

    use Illuminate\Database\Capsule\Manager as ManagerCapsule;
    
    $capsule = new  ManagerCapsule();

    $capsule->addConnection([
         'driver' => $app->get('driver'),
         'host' => $app->get('db_host'),
         'database' => $app->get('database'),
         'username' => $app->get('db_username'),
         'password' => $app->get('db_password'),
         'charset' => 'utf8',
         'collation' => 'utf8_unicode_ci',
         'prefix' => '',
        ]);

    $capsule->bootEloquent();
       
        
