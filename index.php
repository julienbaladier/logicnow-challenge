<?php

	//ini_set('display_errors', 'On');
	//error_reporting(E_ALL);


	/*
	* Defines __autoload functions used to include class definitions dynamically
	*/

	class AutoLoader{


		public static function ControllersLoader($class_name){
			include './Controllers/' . $class_name . '.php';
		}

		public static function ViewLoader($class_name){
			include './View/' . $class_name . '.php';
		}

		public static function ModelLoader($class_name){
			include './Model/' . $class_name . '.php';
		}

	}

	/* Adding these functions to the list */
	spl_autoload_register('AutoLoader::ControllersLoader');
	spl_autoload_register('AutoLoader::ViewLoader');
	spl_autoload_register('AutoLoader::ModelLoader');


	
	$dispatcher = new FrontController(); /* dispatcher creation */
	$dispatcher->processRequest(); /* request processing */

?>