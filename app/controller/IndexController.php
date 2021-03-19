<?php 
namespace app\controller;

class IndexController extends \core\Starter
{
	public function __construct(){
		if(session_status() == 1){
            session_start();    
        }
	}

	public function index()
	{
		var_dump("index");
	}
	
}




 ?>