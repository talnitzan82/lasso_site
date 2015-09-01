<?
class MySqlDatabase {
	
	private $connection;
	public $db_chars;
	public $mb_inter_encoding;
	public $last_query;
	private $magic_quotes_active;
	private $real_escape_string_exists;
	
	function __construct() {
		$this->open_connection();
		$this->set_db_char();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists("mysql_real_escape_string");
	}
	
	public function open_connection() {
		$this->connection = mysql_connect( DB_SERVER , DB_USER , DB_PASS );
		if (!$this->connection) {
			die("DataBase Connection Failed: ".mysql_error());	
		} else {
			$this->db_select = mysql_select_db(DB_NAME,$this->connection);
			if (!$this->db_select) {
				die("DataBase Connection Failed: ".mysql_error());
			}
		}
	
	}
	public function close_connection() {
		if (isset($this->connection)) {
			mysql_close($this->connection);
			unset($this->connection);
		}
	}
	
	public function mysql_prep($value) {
		if ($this->real_escape_string_exists) {
			if ($this->magic_quotes_active) { $value = stripslashes($value); }
			$value = mysql_real_escape_string($value);
		} else { 
			if (!$this->magic_quotes_active) { $value = addslashes($value); }
		}
		return $value;
	}
	
	public function set_db_char() {
		$this->db_chars = mysql_query("set names utf8");
		$this->mb_inter_encoding = mb_internal_encoding("UTF-8");	
	}
	
	public function query($sql) {
		$this->last_query = $sql;
		$result = mysql_query($sql,$this->connection);
		if (!$result) {
			//$output = "DataBase Connection Failed: ".mysql_error(). "<br><br>";	
			//$output.= "Last Query:". $this->last_query;
			die($output);
		}
		return $result;
	}
	public function fetch($sql) {
		$this->last_query = $sql;
		$result = mysql_query($sql,$this->connection);
		$result = mysql_fetch_array($result);
		if (!$result) {
			//$output = "DataBase Connection Failed: ".mysql_error(). "<br><br>";	
			//$output.= "Last Query:". $this->last_query;
			die($output);
		}
		return $result;
	}
	public function num_rows($sql) {
		$sql = $this->query($sql);		
		$result = mysql_num_rows($sql);
		return $result;
	}
	
	
}

$database = new MySqlDatabase();
?>