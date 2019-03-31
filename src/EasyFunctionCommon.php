<?php
namespace Webdimension\Tournament;

use PDO;
class EasyFunctionCommon{
 private $pdo;
 public function __construct(PDO $con)
 {
	$this->pdo = $con;
 }
 public function func_check_extend(){
	return 'function-extend-OK!';
 }

function password_hush($password){
 $hash = password_hash($password, PASSWORD_BCRYPT);
 return $hash;
}
 function deb_mess($mess_array)
 {
	if(DEVELOP_MODE)
	{
	 echo '<div>'.$mess_array[0].' : '.$mess_array[1].'</div>';
	}
 }
 function get_random_password($length = 16)
 {
	$rdm = array_reduce(range(1, $length), function($p){ return $p.str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz')[0]; });
	return $rdm;
//	$hush = $this->password_hush($rdm);
//	return $hush;
 }

 function get_modules(){
	$sql="select * from modules";
	$query = $this->pdo->prepare($sql);
	$query->execute();
	$categories = $query->fetchAll(PDO::FETCH_ASSOC);
	return $categories;
 }

 function get_event_data($id){
	$sql="select * from event where id=:id";
	$query = $this->pdo->prepare($sql);
	$query->bindParam("id", $id);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result;
 }

 function get_module_name($id){
	$sql="select module_name from modules where id=:id";
	$query = $this->pdo->prepare($sql);
	$query->bindParam("id", $id);
	$query->execute();
	$categories = $query->fetch(PDO::FETCH_ASSOC);
	return $categories['module_name'];
 }

 function get_module_prefix($id){
	$sql="select module_prefix from modules where id=:id";
	$query = $this->pdo->prepare($sql);
	$query->bindParam("id", $id);
	$query->execute();
	$categories = $query->fetch(PDO::FETCH_ASSOC);
	return $categories['module_prefix'];
 }

 function get_module_id($name){
	$sql="select id from modules where module_name=:name";
	$query = $this->pdo->prepare($sql);
	$query->bindParam("name", $name);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result['id'];
 }
 function get_event_name($id){
	$sql="select event_name from event where id=:id";
	$query = $this->pdo->prepare($sql);
	$query->bindParam("id", $id);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result['event_name'];
 }

 function get_process($id){
	$sql="select process_data from event where id=:id";
	$query = $this->pdo->prepare($sql);
	$query->bindParam("id", $id);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result['process_data'];
 }

 function get_tournament($id){
	$sql="select tournament from event where id=:id";
	$query = $this->pdo->prepare($sql);
	$query->bindParam("id", $id);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result['tournament'];
 }
 function get_cup_name($id){
 	$sql="select cup_name from cup where id=:id";
	$query = $this->pdo->prepare($sql);
	$query->bindParam("id", $id);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result['cup_name'];
 }
}