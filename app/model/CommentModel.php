<?php 
namespace app\model;

use \core\lib\Model;

class CommentModel extends Model{
	public $table = 'article_comments';
	public function lists(){
		$ret = $this->select($this->table, '*');
		return $ret;
	}

	public function getOne($id){
		$res = $this->get($this->table,'*',array('comment_no'=>$id));
		return $res;
	}

	public function setOne($id, $data){
		$re = $this->update($this->table,$data,array('comment_no'=>$id));
		return $re->rowCount();
	}
	
	public function addOne($data){
		$res = $this->insert($this->table,$data);
		return $this->id();
	}

	public function deleteOne($id){
		$re = $this->delete($this->table,array('comment_no'=>$id));
		return $re->rowCount();
	}

	public function getByArticleNo($id){
		$ret = $this->select($this->table, '*', array('article_no'=>$id));
		return $ret;
	}

	public function getCommentByArticle($id){
		$res = $this->query("SELECT content, create_time FROM article_comments WHERE article_no='".$id."' ORDER BY create_time DESC")->fetchAll();
		return $res;
	}

	public function getAllComment(){
		$sql = "SELECT ac.comment_no, a.title, ac.content, ac.create_time ";
		$sql .= " FROM article_comments ac JOIN articles a ON ac.article_no = a.article_no ORDER BY ac.create_time DESC";
		$res = $this->query($sql)->fetchAll();
		return $res;
	}

	public function getAllCommentByUser($id){
		$sql = "SELECT ac.comment_no, a.title, ac.content, ac.create_time, ac.verify ";
		$sql .= " FROM article_comments ac JOIN articles a ON ac.article_no = a.article_no ";
		$sql .= " WHERE ac.article_no IN (SELECT article_no FROM articles WHERE uid = '".$id."') ORDER BY ac.create_time DESC ";
		$res = $this->query($sql)->fetchAll();
		return $res;
	}

	public function getCommentByUser($uid){
		$ret = $this->select($this->table, '*', array('uid'=>$uid));
		return $ret;
	}

	public function deleteCommentByArticle($id){
		$re = $this->delete($this->table,array('article_no'=>$id));
		return $re->rowCount();
	}

}



 ?>