<?
class Page extends MySqlDatabase  {	

  function __construct() {
	  
	  	global $database;
		global $table;
		global $images;
		global $files;
		global $images_store;
		global $files_store;
		
	  	if (isset($_POST['add'])) {	
			$database->query("INSERT INTO $table (`id`) VALUES (NULL)");		
		}
		
		if (isset($_POST['save'])) {
			
			$total = (int)$_POST['total'];
			$i=0;
			while ($i<$total) {
				$i++;				
				$name  		   = $database->mysql_prep($_POST["name$i"]);
				$template       = $database->mysql_prep($_POST["template$i"]);
				$sort           = $database->mysql_prep($_POST["sort$i"]);
				$id      		 = $database->mysql_prep($_POST["id$i"]);
				
				if (isset($_POST["hide$i"])) {	$hide = 'yes'; } else { unset($hide); }				
				
				$database->query("UPDATE $table SET name = '$name',template = '$template',sort = '$sort',hide = '$hide' WHERE id = '$id'");	
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

$page = new Page();
?>