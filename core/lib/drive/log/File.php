<?php 
namespace core\lib\drive\log;

use core\lib\conf;
class file
{
	public $path;#log store path
	public function __construct(){
		$conf = conf::get('OPTION', 'log');
		$this->path = $conf['PATH'];
	}
	public function log($message, $file='log')
	{
		if(!is_dir($this->path.date('Ymd'))){

			mkdir($this->path.date('Ymd'),'077', true);
		}
		$message = date('Y-m-d H:i:s')."      " . json_encode($message);
		return file_put_contents($this->path.date('Ymd').'/'.date('Y-m-d-H').$file.'.log', $message.PHP_EOL, FILE_APPEND);
	}
}


 ?>