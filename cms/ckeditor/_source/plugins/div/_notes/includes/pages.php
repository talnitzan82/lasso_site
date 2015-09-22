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
				$database->query("INSERT INTO $table (sub,sort,`date`,language) VALUES (0,$sort,'$date','$language')");	
				$last = $database->fetch("SELECT * FROM $table ORDER BY id DESC LIMIT 1");
				$template = 'page.php?id='.$last['id'];
				$database->query("UPDATE $table SET template = '$template' WHERE id = '{$last['id']}'");	
			} else {
				$num = $database->num_rows("SELECT * FROM $table WHERE sub = $id ORDER BY sort DESC");
				if ($num > 0) {
					$num  = $database->fetch("SELECT * FROM $table WHERE sub = $id ORDER BY sort DESC");
					$sort = $num['sort']+1;
				} else {
					$sort = 1;
				}
				$database->query("INSERT INTO $table (sub,sort,`date`,language) VALUES ($id,$sort,'$date','$language')");
				$last = $database->fetch("SELECT * FROM $table ORDER BY id DESC LIMIT 1");
				$template = 'page.php?id='.$last['id'];
				$database->query("UPDATE $table SET template = '$template' WHERE id = '{$last['id']}'");		
			}
			$this->CreateSitemap($database);		
		}
		
		if (isset($_POST['save'])) {
			
			$total = (int)$_POST['total'];
			$lang 	  = $database->mysql_prep($_POST["lang"]);
			$i=0;
			while ($i<$total) {
				$i++;
				
				$name     = $database->mysql_prep($_POST["name$i"]);
				$sort     = $database->mysql_prep($_POST["sort$i"]);
				$template = $database->mysql_prep($_POST["template$i"]);				
				$id       = $database->mysql_prep($_POST["id$i"]);
				
				
				if (isset($_POST["hide$i"])) {	$hide = 'yes'; } else { unset($hide); }
				if (isset($_POST["front$i"])) {   $front = 'yes'; } else { unset($front); }
				if ($template=='footer') {  $hide = 'yes';	}
				
				$page = $database->fetch("SELECT * FROM $table WHERE id = $id");
				$page['mod_rewrite'] = $database->mysql_prep($page['mod_rewrite']);
				if ($page['mod_rewrite']=='' && $name!='') {
					$mod_rewrite = str_replace(" ","_",trim($name));	
				} else {
					$mod_rewrite = trim($page['mod_rewrite']);
				}
				
				$database->query("UPDATE $table SET language = '$lang',name = '$name',mod_rewrite = '$mod_rewrite',sort = '$sort',template = '$template',hide = '$hide',front = '$front' WHERE id = '$id'");	
			}
			$this->CreateSitemap($database);
			
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
			$this->CreateSitemap($database);
		} 
		
		if (isset($_POST['updateclose'])) {	$_POST['update'] = 'UPDATE IS SET'; }
		
		if (isset($_POST['update'])) {
			
			  $id = (int)$_GET['id'];
			  $name = $database->mysql_prep($_POST['name']);
			  $title1 = $database->mysql_prep($_POST['title1']);;
			  $title2 = $database->mysql_prep($_POST['title2']);
			  $title3 = $database->mysql_prep($_POST['title3']);
			  $short_content = $database->mysql_prep($_POST['short_content']);
			  $content1 = $database->mysql_prep($_POST['content1']);
			  $content2 = $database->mysql_prep($_POST['content2']);
			  $content3 = $database->mysql_prep($_POST['content3']);
			  $mod_rewrite = str_replace(" ","_",$database->mysql_prep(trim($_POST['mod_rewrite'])));
			  $meta_title  = $database->mysql_prep($_POST['meta_title']);
			  $meta_title_perm = $database->mysql_prep($_POST['meta_title_perm']);
			  $meta_desc = $database->mysql_prep($_POST['meta_desc']);
			  $meta_key  = $database->mysql_prep($_POST['meta_key']);
			  $seo_alt   = $database->mysql_prep($_POST['seo_alt']);
			  $seo_title = $database->mysql_prep($_POST['seo_title']);  
			  $template  = $database->mysql_prep($_POST['template']);
			  $hide  = (isset($_POST['hide'])) ? 'yes' : 'no';
			  $hide_menu  = (isset($_POST['hide_menu'])) ? 'yes' : 'no';
			  $alink1 = $database->mysql_prep($_POST['alink1']);
			  $alink2 = $database->mysql_prep($_POST['alink2']);
			  $alink3 = $database->mysql_prep($_POST['alink3']);
			  $language = $database->mysql_prep($_POST['lang']); 
			  $video    = $database->mysql_prep($_POST['video']);
			  $date     = ($_POST['date']=='') ? date('Y-m-d') : date('Y-m-d',strtotime($_POST['date']));
			  $writer   = $database->mysql_prep($_POST['writer']);
			  $front    = (isset($_POST['front'])) ? 'yes' : 'no';  
			  $tag      = $database->mysql_prep($_POST['tag']); 
			  $categories = implode(",",$_POST['categories']);
			  $categories = $database->mysql_prep($categories);
			  $sub      = $database->mysql_prep($_POST['category']);
			 
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
							$database->query("UPDATE $table SET image$i = '".$path.$new_name."' WHERE id = '$id'");
							
						} else{
							$image_msg[$i] = "There was an error uploading the file, please try again!";
						}
	
					$i++;  
				  }
			  } else {
				 $item = $database->fetch("SELECT * FROM pages WHERE id = '$id'");
				 if ($item['image1']!='') {
				 	$images_array = explode(",",$item['image1']);
				 	$images_names_array = explode(",",$item['image1_names']);
				 }
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
				  $database->query("UPDATE $table SET image1 = '".implode(",",$images_array)."',image1_names = '".implode(",",$images_names_array)."' WHERE id = '$id'");
				  		  
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
							$database->query("UPDATE $table SET file$i = '".$path.$new_name."' WHERE id = '$id'");
							
						} else{
							$file_msg[$i] = "There was an error uploading the file, please try again!";
						}
	
					$i++;  
				  }
			  } else {
				 $item = $database->fetch("SELECT * FROM pages WHERE id = '$id'");
				 if ($item['image1']!='') {
				 	$files_array = explode(",",$item['file1']);
				 	$files_names_array = explode(",",$item['file1_names']);
				 }
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
				  $database->query("UPDATE $table SET file1 = '".implode(",",$files_array)."',file1_names = '".implode(",",$files_names_array)."' WHERE id = '$id'");
				  		  
			  }
			  
			  
			  $database->query("UPDATE $table SET 
			  name = '$name',
			  sub = '$sub',
			  title1 = '$title1',
			  title2 = '$title2',
			  title3 = '$title3',
			  short_content = '$short_content',
			  content1 = '$content1',
			  content2 = '$content2',
			  content3 = '$content3',
			  mod_rewrite = '$mod_rewrite',
			  meta_title = '$meta_title',
			  meta_title_perm = '$meta_title_perm',
			  meta_desc = '$meta_desc',
			  meta_key = '$meta_key',
			  seo_alt = '$seo_alt',
			  seo_title = '$seo_title',
			  template = '$template',
			  `hide` = '$hide',
			  `hide_menu` = '$hide_menu',
			  alink1 = '$alink1',
			  alink2 = '$alink2',
			  language = '$language',
			  video = '$video',
			  `date` = '$date',
			  writer = '$writer',
			  front = '$front',
			  categories = '$categories'
			  WHERE id = '$id'
			  ");
			  
			  $this->CreateSitemap($database);
			  
			  if (isset($_POST['updateclose'])) {
				/*
				?>
                <script>window.close();</script>
                <?
				*/
				header('location: pages.php');	  
			  }
			
		}	
		
	  
  }
  
	public function DeletePost($action,$id,$num) 
	{
		global $database;
		$table = 'pages';
		
		switch($action){
			case '1':
				// IMAGE 1
				
				## delete image from server ##
				$get_file = mysql_fetch_assoc($database->query("SELECT * FROM $table WHERE id = $id"));
				if ($get_file['image'.$num]!='') {
					$fh = fopen('../'.$get_file['image'.$num], 'w');
					fclose($fh);					
					$myFile = $get_file['image'.$num];
					unlink('../'.$myFile);
				}
				## delete image from server ##
				
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
	
	
	public function CreateSitemap($database) {
		global $lang;
		ob_start();
		?>
<?='<?xml version="1.0" encoding="UTF-8"?>'?>
<urlset
	  xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	  xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
			http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?
$sql = "SELECT * FROM pages WHERE template !='' AND hide!='yes' AND language = '$lang' ORDER BY sub ASC";
$query = $database->query($sql);
while($row=mysql_fetch_assoc($query)) {
	$link = $row['mod_rewrite'];
?>
<url>
  <loc>https://<?=$_SERVER['SERVER_NAME'].'/'.$link?></loc>
</url>
<?
}
echo '</urlset>';
		$content = ob_get_contents();
		ob_end_clean();
		$filename = "../sitemap/sitemap.xml"; 
		$handle = fopen($filename, 'w');
		$data = $content;
		fwrite($handle, $data); 
		fclose($handle); 
			
	}
	
	private function CreateDataBase($db,$database) {
		
		$result = $database->query("SHOW TABLES LIKE '$db'");
		$tableExists = $database->num_rows($result) > 0;
		if ($tableExists == false) {
			$database->query("CREATE TABLE table_name
			(
			`id` int(11), `sort` int(11), `name` varchar(250), `sub` int(11), `title1` varchar(250), `title2` varchar(250), `short_content` text, `content1` text, `content2` text, `content3` text, `mod_rewrite` varchar(250), `meta_title` varchar(250), `meta_title_perm` varchar(250), `meta_desc` varchar(250), `meta_key` varchar(250), `seo_alt` varchar(250), `seo_title` varchar(250), `template` varchar(250), `hide` varchar(50), `hide_menu` varchar(50), `alink1` varchar(250), `alink2` varchar(250), `language` varchar(50), `image1` text, `image2` varchar(250), `image3` varchar(250), `image4` varchar(250), `image1_names` text, `file1` text, `file2` varchar(250), `file3` varchar(250), `file4` varchar(250), `file1_names` text, `video` test, `date` date, `writer` varchar(250), `front` varchar(50), `tag` text, `categories` varchar(400), `visits` int(11)
			) 
			");
		}
			
	}
		
	
}

$page = new Page();
?>