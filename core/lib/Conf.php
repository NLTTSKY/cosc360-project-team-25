<?php 
namespace core\lib;
class conf
{
	static public $conf = array();
	static public function get($name, $file)
	{
		if(isset(self::$conf[$file])){
			return self::$conf[$file][$name];
		}
		// file exist
		$path = ROOT_PATH.'\\core\\config\\'.$file.'.php';
		if(is_file($path)){
			// config exist
			$conf = include $path;
			if(isset($conf[$name])){
				self::$conf[$file] = $conf;
				return $conf[$name];
			}else{
				throw new \Exception("Can't find the config parameter ".$name, 1);
			}
		}else{
			throw new \Exception("Can't find the config file ".$path, 1);
		}
		
	}

	public static function all($file){
		if(isset(self::$conf[$file])){
			return self::$conf[$file];
		}
		// file exist
		$path = ROOT_PATH.'\\core\\config\\'.$file.'.php';
		if(is_file($path)){
			// config exist
			$conf = include $path;
			self::$conf[$file] = $conf;
			return $conf;
		}else{
			throw new \Exception("Can't find the config file ".$path, 1);
		}
	}

}




 ?>