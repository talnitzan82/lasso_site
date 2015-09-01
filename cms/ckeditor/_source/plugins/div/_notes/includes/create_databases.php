<?
class CreateDatabase extends MySqlDatabase  {	

  
  
  function __construct() {
	  
	  	global $database;
		global $table;
		global $images;
		global $files;
		global $images_store;
		global $files_store;
		
		$this->CreateDataBase('pages',$database);
		$this->CreateDataBase('global',$database);
		$this->CreateDataBase('gallery',$database);
		$this->CreateDataBase('scans',$database);
		$this->CreateDataBase('tracker',$database);
		$this->CreateDataBase('templates',$database);
	  	 
		
  }
	
	private function CreateDataBase($db,$database) {
		
		$result = $database->query("SHOW TABLES LIKE '$db'");
		$tableExists = mysql_num_rows($result) > 0;
		if ($tableExists == false) {
			if ($db == 'pages') { 
				$database->query("CREATE TABLE $db
				(
				`id` int(11) NOT NULL NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), `sort` int(11) NOT NULL, `name` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `sub` int(11) NOT NULL, `title1` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `title2` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `title3` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `short_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `content1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `content2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `content3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `mod_rewrite` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `meta_title` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `meta_title_perm` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `meta_desc` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `meta_key` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `seo_alt` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `seo_title` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `template` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `hide` varchar(50)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `hide_menu` varchar(50)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `alink1` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `alink2` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `alink3` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `language` varchar(50)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `image1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `image2` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `image3` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `image4` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `image1_names` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `file1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `file2` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `file3` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `file4` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `file1_names` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `video` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `date` date, `writer` varchar(250)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `front` varchar(50)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `tag` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `categories` varchar(400)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `visits` int(11) NOT NULL
				) 
				");
			}
			if ($db == 'global') { 
				$database->query("CREATE TABLE $db
				(
				`id` int(11) NOT NULL NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), `perm_meta_title` varchar(300)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `footer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `script_header` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `script_footer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, `language` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,`language_text` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,`custom` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,`custom2` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,`default` int(11) NOT NULL,`hide` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
				) 
				");
			}
			if ($db == 'gallery') { 
				$database->query("CREATE TABLE $db
				(
				`id` int(11) NOT NULL NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), 
				`sub` int(11) NOT NULL, 
				`sort` int(11) NOT NULL, 
				`name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
				`short_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
				`content1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
				`filename` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
				`size` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
				`image` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
				`hide` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
				`front` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
				) 
				");
			}
			if ($db == 'templates') { 
				$database->query("CREATE TABLE $db
				(
				`id` int(11) NOT NULL NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), 
				`sort` int(11) NOT NULL, 
				`name` varchar(350) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
				`template` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
				`hide` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
				) 
				");
			}
			if ($db == 'scans') { 
				$database->query("CREATE TABLE $db
				(
				`id` int(11) NOT NULL NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), 
				`sort` int(11) NOT NULL, 
				`title` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, 
				`keyword` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
				`url` varchar(400) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
				`sub` int(11) NOT NULL,
				`date` timestamp,
				`position` int(11) NOT NULL
				) 
				");
			}
			if ($db == 'tracker') { 
				$database->query("CREATE TABLE $db
				(
				`id` int(11) NOT NULL NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), 
				`sub` int(11) NOT NULL,
				`brand` int(11) NOT NULL, 
				`keyword` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
				`url` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,				
				`date` timestamp,
				`status` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
				) 
				");
			}
		}
			
	}
		
	
}

$create = new CreateDatabase();
?>