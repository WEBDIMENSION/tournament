<?php
namespace Webdimension\Tournament;

use PDO;

final class EasyFunction extends EasyFunctionCommon
{
 private $con;
 public function __construct(PDO $con)
 {
	$this->con = $con;
	parent::__construct($con);
 }

 public function disp_mess($value)
 {
//	$ret=easyfunctionco mmon();
	return $value.$ret;
 }
 public function user_get_login_key($key){
	$sql = 'SELECT * FROM ' . TABLE_NAME_USER . ' WHERE ' . CULMUN_NAME_USER_KEY . ' = :key';
	$stmt = $this->con->prepare($sql);
	$stmt->bindParam("key", $key);
	$stmt->execute();
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	return $user;
 }

 public function user_auth($key, $pass)
 {
	$user = $this->user_get_login_key($key);
	$administrator_auth_result = array(
		'auth_result' => false,
		'message' => 'Login Faild.'
	,
		CULMUN_NAME_USER_ID => '',
		CULMUN_NAME_USER_NAME => '',
		CULMUN_NAME_USER_KEY => '',
		CULMUN_NAME_USER_ROLE => '',
		CULMUN_NAME_USER_DATE_CREATED => '',
		CULMUN_NAME_USER_DATE_MODIFIY => '',
		CULMUN_NAME_USER_DATE_LASTLOGIN => ''
	);
	//  Password Auth
	$administrator_auth_result[CULMUN_NAME_USER_ID] = $user[CULMUN_NAME_USER_ID];
	if (password_verify($pass, $user[CULMUN_NAME_USER_PASSWORD])) {
	 $administrator_auth_result['auth_result'] = true;
	 $administrator_auth_result['message'] = 'Login Succcess.';
	 $administrator_auth_result[CULMUN_NAME_USER_NAME] = $user[CULMUN_NAME_USER_NAME];
	 $administrator_auth_result[CULMUN_NAME_USER_KEY] = $user[CULMUN_NAME_USER_KEY];
	 $administrator_auth_result[CULMUN_NAME_USER_ROLE] = $user[CULMUN_NAME_USER_ROLE];
	 $administrator_auth_result[CULMUN_NAME_USER_DATE_CREATED] = $user[CULMUN_NAME_USER_DATE_CREATED];
	 $administrator_auth_result[CULMUN_NAME_USER_DATE_MODIFIY] = $user[CULMUN_NAME_USER_DATE_MODIFIY];
	 $administrator_auth_result[CULMUN_NAME_USER_DATE_LASTLOGIN] = $user[CULMUN_NAME_USER_DATE_LASTLOGIN];
	}
	return $administrator_auth_result;
 }
 function remake_user_password($key){
	$new_pass = $this->get_random_password();
	$hush = $this->password_hush($new_pass);
	$sql = "update ".TABLE_NAME_USER.
		" set ".CULMUN_NAME_USER_PASSWORD."=:password where ".CULMUN_NAME_USER_KEY."=:key";
	$query = $this->con->prepare($sql);
	$query->bindParam("password", $hush);
	$query->bindParam("key", $key);
	$query->execute();
	return $new_pass;
 }

}