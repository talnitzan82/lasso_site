<?php
include_once "includes/requires.php";
include_once "../includes/templates.php";

############ HANDLE LANGUAGES #############
$exist = false;
$find = explode("/",$database->mysql_prep($_SERVER['REQUEST_URI']));
$find = array_reverse($find);
$find_extra = $find;
$count = (count($find)-1);
unset($find[$count],$find_extra[$count]);

$pattern = str_replace("/","",end($find));
if (array_key_exists($pattern,$languages)) {	

	$lang = $pattern;

	$_SERVER['REQUEST_URI'] =  str_replace(array("/$lang/"),array(""),$_SERVER['REQUEST_URI']);
	
	
	$exist = true;
	
	if ($exist==true) { $pat=$root.$pattern; } else { unset($pat); }

}
if ($exist==true && $_SERVER['REQUEST_URI']=='') {
	
	include 'index.php';
	die;
	
}
############ HANDLE LANGUAGES #############
if ($_SERVER['REQUEST_URI']!='') {
	
	//echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
	
	if (is_numeric($find[1])) {
		$find[1] = $find[2];
		$find[2] = $find[3];
	}

	if ($find[0]=='' && $find[1]!='') {
		$pagename  = urldecode($find[1]);
	} elseif($find[0]!='' && $find[1]!='') {
		$pagename  = urldecode($find[1]);	
	} else {
		$pagename  = urldecode($find[0]);	
	}

	$pagename = urldecode($find[0]);
	$pagename2 = str_replace(" ","_",urldecode($find[0]));
	$pagename3 = str_replace("_"," ",urldecode($find[0]));	
	
	
	
	$sql = "SELECT * FROM pages WHERE (name = '$pagename2' OR name = '$pagename3' OR mod_rewrite = '$pagename') AND hide !='yes' AND language = '$lang' AND `alink1` = ''";
	$page = mysql_fetch_array($database->query($sql));
	if ($page['id']=='') {
		
		$sql = "SELECT * FROM products WHERE (name = '$pagename2' OR name = '$pagename3' OR mod_rewrite = '$pagename') AND hide !='yes' AND language = '$lang' AND `alink1` = ''";
		$page = mysql_fetch_array($database->query($sql));	
		if ($page['id']!='') {
			$page['template'] = 'product.php?id=1';
		}
		
		if ($page['id']=='') {
			$url_explode = explode("-",$database->mysql_prep(mb_substr($_SERVER['REQUEST_URI'],1)));
			$url_implde = str_replace(array("_","0"),array(" ","\\\\"),urldecode(implode("','",$url_explode)));
			$sql = "SELECT * FROM categories WHERE name in ('$url_implde')";
			$page = mysql_fetch_array($database->query($sql));	
			if ($page['id']!='') {
				$page['template'] = 'index.php?id=1';
			}			
		}		
	}
	if (preg_match('/השוואה/',urldecode($_SERVER['REQUEST_URI']))) {
		$page['template'] = 'compare.php?id=1';	
	}
	if (preg_match('/חיפוש/',urldecode($_SERVER['REQUEST_URI']))) {
		$page['template'] = 'search.php?id=1';	
	}

}
if (!isset($page)) {	

	header( "HTTP/1.1 301 Moved Permanently" );
	header('location: https://'.$_SERVER['SERVER_NAME'].'/404.php');

} else {
	$template = explode("?",$page['template']);
	$set_template = false;
	
	$templates[] = 'product.php';
	$templates[] = 'compare.php';
	$templates[] = 'search.php';
	foreach ($templates as $value) {
		$value = explode("?",$value);
		if ($template[0]==$value[0]) {
			include $value[0];
			$set_template = true;			
			break;	
		}
	}
	if ($set_template==false) {

		header( "HTTP/1.1 301 Moved Permanently" );
		header('location: https://'.$_SERVER['SERVER_NAME'].'/404.php');

	}
	
}
?>