<?php
	/**
	 * Entry file
	 *
	 * 1.Define constant
	 * 2.Load function library
	 * 3.Start frame
	 * 
	 */
	
	define('ROOT_PATH', realpath('./'));
	define('CORE', ROOT_PATH.'/core');
	define('APP', ROOT_PATH.'/app');
	define('UPLOAD', ROOT_PATH.'/public/img/');

	define('MODULE', 'app');
	define('PROJECT', '/blog/');

	define('DEBUG', true);

	include 'vendor/autoload.php';

	if(DEBUG){
		$whoops = new \Whoops\Run;
		$errorTitle = 'Sorry, there are some error!';
		$option = new \Whoops\Handler\PrettyPageHandler;
		$option->setPageTitle($errorTitle);
		$whoops->pushHandler($option);
		$whoops->register();

		ini_set('display_error', 'On');
	}else{
		ini_set('display_error', 'Off');
	}

	//dump($_SERVER);
	//exit();

	include CORE.'/common/Function.php';
	include CORE.'/Starter.php';
	//p(ROOT_PATH);
	

	spl_autoload_register('\core\Starter::load');
	\core\starter::run();


?>