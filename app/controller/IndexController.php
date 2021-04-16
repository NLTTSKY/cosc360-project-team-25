<?php 
namespace app\controller;
use \app\model\ArticleModel;
use \app\model\UserModel;
use \app\model\CommentModel;

use \core\lib\Log;

class IndexController extends \core\Starter
{
	public function __construct(){
		if(session_status() == 1){
            session_start();    
        }
	}

	public function index()
	{
		//var_dump("index");
		$articleModel = new ArticleModel();
		$articles = $articleModel->getVerifyArticle();
		$this->assign('articles', $articles);
		$this->display('index.php');
	}

	public function article(){
		$id = get('id');
		$articleModel = new ArticleModel();
		$article = $articleModel->getVerifyArticleById($id);
		if($article){
			$articleModel->addClick($id);
		}
		$commentModel = new CommentModel();
		$comments = $commentModel->getCommentByArticle($id);
		if(empty($article)){
			fail_jump("/blog/index/index", "there is no article with id ".$id.", or this article wait to comfirm");
			return;
		}
		//var_dump($article);
		//var_dump($comments);
		$this->assign('article', $article[0]);
		$this->assign('comments', $comments);
		$this->display('article.php');
	}

	public function get_article_comments(){
		$article_no = get('article_no');
		$commentModel = new CommentModel();
		$comments = $commentModel->getCommentByArticle($article_no);
		$arr['code'] = 1;
		$arr['data'] = $comments;
		echo json_encode($arr);
	}

	public function category(){
		$cate_id = get('id');
		//var_dump($cate_id);
		$articleModel = new ArticleModel();
		$articles = $articleModel->getVerifyArticleByCate($cate_id);
		$this->assign('articles', $articles);
		$this->assign('cate_id', $cate_id);
		$this->display('index.php');
	}

	public function search(){
		$keyword = post("keyword");
		if($keyword == null || trim($keyword) == ""){
			$this->index();
			return;
		}
		$this->assign('keyword', $keyword);
		$articleModel = new ArticleModel();
		$articles = $articleModel->search($keyword);
		$this->assign('articles', $articles);
		$this->assign('keyword', $keyword);
		$this->display('index.php');
	}

	public function login(){
		$this->display('login.php');
	}

	public function register(){
		$this->display('register.php');
	}

	public function forget(){
		$this->display('forget.php');
	}

	public function forget_check(){
		$username = post('username');
		$email = post('email');

		$model = new UserModel();
		$res = $model->getUserByUsernameAndEmail($username, $email);
		if( empty($res) ){
			$arr['code'] = -1;
			$arr['msg'] = 'your email or username incorrect';
			Log::log("Type:Reset Password \t username[".$username."] \t Content:reset password failed");
		}else{
			$data['password'] = password_hash('123456', PASSWORD_DEFAULT);
			$model->updatePassword($data, $res['uid']);
			$arr['code'] = 1;
			$arr['msg'] = $res['nick_name'].' ,your new password(123456) has been send to '.$res['email'];
			Log::log("Type:Reset Password \t username[".$username."] \t Content:reset password Successfully");
		}
		echo json_encode($arr);
	}

	public function login_check(){
		$username = post("username");
		$password = post("password");

		if($username == ''){
			fail_jump("/blog/index/login", "invalid name");
			return;
		}
		$model = new UserModel();
		$res = $model->getOneByName($username);
		if($res['disabled'] == 1){
			fail_jump("/blog/index/login", "the account is disabled now, please contact administrator");
			return;
		}
		if($res && password_verify($password,$res['password']) ){
			$_SESSION['uid'] = $res['uid'];
			$_SESSION['nickname'] = $res['nick_name'];
			$_SESSION['type'] = $res['type'];
			Log::log("Type:Login \t username[".$username."] \t Content:Login Successfully");
			succ_jump("/blog/admin/index", "Login Successfully");
			return;
		}else{
			Log::log("Type:Login \t username[".$username."] \t Content:Login failed");
			fail_jump("/blog/index/login", "password error");
			return;
		}
	}

	public function register_check(){
		$data['nick_name'] = post('nickname');
		$data['email'] = post('email');
		$data['password'] = post('password');
		$data['captcha'] = post('captcha');

		//var_dump($_POST);
		//var_dump($_FILES);
		//die();
		$captcha = $_SESSION['captcha'];
		$arr = array();
		if(strtolower($data['captcha']) === $captcha){
			$model = new UserModel();
			$res = $model->getOneByEmail($data['email']);
			if(!checkEmail($data['email']) || isset($res['uid'])){
				fail_jump("/blog/index/register", "invalid email or the email have been registered");
				return;
			}
			if($data['nick_name'] == ""){
				fail_jump("/blog/index/register", "name can't be empty!");
				return;
			}
			if($data['password'] == ""){
				fail_jump("/blog/index/register", "password can't be empty!");
				return;
			}
			if(isset($_FILES['pic']) && isset($_FILES['pic']['name']) && $_FILES['pic']['name'] !=''){
				$img['image_name'] = $_FILES['pic']['name'];
				$img['image_path'] = date("s", time()).$_FILES["pic"]["name"];
				if( $_FILES["pic"]["tmp_name"] == null || $_FILES["pic"]["tmp_name"] =="" ||
					!file_is_an_image($_FILES["pic"]["tmp_name"], $img['image_path']) ){
					fail_jump("/blog/index/register","only upload image!");
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
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
			$data['type'] = 'login';
			$data['create_time'] = date("Y-m-d H:i:s", time());
			$data['last_update_time'] = date("Y-m-d H:i:s", time());
			$res1 = $model->addOne($data);
			if($res1 < 1){
				Log::log("Type:Register \t username[".$data['nick_name']."] \t Content:Register Failed");
				fail_jump("/blog/index/register", "register error!");
				return;
			}
			Log::log("Type:Register \t username[".$data['nick_name']."] \t Content:Register Successfully");
			succ_jump("/blog/index/login", "register Successfully!");
			return;
		}else{
			fail_jump("/blog/index/register", "captcha error");
			return;
		}
	}

	public function logout()
	{
		unset($_SESSION['uid']);
		unset($_SESSION['nickname']);
		unset($_SESSION['type']);
		succ_jump("/blog/index/index", "Logout Successfully!");
	}

	public function check_name(){
		$nickname = post('nickname');
		$model = new UserModel();
		$res = $model->getOneByName($nickname);
		if(!empty($res)){
			$arr['code'] = 0;
		}else{
			$arr['code'] = 1;
		}
		echo json_encode($arr);
	}

	public function email_check(){
		$email = post('email');
		$model = new UserModel();
		$res = $model->getOneByEmail($email);
		
		if(!checkEmail($email) ){
			$arr['code'] = -1;
		}else if(!empty($res)){
			$arr['code'] = 0;
		}else{
			$arr['code'] = 1;
		}
		echo json_encode($arr);
	}

	public function captcha(){
		//Output image header information to browser
		header('Content-type:image/jpeg');
		$width=100;
		$height=30;
		$string='';//Define variable to save font
		$img=imagecreatetruecolor($width, $height);
		$arr=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','p','q','r','s','t','u','v','w','x','y','z','1','2','3','4','5','6','7','8','9');
		//Generate colored pixels  
		$colorBg=imagecolorallocate($img,rand(200,255),rand(200,255),rand(200,255));
		//Fill color
		imagefill($img, 0, 0, $colorBg);
		//The loop, loop draw background interference points
		for($m=0;$m<=100;$m++){
		    $pointcolor=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
		    imagesetpixel($img,rand(0,$width-1),rand(0,$height-1),$pointcolor);
		}
		//Draw interference lines in a loop
		/*for ($i=0;$i<=4;$i++){
		    $linecolor=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
		    imageline($img,rand(0,$width),rand(0,$height),rand(0,$width),rand(0,$height),$linecolor);
		}*/
		for($i=0;$i<4;$i++){
			$string.=$arr[rand(0,count($arr)-1)];
		}
		$_SESSION['captcha'] = $string;
		$colorString=imagecolorallocate($img,rand(10,100),rand(10,100),rand(10,100));
		imagestring($img,5,rand(0,$width-36),rand(0,$height-15),$string,$colorString);
		//Output picture to browser
		imagejpeg($img);
		//Destroy, release resources
		imagedestroy($img);
	}
	
}




 ?>