<?
class Categories extends MySqlDatabase  {	

  
  
  function __construct() {
	  
	  	global $database;
		global $table;
		global $images;
		global $files;
		global $images_store;
		global $files_store;
		
	  	if (isset($_POST['add'])) {	
			$id = (int)$_POST['add'];
			$date = date("Y-m-d");
			$language = $_POST['lang'];
			if ($id == 0) {
				$num = $database->num_rows("SELECT * FROM $table WHERE sub = 0 ORDER BY sort DESC");
				if ($num > 0) {
					$num  = $database->fetch("SELECT * FROM $table WHERE sub = 0 ORDER BY sort DESC");
					$sort = $num['sort']+1;
				} else {
					$sort = 1;
				}
				$database->query("INSERT INTO $table (sub,sort) VALUES (0,$sort)");	
				$last = $database->fetch("SELECT * FROM $table ORDER BY id DESC LIMIT 1");	
			} else {
				$num = $database->num_rows("SELECT * FROM $table WHERE sub = $id ORDER BY sort DESC");
				if ($num > 0) {
					$num  = $database->fetch("SELECT * FROM $table WHERE sub = $id ORDER BY sort DESC");
					$sort = $num['sort']+1;
				} else {
					$sort = 1;
				}
				$database->query("INSERT INTO $table (sub,sort) VALUES ($id,$sort)");
				$last = $database->fetch("SELECT * FROM $table ORDER BY id DESC LIMIT 1");
			}
	
		}
		
		if (isset($_POST['save'])) {
			
			$total = (int)$_POST['total'];
			$i=0;
			while ($i<$total) {
				$i++;
				
				$name     = $database->mysql_prep($_POST["name$i"]);
				$sort     = $database->mysql_prep($_POST["sort$i"]);				
				$id       = $database->mysql_prep($_POST["id$i"]);
				$type     = $database->mysql_prep($_POST["type$i"]);
				
				
				if (isset($_POST["hide$i"])) {	$hide = 'yes'; } else { unset($hide); }
				if (isset($_POST["front$i"])) {   $front = 'yes'; } else { unset($front); }
				
				$page = $database->fetch("SELECT * FROM $table WHERE id = $id");				
				$database->query("UPDATE $table SET name = '$name',sort = '$sort',hide = '$hide',front = '$front',type = '$type' WHERE id = '$id'");	
			}
			
		} 
		
		if (isset($_POST['delete'])) {
			
			$total = (int)$_POST['total'];
			$i=0;
			while ($i<$total) {				
				$i++;
				if (isset($_POST["check$i"])) {
					$id       = $database->mysql_prep($_POST["id$i"]);
					$database->query("DELETE FROM $table WHERE id = $id");	
				}
			}			
		} 
		
		
  }
  
	
	

	
	
}

$categories = new Categories();
?>