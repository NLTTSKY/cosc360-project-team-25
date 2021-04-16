<?php 
namespace app\controller;
use \app\model\ArticleModel;
use \app\model\CommentModel;
use \app\model\UserModel;

class SuperController extends \core\Starter {
	public function __construct(){
		if(session_status() == 1){
            session_start();    
        }
        if(!isset($_SESSION['uid']) || $_SESSION['uid']==''){
        	fail_jump("/blog/index/index","You did not login!");
        }

        if(!isset($_SESSION['type']) || $_SESSION['type']!='admin'){
        	fail_jump("/blog/admin/index","You did not have permission!");
        }
	}


	public function all_users(){
		$model = new UserModel();
		if(isset($_POST['search_type']) && isset($_POST['keyword'])){
			$type = post('search_type');
			$keyword = post('keyword');
			switch ($type) {
				case 'name':
					$users = $model->getUsersByName($keyword);
					break;
				case 'email':
					$users = $model->getUsersByEmail($keyword);
					break;
				case 'post':
					$users = $model->getUsersByPost($keyword);
					break;
				default:
					$users = $model->lists();
					break;
			}
			$this->assign('search_type', $type);
			$this->assign('keyword', $keyword);
		}else{
			$users = $model->lists();
		}
		$this->assign('users', $users);
		//var_dump($users);
		
		$this->display('all_users.php');
	}

	public function disable_user(){
		$uid = get('id');
		$model = new UserModel();
		$res = $model->disableUser($uid);
		if($res){
			succ_jump('/blog/super/all_users', 'disable user successfully');
		}else{
			fail_jump('/blog/super/all_users', 'disable user failed');
		}
	}

	public function enable_user(){
		$uid = get('id');
		$model = new UserModel();
		$res = $model->enableuser($uid);
		if($res){
			succ_jump('/blog/super/all_users', 'enable user successfully');
		}else{
			fail_jump('/blog/super/all_users', 'enable user failed');
		}
	}

	public function all_articles(){
		$model = new ArticleModel();
		$articles = $model->getAllArticle();
		$this->assign('articles', $articles);
		//var_dump($articles);
		//die();
		$this->display('all_articles.php');
	}

	public function confirm_article(){
		$id = get('id');
		$data['verify'] = 1;
		$model = new ArticleModel();
		$res = $model->setOne($id, $data);
		if($res){
			succ_jump('/blog/super/all_articles', 'confirm article successfully');
		}else{
			fail_jump('/blog/super/all_articles', 'confirm article failed');
		}
	}

	public function all_reports(){
		//$model = new ArticleModel();
		//$articles = $model->getAllArticle();
		//$this->assign('articles', $articles);
		//var_dump($articles);
		//die();
		$this->display('all_reports.php');
	}

	public function search_user(){

	}


	

}



 ?>