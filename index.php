<?php

	// environment type development or production

	defined( 'ENVIRONMENT' ) or define( 'ENVIRONMENT', 'development' );



	// get protocol

	defined( 'PROTOCOL' ) or define( 'PROTOCOL', isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://' );



	// host path

	defined( 'PATH_TO_HOST' ) or define( 'PATH_TO_HOST', PROTOCOL . $_SERVER['HTTP_HOST'] . '/' );

	// url path to root

	defined( 'BASE_URL' ) or define( 'BASE_URL', PATH_TO_HOST . 'zeldannlrc/'  );



	// url path to asssets like js/css/files

	defined( 'BASE_URL_ASSETS' ) or define( 'BASE_URL_ASSETS', BASE_URL . 'assets/' );



	// boolean for using database or not

	defined( 'USE_DATABASE' ) or define( 'USE_DATABASE', true );







	// require autoloader

	require_once 'core/Autoloader.php';



	$autoloaderParmas = array( // autoloader parmas

		'database' => array( // database info

			'load' => USE_DATABASE, // should we load the database

			'creds' => array( // database creds

				'hostname' => 'localhost',

				'username' => 'root',

				'password' => '',

				'database' => 'znlrcdb'

			)

		)

	);



	// run the autoloader so our files get loaded

	$autoloader = new Autoloader( $autoloaderParmas );



	$routerParams = array( // params for rounter instantiation

		'default_controller' => 'Guest',

		'default_method' => 'index'

	);



	// calculate route based on the query string

	$router = new Router( $routerParams );



	// load the calculated route

	$router->go( $autoloader );

?>

