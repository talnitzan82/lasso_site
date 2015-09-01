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
			$database->query("INSERT INTO $table (`default`) VALUES (1)");		
		}
		
		if (isset($_POST['save'])) {
			
			$total = (int)$_POST['total'];
			$i=0;
			while ($i<$total) {
				$i++;				
				$language_text  = $database->mysql_prep($_POST["language_text$i"]);
				$language       = $database->mysql_prep($_POST["language$i"]);
				$id      		 = $database->mysql_prep($_POST["id$i"]);
				
				if (isset($_POST["hide$i"])) {	$hide = 'yes'; } else { unset($hide); }				
				
				$database->query("UPDATE $table SET language_text = '$language_text',language = '$language',hide = '$hide' WHERE id = '$id'");	
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