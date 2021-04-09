<?php 

namespace app\controller;
use \app\model\UserModel;
use \app\model\CategoryModel;
use \app\model\ArticleModel;
use \app\model\CommentModel;


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
		$uid = $_SESSION['uid'];
		$userModel = new UserModel();
		$user = $userModel->getOne($uid);

		$articleModel = new ArticleModel();
		$articles = $articleModel->getArticleByUser($uid);

		$commentModel = new CommentModel();
		$comments = $commentModel->getCommentByUser($uid);

		//var_dump($user);
		//var_dump($articles);
		//var_dump($comments);
		$this->assign('loginUser', $user);
		$this->assign('articleCount', count($articles));
		$this->assign('commentCount', count($comments));
		//die();
		$this->display('admin.php');
	}

	public function change_password(){
		$this->display('change_password.php');
	}

	public function edit_profile(){
		$uid = $_SESSION['uid'];
		$userModel = new UserModel();
		$user = $userModel->getOne($uid);
		$this->assign('loginUser', $user);
		$this->display('edit_profile.php');
	}

	public function changepwd_check(){
		$oldpassword = post('oldpassword');
		$newpassword = post('newpassword');

		$model = new UserModel();
		$user = $model->getOne($_SESSION['uid']);
		if(password_verify($oldpassword,$user['password'])){
			$data['password'] = password_hash($newpassword, PASSWORD_DEFAULT);
			$model->updatePassword($data, $_SESSION['uid']);
			$arr['code'] = 1;
			$arr['msg'] = 'change password successfully, please login again!';
		}else{
			$arr['code'] = 0;
			$arr['msg'] = 'old password error, you can reset password use forget password in login page!';
		}
		echo json_encode($arr);
	}

	public function email_check(){
		$email = post('email');
		$model = new UserModel();
		$res = $model->getOneByEmail($email);
		
		if(!checkEmail($email) ){
			$arr['code'] = 0;
			$arr['msg'] = 'email format error!';
		}else if(empty($res) || $res['uid'] == $_SESSION['uid']){
			$arr['code'] = 1;
		}else{
			$arr['code'] = 0;
			$arr['msg'] = 'email has been registered';
		}
		echo json_encode($arr);
	}

	public function editprofile_check(){
		$data['realname'] = post('realname');
		$data['email'] = post('email');
		$data['phone'] = post('phone');
		$model = new UserModel();
		$res = $model->getOneByEmail($data['email']);
		if(!checkEmail($data['email']) || $res['uid']!=$_SESSION['uid'] ){
			fail_jump("/blog/admin/edit_profile", "invalid email or the email have been registered");
			return;
		}
		if(isset($_FILES['pic']) && isset($_FILES['pic']['name']) && $_FILES['pic']['name'] !=''){
			$img['image_name'] = $_FILES['pic']['name'];
			$img['image_path'] = date("s", time()).$_FILES["pic"]["name"];
			if( $_FILES["pic"]["tmp_name"] == null || $_FILES["pic"]["tmp_name"] =="" ||
				!file_is_an_image($_FILES["pic"]["tmp_name"], $img['image_path']) ){
				fail_jump("/blog/admin/edit_profile","only upload image!");
				return;
			}
			move_uploaded_file($_FILES["pic"]["tmp_name"],UPLOAD.$img['image_path']);
			// get extension of image
			$ext = explode(".", $img['image_name']);
	    	$ext = $ext[count($ext)-1];
	    	$data['profile_path'] = time().'.'.$ext;
	    	// resize image size
			resize_image($img['image_path'],$data['profile_path']);
		}
		
		$re = $model->setOne($_SESSION['uid'], $data);
		if($re < 1){
			fail_jump("/blog/admin/edit_profile", "Edit Profile error!");
			return;
		}
		succ_jump("/blog/admin/index", "Edit Profile Successfully!");
	}

	public function my_articles(){
		$uid = $_SESSION['uid'];
		$articleModel = new ArticleModel();
		$articles = $articleModel->getAllArticleByUser($uid);
		var_dump($articles);


	}







}