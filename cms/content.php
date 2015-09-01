<?
$table = "pages";
include "../../includes/config.php";
include $includes_dir ."includes/sessions.php";
include $includes_dir ."includes/db.php";
include $includes_dir ."includes/auth.php";
include $includes_dir ."includes/database.php";
include $includes_dir ."includes/languages.php";
include $includes_dir ."includes/templates.php";
include $includes_dir ."includes/functions.php";
include "include/languages.php";
$id = (int)$_GET['id'];
$sql = "SELECT * FROM $table WHERE id = $id";
$page = mysql_fetch_assoc($database->query($sql));

$set_template = explode(".",$page['template']);
$set_template = array_reverse($set_template);
$set_template = end($set_template);

if ($_GET['biz']=='1') {	
	include "client.php";	
	die;
}

if (strpos($page['template'],'gallery')!==false || strpos($page['template'],'GALLERYTOP')!==false || strpos($page['template'],'GALLERYBOTTOM')!==false) {	
	include "gallery.php";
	die;
}

include "page.php";	
die;
?>