<?php 
namespace app\model;

use \core\lib\Model;

class UserModel extends Model{
	public $table = 'users';
	public function lists(){
		$ret = $this->select($this->table, '*');
		return $ret;
	}

	public function getOne($id){
		$res = $this->get($this->table,'*',array('uid'=>$id));
		return $res;
	}

	public function addOne($data){
		$res = $this->insert($this->table,$data);
		return $this->id();
	}

	public function setOne($id, $data){
		$re = $this->update($this->table,$data,array('uid'=>$id));
		return $re->rowCount();
	}

	public function deleteOne($id){
		$re = $this->delete($this->table,array('uid'=>$id));
		return $re->rowCount();
	}

	public function getOneByEmail($email){
		$res = $this->get($this->table,'*',array('email'=>$email));
		return $res;
	}

	public function getOneByName($name){
		$res = $this->get($this->table,'*',array('nick_name'=>$name));
		return $res;
	}

	public function getUserByUsernameAndEmail($name, $email){
		$res = $this->get($this->table,'*',array('nick_name'=>$name, 'email'=>$email));
		return $res;
	}

	public function updatePassword($data, $id){
		$re = $this->update($this->table,$data,array('uid'=>$id));
		return $re->rowCount();
	}
}



 ?>