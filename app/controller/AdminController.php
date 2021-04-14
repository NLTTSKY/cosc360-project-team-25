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
		//var_dump($articles);
		$this->assign('articles', $articles);
		$this->display('my_articles.php');

	}

	public function new_article(){
		$categoryModel = new CategoryModel();
		$parent = $categoryModel->getParentCate();

		$childCate = $categoryModel->listByParentId($parent[0]['cate_id']);
		$this->assign('parent', $parent);
		$this->assign('childCate', $childCate);
		$this->display('new_article.php');
	}

	public function getCategoryByParentId(){
		$catemodel = new CategoryModel();
		$id = post('id',0,'int');
		$childCate = $catemodel->listByParentId($id);
		$arr['code'] = 1;
		$arr['data'] = $childCate;
		echo json_encode($arr);
	}

	public function addArticle(){
		$data['cate_id'] = post('cate_id');
		$data['title'] = post('title');
		$data['content'] = $_POST['content'];
		if($data['cate_id'] == ''  ){
			fail_jump("/blog/admin/new_article","category can't be empty!");
			return;
		};
		if($data['title'] == ''  ){
			fail_jump("/blog/admin/new_article","title can't be empty!");
			return;
		};
		if($data['content'] == ''){
			fail_jump("/blog/admin/new_article","content can't be empty!");
			return;
		};
		$data['uid'] = $_SESSION['uid'];
		$data['create_time'] = date("Y-m-d H:i:s", time());
		$data['last_update_time'] = date("Y-m-d H:i:s", time());

		$artmodel = new ArticleModel();
		$art_no = $artmodel->addOne($data);
		if($art_no<1){
			fail_jump("/blog/admin/new_article","create article failed!");
			return;
		}
		succ_jump("/blog/admin/my_articles","create article successfully!");
	}

	public function editArticle(){
		$id = get('id');
		$model = new ArticleModel();
		$res = [];
        if($_SESSION['type'] != 'admin'){
			$res =  $model->getAllArticleByUser($_SESSION['uid']);
			$flag = false;
			foreach ($res as $key => $value) {
				if($value['article_no'] == $id){
					$flag = true;
					break;
				}
			}
			if(!$flag){
				// the article didn't create by user
				fail_jump("/blog/admin/my_articles","You cannot edit articles that are not published by you");
			}
		}
		$data = $model->getOne($id);
		$this->assign('data', $data);
		$catemodel = new CategoryModel();
		$parentCate = $catemodel->getParentCate();
		$childCate = $catemodel->listByParentId($parentCate[0]['cate_id']);

		$this->assign('parent', $parentCate);
		$this->assign('childCate', $childCate);
		$this->display('edit_article.php');
	}

	public function editAricleSubmit(){
		$data['article_no'] = post('article_no');
		$artmodel = new ArticleModel();
		$res = [];
        if($_SESSION['type'] != 'admin'){
			$res =  $artmodel->getAllArticleByUser($_SESSION['uid']);
			$flag = false;
			foreach ($res as $key => $value) {
				if($value['article_no'] == $data['article_no']){
					$flag = true;
					break;
				}
			}
			if(!$flag){
				// the article didn't create by user
				fail_jump("/blog/admin/editArticle/id/".$data['article_no'],"you can't edit this article");
				exit();
			}
		}

		$data['cate_id'] = post('cate_id');
		$data['title'] = post('title');
		$data['content'] = $_POST['content'];
		
		if($data['cate_id'] == ''  ){
			fail_jump("/blog/admin/editArticle/id/".$data['article_no'],"category can't be empty!");
			return;
		};
		if($data['title'] == ''  ){
			fail_jump("/blog/admin/editArticle/id/".$data['article_no'],"title can't be empty!");
			return;
		};
		if($data['content'] == ''  ){
			fail_jump("/blog/admin/editArticle/id/".$data['article_no'],"content can't be empty!");
			return;
		};
		$data['uid'] = $_SESSION['uid'];
		$data['last_update_time'] = date("Y-m-d H:i:s", time());
		$artmodel->setOne($data['article_no'], $data);
		succ_jump("/blog/admin/my_articles","edit article successfully!");
	}

	public function deleteArticle(){
		$id = get('id');
		$model = new ArticleModel();
		$res = [];
        if($_SESSION['type'] != 'admin'){
			$res =  $model->getAllArticleByUser($_SESSION['uid']);
			$flag = false;
			foreach ($res as $key => $value) {
				if($value['article_no'] == $id){
					$flag = true;
					break;
				}
			}
			if(!$flag){
				// the article didn't create by user
				fail_jump("/blog/admin/my_articles","you can't delete this article");
			}
		}
		$commentModel = new CommentModel();
		$commentModel->deleteCommentByArticle($id);

		$model->deleteOne($id);
		succ_jump("/blog/admin/my_articles","delete article successfully!");
	}

	public function comment_check(){
		$article_no = post("article_no");
		$comment = post("comment");
		$captcha = post("captcha");
		if($comment == null || $comment == "" || strlen(trim($comment)) == 0){
			$arr['code'] = 0;
			$arr['msg'] = "comment can't be empty!";
			echo json_encode($arr);
			return;
		}
		if(strtolower($captcha) != $_SESSION['captcha']){
			unset($_SESSION['captcha']);
			$arr['code'] = 0;
			$arr['msg'] = "captcha error!";
			echo json_encode($arr);
			return;
		}
		unset($_SESSION['captcha']);
		
		$model = new CommentModel();
		$data['content'] = $comment;
		$data['article_no'] = $article_no;
		$data['uid'] = $_SESSION['uid'];
		$data['create_time'] = date("Y-m-d H:i:s", time());
		$count = $model->addOne($data);
		$arr['count'] = $count;
		if($count >0){
			$arr['code'] = 1;
			$arr['msg'] = "comment Successfully";
			echo json_encode($arr);
			return;
		}else{
			$arr['code'] = 0;
			$arr['msg'] = "comment failed!";
			echo json_encode($arr);
			return;
		}
	}







}