<?
if ($_SESSION['LOGGED']!=TRUE) {
	header('location: index.php');	
}

/*
function session_defaults() {
	$_SESSION['logged'] = false;
	$_SESSION['uid'] = 0;
	$_SESSION['username'] = '';
	$_SESSION['cookie'] = 0;
	$_SESSION['remember'] = false;
}
if (!isset($_SESSION['uid']) ) {
	session_defaults();
}


class User {
	var $db = null;
	var $failed = false; // failed login attempt
	var $date; // current date GMT
	var $id = 0; // the current user's id
	function User($db) {		
		$this->db = $db;		
		$this->date = $GLOBALS['date'];
		if ($_SESSION['logged']) {
			$this->_checkSession();
		} elseif ( isset($_COOKIE['mtwebLogin']) ) {
			$this->_checkRemembered($_COOKIE['mtwebLogin']);
		}
	} 
	function _checkLogin($username, $password, $remember) {

		$username = $this->db->mysql_prep($username);
		$password = $this->db->mysql_prep(md5($password));
		$sql = "SELECT * FROM member WHERE `username` = '$username' AND `password` = '$password'";
		$result = $this->db->query($sql);
		$result = mysql_fetch_assoc($result);	
			
		if ( is_object($result) ) {	
			
			$this->_setSession($result, $remember);
			return true;
		} else {
		echo '234';	
			$this->failed = true;
			//$this->_logout();
			return false;
		}
	} 
	
	function _setSession(&$values, $remember, $init = true) {
		$this->id = $values->id;
		$_SESSION['uid'] = $this->id;
		$_SESSION['username'] = htmlspecialchars($values->username);
		$_SESSION['cookie'] = $values->cookie;
		$_SESSION['logged'] = true;
		var_dump($_SESSION);
		if ($remember) {
			$this->updateCookie($values->cookie, true);
		}
		if ($init) {
			$session = $this->db->mysql_prep(session_id());
			$ip = $this->db->mysql_prep($_SERVER['REMOTE_ADDR']);
			
			$sql = "UPDATE member SET session = $session, ip = $ip WHERE " .
			"id = $this->id";
			$this->db->query($sql);
		}
	} 
	
	function updateCookie($cookie, $save) {
		$_SESSION['cookie'] = $cookie;
		if ($save) {
			$cookie = serialize(array($_SESSION['username'], $cookie) );
			setcookie('mtwebLogin', $cookie, time() + 31104000, '/directory/');
		}
	}

	
	function _checkRemembered($cookie) {
		list($username, $cookie) = @unserialize($cookie);
		if (!$username or !$cookie) return;
		$username = $this->db->mysql_prep($username);
		$cookie = $this->db->mysql_prep($cookie);
		$sql = "SELECT * FROM member WHERE " .
		"(username = '$username') AND (cookie = '$cookie')";
		$result = $this->db->getRow($sql);
		if (is_object($result) ) {
			$this->_setSession($result, true);
		}
	} 
	function _checkSession() {
		
		$username = $this->db->mysql_prep($_SESSION['username']);		
		$cookie = $this->db->mysql_prep($_SESSION['cookie']);
		$session = $this->db->mysql_prep(session_id());
		$ip = $this->db->mysql_prep($_SERVER['REMOTE_ADDR']);
		$sql = "SELECT * FROM member WHERE " .
		"(username = '$username') AND (cookie = '$cookie') AND " .
		"(session = '$session') AND (ip = $ip)";
		$result = $this->db->getRow($sql);
		if (is_object($result) ) {
			$this->_setSession($result, false, false);
		} else {
			$this->_logout();
		}
	}
}




$user = new User($database);
$user->User($database);
if ($_POST) {
	
	$user->_checkLogin($_POST['username'],md5($_POST['password']),true);
	
}
var_dump($_SESSION);
*/
?>