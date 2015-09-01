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
			$old_table = $table;
			$table = 'biz';	
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
				$database->query("INSERT INTO $table (sub,sort,`date`) VALUES (0,$sort,'$date')");	
			} else {
				$num = $database->num_rows("SELECT * FROM $table WHERE sub = $id ORDER BY sort DESC");
				if ($num > 0) {
					$num  = $database->fetch("SELECT * FROM $table WHERE sub = $id ORDER BY sort DESC");
					$sort = $num['sort']+1;
				} else {
					$sort = 1;
				}
				$database->query("INSERT INTO $table (sub,sort,`date`) VALUES ($id,$sort,'$date')");
			}	
			$table = $old_table;	
		}
		
		if (isset($_POST['save'])) {
			
			$old_table = $table;
			$table = 'biz';	
			
			$total = (int)$_POST['total'];
			$lang 	  = $database->mysql_prep($_POST["lang"]);
			$i=0;
			while ($i<$total) {
				$i++;
				
				$name     = $database->mysql_prep($_POST["name$i"]);
				$id       = $database->mysql_prep($_POST["id$i"]);				
				
				if (isset($_POST["hide$i"])) {	$hide = 'yes'; } else { unset($hide); }
				if (isset($_POST["front$i"])) {   $front = 'yes'; } else { unset($front); }
				if (isset($_POST["advertise$i"])) {   $advertise = 'yes'; } else { unset($advertise); }

				$database->query("UPDATE $table SET name = '$name',hide = '$hide',front = '$front',advertise = '$advertise' WHERE id = '$id'");	
			}
			$table = $old_table;			
			
		} 
		
		if (isset($_POST['saveimages'])) {
			
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
				
				$database->query("UPDATE gallery SET name = '$name',content1 = '$content',sort = '$sort',hide = '$hide',front = '$front' WHERE id = '$id'");	
			}
						
			
			$id = (int)$_GET['id'];
			$name = $database->mysql_prep($_POST['name']);
			$email = $database->mysql_prep($_POST['email']);
			$phone = $database->mysql_prep($_POST['phone']);
			$content1 = $database->mysql_prep($_POST['con1']);
			$web = $database->mysql_prep($_POST['web']);
			$address = $database->mysql_prep($_POST['address']);
			$hide  = (isset($_POST['hide'])) ? 'yes' : 'no';
			$advertise  = (isset($_POST['advertise'])) ? 'yes' : 'no';
			$date     = ($_POST['date']=='') ? date('Y-m-d') : date('Y-m-d',strtotime($_POST['date']));
			$front    = (isset($_POST['front'])) ? 'yes' : 'no';  
			$repeat    = (isset($_POST['repeat'])) ? 'yes' : 'no';  
			$categories = implode(",",$_POST['categories']);
			$categories = $database->mysql_prep($categories);			  
			
			
			
			$database->query("UPDATE biz SET 
			name = '$name',
			address = '$address',
			web = '$web',
			phone = '$phone',
			content1 = '$content1',
			email = '$email',
			advertise = '$advertise',
			`hide` = '$hide',
			`date` = '$date',
			front = '$front',
			repeat = '$repeat',
			category = '$categories'
			WHERE id = '$id'
			");
			
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
							$database->query("UPDATE biz SET image$i = '".$path.$new_name."' WHERE id = '$id'");
							
						} else{
							$image_msg[$i] = "There was an error uploading the file, please try again!";
						}
	
					$i++;  
				  }
			  } else {
				 $item = $database->fetch("SELECT * FROM biz WHERE id = '$id'");
				 $images_array = explode(",",$item['image1']);
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
				  foreach($images_array as $keyer=>$valuer) {
					  
					  if ($valuer=='') {
						  unset($images_names_array[$keyer],$images_array[$keyer]);
					  }
						  
				  }
				  $database->query("UPDATE biz SET image1 = '".implode(",",$images_array)."',image1_names = '".implode(",",$images_names_array)."' WHERE id = '$id'");
				  		  
			  }
					  
			
		} 
		
		
		
	  	if (isset($_POST['addimages'])) {	
			$id = $_POST['id'];
			$path = "gallery/";
			$target_path = "gallery/";
			
			if(is_array($_FILES["upload"])) {
				
				foreach($_FILES["upload"]["name"] as $key=>$value) {

					$target_path = $target_path . basename( $_FILES["upload"]['name'][$key]); 
					
					if(move_uploaded_file($_FILES["upload"]['tmp_name'][$key], '../'.$target_path)) {
						
						$file_msg[$i] = "The file ".  basename( $_FILES["upload"]['name'][$key]). " has been uploaded";
						$new_name = $id.'-'.str_replace(" ","_",$_FILES["upload"]['name'][$key]);
						rename("../$target_path", "../gallery/$new_name");
						$size = $_FILES["upload"]['size'][$key];
						$sql = "SELECT * FROM $table WHERE sub = '$id'";
						$sort = $database->num_rows($sql)+1;
						$sql = "INSERT INTO $table (sub,filename,image,size,hide,`sort`) values ('{$_GET['id']}','{$_FILES['upload']['name'][$key]}','gallery/".$new_name."','$size','no','$sort')";
						$database->query($sql);
						
					} else{
						$file_msg[$i] = "There was an error uploading the file, please try again!";
					}
					
					
				
				}
				
			}

		}
		
		
		if (isset($_POST['delete'])) {
			
			$total = (int)$_POST['total'];
			$i=0;
			while ($i<$total) {				
				$i++;
				if (isset($_POST["check$i"])) {
					$id       = $database->mysql_prep($_POST["id$i"]);
					$database->query("DELETE FROM biz WHERE id = $id");	
				}
			}			
			
		} 
		
		if (isset($_POST['deleteimages'])) {
			
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
	
	public function DeletePost($action,$id,$num) 
	{
		global $database;
		$table = 'biz';
		
		switch($action){
			case '1':
				// IMAGE 1
				$sql = "UPDATE $table SET image$num = '' WHERE id = $id";
				$database->query($sql);
				$msg = "Image $num as been deleted successfully";
				break;
			case '2':
				// IMAGE 2
				$sql   = "SELECT image1,image1_names FROM $table WHERE id = $id";
				$fetch = $database->fetch($sql);
				$ex    = explode(",",$fetch['image1']);
				$ex_names = explode(",",$fetch['image1_names']);
				unset($ex[$num]);
				unset($ex_names[$num]);
				$ex = implode(",",$ex);
				$ex_names = implode(",",$ex_names);
				$sql = "UPDATE $table SET image1 = '$ex',image1_names = '$ex_names'  WHERE id = $id";
				$database->query($sql);
				$msg = "Image $num as been deleted successfully";	
				break;
			case '3':
				// FILE 1
				$sql = "UPDATE $table SET file$num = '' WHERE id = $id";
				$database->query($sql);
				$msg = "File $num as been deleted successfully";
				break;
			case '4':
				// FILE 2
				$sql   = "SELECT file1,file1_names FROM $table WHERE id = $id";
				$fetch = $database->fetch($sql);
				$ex    = explode(",",$fetch['file1']);
				$ex_names = explode(",",$fetch['file1_names']);
				unset($ex[$num]);
				unset($ex_names[$num]);
				$ex = implode(",",$ex);
				$ex_names = implode(",",$ex_names);
				$sql = "UPDATE $table SET file1 = '$ex',file1_names = '$ex_names' WHERE id = $id";				
				$database->query($sql);
				$msg = "File $num as been deleted successfully";				
				break;
		}
	
		echo $msg;
	
	}
		
	
}

$page = new Page();
?>