<?php 
namespace core\lib;
use core\lib\Conf;
class Route
{
	public $ctrl;
	public $action;

	public function __construct()
	{
		//p("route ok");
		/**
		 * xxx.com/index/index
		 *
		 * 1. hide index.php
		 * 2. get url and parameter
		 * 3. return controller and method
		 */
		//p($_SERVER['REQUEST_URI']);
		if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != PROJECT){
			// get url
			// index/index
			$path = $_SERVER['REQUEST_URI'];
			$patharr = explode('/', trim($path , PROJECT));
			if(isset($patharr[0])){
				$this->ctrl = $patharr[0];
				unset($patharr[0]);
			}
			if(isset($patharr[1]) && $patharr[1] == "detail"){
				if(isset($patharr[2])){
					$_GET['id'] = $patharr[2];
					unset($patharr[2]);
				}
				if(isset($patharr[3])){
					$_GET['p'] = $patharr[3];
					unset($patharr[3]);
				}
			}
			if(isset($patharr[1])){
				$this->action = $patharr[1];
				unset($patharr[1]);
			}else{
				$this->action = Conf::get('ACTION', 'Route');
			}
			// get parameter
			// index/index/id/1
			$count = count($patharr)+2;
			$i = 2;
			while ($i < $count) {
				if(isset($patharr[$i + 1])){
					$_GET[$patharr[$i]] = $patharr[$i + 1];
				}
				$i = $i+2;
			}
		} else {
			$this->ctrl = Conf::get('CTRL', 'Route');
			$this->action = Conf::get('ACTION', 'Route');
		}
	}
}


 ?>