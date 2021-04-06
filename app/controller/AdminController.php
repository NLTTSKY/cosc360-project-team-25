<?php 

namespace app\controller;
use \app\model\UserModel;
use \app\model\CategoryModel;
use \app\model\ArticleModel;


class AdminController extends \core\Starter
{

	public function __construct(){
		if(session_status() == 1){
            session_start();    
        }
        if(!isset($_SESSION['uid']) || $_SESSION['uid']==''){
        	fail_jump("/blog/index/index","You did not login!");
        }
        
	}

	public function index(){
		$title = "Admin";
		
		/*$model = new ArticleModel();
		$articles = [];
		if($_SESSION['type'] == 'admin'){
			$articles =  $model->getAllArticle();
		}else{
			$articles =  $model->getAllArticleByUser($_SESSION['uid']);
		}
		//var_dump($res)
		$this->assign('articles', $articles);*/
		$this->assign('title', $title);
		$this->display('admin.php');
	}




}