<?php

namespace Webdimension\Administrator;

use pdo;

class Administrator
{
 /**
	* @var pdo
	*/
 private $con;

 /**
	* @var string
	*/
 private $table;

 /**
	* @var string
	*/
 private $user_culmun;

 /**
	* @var string
	*/
 private $passwd_culmun;

 /**
	* @var boolean
	*/
 private $auth_status;

 /**
	* @var string
	*/
 private $auth_message;

 /**
	* @param mysqli $con
	* @param string $table
	*/
 public function __construct($con, $table = 'administrator', $user_culmun, $passwd_culmun)
 {
	$this->con = $con;
	$this->table = $table;
	$this->user_culmun = $user_culmun;
	$this->passwd_culmun = $passwd_culmun;
	$this->auth_status = false;
	$this->auth_message = '';
 }

 public function administrator_auth($user, $plain_passwd)
 {
	$sql = "SELECT * FROM " . $this->table . " WHERE " . $this->user_culmun . " = :user";
	$stm = $this->con->prepare($sql);
	$stm->execute(array(':user' => $user));
	$administrator = $stm->fetch(PDO::FETCH_ASSOC);
	if ($administrator == '') {
	 $this->auth_message = 'Faild auth, Incorrec UserName.';
	 return false;
	}
	if (!password_verify($plain_passwd, $administrator[$this->passwd_culmun])) {
	 $this->auth_message = 'Faild auth, Incorrec Password.';
	 return false;
	}
	$this->auth_status = true;
 }
 /**
	* Close the session
	* @return bool
	*/
}
