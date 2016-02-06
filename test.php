<?php
	require 'app/bootstrap.php';

	echo $twig->render('home/home.php.twig', array());

	use \Model\ORM\EquipoAtencion;
	use \Model\ORM\TransicionItem;
	use \Model\ORM\WorkFlow;
	use \Model\ORM\Item;
	use \Model\ORM\UsuarioRolEquipo;
	use \Model\ORM\Equipo;
	use \Model\ORM\Estado;
	use \Model\ORM\TipoItem;
	use \Model\ORM\Proyecto;
	use \Model\ORM\Usuario;
	use \Model\ORM\TipoDocumento;
	use \Model\ORM\Rol;
        
        $DB = Rol::resolveConnection();
        
        $DB->table('EquipoAtencion')->truncate();
        //$DB->table('TransicionItem')->truncate();
        //$DB->table('WorkFlow')->truncate();
        //$DB->table('Item')->truncate();
        $DB->table('UsuarioRolEquipo')->truncate();
        $DB->table('Equipo')->truncate();
        $DB->table('Estado')->truncate();
        $DB->table('TipoItem')->truncate();
        $DB->table('Proyecto')->truncate();
        $DB->table('Usuario')->truncate();
        $DB->table('TipoDocumento')->truncate();
        $DB->table('Rol')->truncate();

        //$DB->statement('truncate Rol;');
        
    

	//TransicionItem::delete();
	//WorkFlow::delete();
	// Item::truncate();
	// UsuarioRolEquipo::truncate();
	
	 
	// TipoItem::truncate();
	// Estado::truncate();
	// Equipo::truncate();
	
	// Proyecto::truncate();
	// Usuario::truncate();
	// Rol::truncate();

	$roles = Array(
		'Administrador', 'Invitado'
	);
	
	foreach($roles As $data)
	{
		$rol = new Rol();
		$rol->nombreRol = $data;
		$rol->save();
		echo $rol->id . '<br />';
	}