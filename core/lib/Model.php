<?php 
namespace core\lib;
use \core\lib\Conf;
use Medoo\Medoo;
class Model extends Medoo
{
	public function __construct(){
		/*$dsn = 'mysql:host=localhost;dbname=demo';
		$usnername = 'root';
		$password = '';
		$database = conf::all('database');
		try{
			parent::__construct($database['DSN'], $database['USERNAME'], $database['PASSWORD']);
		} catch(\PDOException $e){
			p($e->getMessage());
		}*/

		$option = Conf::all('Database');
		parent::__construct($option);
	}
}




 ?>