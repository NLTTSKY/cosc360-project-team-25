<?php 
namespace core\lib;
use core\lib\Conf;

class log
{
	static $class;
	// log store type
	// write log
	public static function init(){
		$drive = Conf::get('DRIVE','Log');
		$class = '\core\lib\drive\log\\'.$drive;

		self::$class = new $class;


	}

	public static function log($name, $file = 'log')
	{
		if(self::$class == null){
			self::init();
		}
		self::$class->log($name, $file);
	}
}


 ?>