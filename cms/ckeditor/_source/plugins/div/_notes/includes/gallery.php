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
			$id = $_POST['id'];
			$path = "uploads/";
			$target_path = "uploads/";
			
			if(is_array($_FILES["upload"])) {
				
				foreach($_FILES["upload"]["name"] as $key=>$value) {

					$target_path = $target_path . basename( $_FILES["upload"]['name'][$key]); 
					
					if(move_uploaded_file($_FILES["upload"]['tmp_name'][$key], '../'.$target_path)) {
						
						$file_msg[$i] = "The file ".  basename( $_FILES["upload"]['name'][$key]). " has been uploaded";
						$new_name = $id.'-'.str_replace(" ","_",$_FILES["upload"]['name'][$key]);
						rename("../$target_path", "../uploads/$new_name");
						$size = $_FILES["upload"]['size'][$key];
						$sql = "SELECT * FROM $table WHERE sub = '$id'";
						$sort = $database->num_rows($sql)+1;
						$sql = "INSERT INTO $table (sub,filename,image,size,hide,`sort`) values ('{$_GET['id']}','{$_FILES['upload']['name'][$key]}','uploads/".$new_name."','$size','no','$sort')";
						$database->query($sql);
						
					} else{
						$file_msg[$i] = "There was an error uploading the file, please try again!";
					}
					
					
				
				}
				
			}

		}
		
		if (isset($_POST['save'])) {
			
			$total = (int)$_POST['total'];
			$lang 	  = $database->mysql_prep($_POST["lang"]);
			$i=0;
			while ($i<$total) {
				$i++;
				
				$name     = $database->mysql_prep($_POST["name$i"]);
				$content  = $database->mysql_prep($_POST["content$i"]);
				$sort     = $database->mysql_prep($_POST["sort$i"]);
				$id       = $database->mysql_prep($_POST["id$i"]);
				
				if (isset($_POST["hide$i"])) {	$hide = 'yes'; } else { unset($hide); }
				if (isset($_POST["front$i"])) {	$front = 'yes'; } else { unset($front); }				
				
				$database->query("UPDATE $table SET name = '$name',content1 = '$content',sort = '$sort',hide = '$hide',front = '$front' WHERE id = '$id'");	
			}	
			
			$id          = $database->mysql_prep($_POST['id']);
			$title1      = $database->mysql_prep($_POST['title1']);
		    $title2      = $database->mysql_prep($_POST['title2']);
		    $content1    = $database->mysql_prep($_POST['con1']);
		    $content2    = $database->mysql_prep($_POST['con2']);
			$mod_rewrite = str_replace(" ","_",$database->mysql_prep(trim($_POST['mod_rewrite'])));
			$meta_title  = $database->mysql_prep($_POST['meta_title']);
			$meta_key    = $database->mysql_prep($_POST['meta_key']);
			$meta_desc   = $database->mysql_prep($_POST['meta_desc']);	
			$hide        = (isset($_POST['hide'])) ? 'yes' : 'no';
			$hide_menu   = (isset($_POST['hide_menu'])) ? 'yes' : 'no';
			$front       = (isset($_POST['front'])) ? 'yes' : 'no';  
			$date     = ($_POST['date']=='') ? date('Y-m-d') : date('Y-m-d',strtotime($_POST['date']));
			$sub      = $database->mysql_prep($_POST['category']);
			
			$database->query("UPDATE pages SET sub='$sub',title1 = '$title1',content1 = '$content1',title2 = '$title2',content2 = '$content2',mod_rewrite = '$mod_rewrite',meta_title = '$meta_title',meta_key = '$meta_key', meta_desc = '$meta_desc',`hide` = '$hide', `front` = '$front', `hide_menu` = '$hide_menu',`date` = '$date' WHERE id = '$id'");	
			
			
			if ($images_store=='rows') {
				  $i=1;
				 
				  while ($i<=$images) {
						
						$path = "uploads/";
						$target_path = "uploads/";
	
						$target_path = $target_path . basename( $_FILES["image$i"]['name']); 
						
						if(move_uploaded_file($_FILES["image$i"]['tmp_name'], '../'.$target_path)) {
							$image_msg[$i] = "The file ".  basename( $_FILES["image$i"]['name']). " has been uploaded";
							$new_name = $id.'-'.str_replace(" ","_",$_FILES["image$i"]['name']);
							rename("../$target_path", "../uploads/$new_name");
							$database->query("UPDATE pages SET image$i = '".$path.$new_name."' WHERE id = '$id'");
							
						} else{
							$image_msg[$i] = "There was an error uploading the file, please try again!";
						}
	
					$i++;  
				  }
			  } else {
				 $item = $database->fetch("SELECT * FROM pages WHERE id = '$id'");
				 if ($item['image1']!='') {
				 	$images_array = explode(",",$item['image1']);
				 }
				 $images_names_array = explode(",",$item['image1_names']);
				 $images_total = $_POST['total_images_store'];
				 $i=0;
				
				 while ($i<=$images_total) {
						
						$image_name = $database->mysql_prep($_POST["image_name$i"]);
						
						$path = "uploads/";
						$target_path = "uploads/";
	
						$target_path = $target_path . basename( $_FILES["image$i"]['name']); 
						
						if(move_uploaded_file($_FILES["image$i"]['tmp_name'], '../'.$target_path)) {
							$image_msg[$i] = "The file ".  basename( $_FILES["image$i"]['name']). " has been uploaded";
							$new_name = $id.'-'.date('dmyhs').str_replace(" ","_",strtolower($_FILES["image$i"]['name']));
							rename("../$target_path", "../$path$new_name");
							// Filename
							$images_array[$i] = $path.$new_name;												
							
						} else{
							$image_msg[$i] = "There was an error uploading the file, please try again!";
						}
						// File Title
						$images_names_array[$i] = $image_name;
	
					$i++;  
				  }	
				 
				  $database->query("UPDATE pages SET image1 = '".implode(",",$images_array)."',image1_names = '".implode(",",$images_names_array)."' WHERE id = '$id'");
				  		  
			  }
			  
			  
			  if ($files_store=='rows') {
				  $i=1;
				  while ($i<=$files) {
						
						$path = "uploads/";
						$target_path = "uploads/";
	
						$target_path = $target_path . basename( $_FILES["file$i"]['name']); 
						
						if(move_uploaded_file($_FILES["file$i"]['tmp_name'], '../'.$target_path)) {
							$file_msg[$i] = "The file ".  basename( $_FILES["file$i"]['name']). " has been uploaded";
							$new_name = $id.'-'.str_replace(" ","_",$_FILES["file$i"]['name']);
							rename("../$target_path", "../uploads/$new_name");
							$database->query("UPDATE pages SET file$i = '".$path.$new_name."' WHERE id = '$id'");
							
						} else{
							$file_msg[$i] = "There was an error uploading the file, please try again!";
						}
	
					$i++;  
				  }
			  } else {
				 $item = $database->fetch("SELECT * FROM pages WHERE id = '$id'");
				 $files_array = explode(",",$item['file1']);
				 $files_names_array = explode(",",$item['file1_names']);
				 $files_total = $_POST['total_files_store'];
				 $i=0;
				 while ($i<=$files_total) {
						$file_name = $database->mysql_prep($_POST["file_name$i"]);
						
						$path = "uploads/";
						$target_path = "uploads/";
	
						$target_path = $target_path . basename( $_FILES["file$i"]['name']); 
						
						if(move_uploaded_file($_FILES["file$i"]['tmp_name'], '../'.$target_path)) {
							$file_msg[$i] = "The file ".  basename( $_FILES["file$i"]['name']). " has been uploaded";
							$new_name = $id.'-'.date('dmyhs').str_replace(" ","_",strtolower($_FILES["file$i"]['name']));
							rename("../$target_path", "../$path$new_name");
							// Filename
							$files_array[$i] = $path.$new_name;															
							
						} else{
							$file_msg[$i] = "There was an error uploading the file, please try again!";
						}						
						// File Title		
						$files_names_array[$i] = $file_name;
	
					$i++;  
				  }				  
				  $database->query("UPDATE pages SET file1 = '".implode(",",$files_array)."',file1_names = '".implode(",",$files_names_array)."' WHERE id = '$id'");
				  		  
			  }
				
			
		} 
		
		if (isset($_POST['delete'])) {
			$getid = $database->mysql_prep($_GET['id']);
			$total = (int)$_POST['total'];
			$i=0;
			while ($i<$total) {				
				$i++;
				if (isset($_POST["check$i"])) {
					## delete image from server ##
					$get_file = mysql_fetch_assoc($database->query("SELECT * FROM $table WHERE id = $getid"));
					if ($get_file['image']!='') {
						$fh = fopen('../'.$get_file['image'], 'w');
						fclose($fh);					
						$myFile = $get_file['image'];
						unlink('../'.$myFile);
					}
					## delete image from server ##
									
					$id       = $database->mysql_prep($_POST["id$i"]);
					$database->query("DELETE FROM $table WHERE id = $id");	
				}
			}			
			
		} 
		
		if (isset($_POST['updateclose'])) {	$_POST['update'] = 'UPDATE IS SET'; }
		
  }
		
	
}

$page = new Page();
?>