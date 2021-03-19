<?php 
namespace core;

use \core\lib\Log;

class Starter
{
	public static $classMap = array();
	public $assign;

	static public function run()
	{

		//\core\lib\log::init();
		//\core\lib\log::log("test log");
		//\core\lib\log::log($_SERVER);
		//p("ok, program running");
		$route = new \core\lib\route();
		$ctrlClass = $route->ctrl;
		$action = $route->action;
		$ctrlFile = APP.'/controller/'.ucfirst($ctrlClass).'controller.php';
		//p($ctrlFile);
		$ctrlClass = '\\'.MODULE.'\controller\\'.ucfirst($ctrlClass).'Controller';
		if (is_file($ctrlFile)) {
			include $ctrlFile;
			$ctrl = new $ctrlClass;
			$ctrl->$action();
			//p();
			Log::log("Controller:".ucfirst($route->ctrl).'Controller      action:'.$action);
		}else{
			throw new \Exception("can't find controller which named ".$ctrlClass, 1);
		}
		//p($route);

	}

	static public function load($class)
	{
		// auto load library
		// new \core\route();
		// $class = '\core\route';
		//p($class);
		//p(ROOT_PATH.'\\'.$class.'.php');
		if (isset($classMap[$class])) {
			return true;
		}
		$class = str_replace('\\', '/', $class);
		$file = ROOT_PATH.'/'.$class.'.php';
		if (is_file($file)) {
			include $file;
			self::$classMap[$class] = $class;
		} else {
			return false;
		}
	}

	public function assign($name, $value)
	{
		$this->assign[$name] = $value;
	}

	public function display($file)
	{
		$path = APP.'/views/'.$file;
		//p($path);
		if(is_file($path)){
			extract($this->assign);

			/*$loader = new \Twig\Loader\FilesystemLoader(APP.'/views/');
			$twig = new \Twig\Environment($loader, [
			    'cache' => ROOT_PATH.'/log/twig',
    			'debug' => true
			]);
			$template = $twig->load($file);
			$template->display($this->assign?$this->assign:array());*/
			include $path;
		}
	}
}



 ?>