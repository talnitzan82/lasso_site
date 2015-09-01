<?
$root='/';
$menu_level = 2;
$right_menu_level = 1;
$TemplateLimits = array('news','products','articles');
foreach ($languages as $key=>$value) {
	if (strpos($_SERVER['REQUEST_URI'],'/'.$key.'/')!==false) { $lang = $key; }	
}
$global = $database->fetch("SELECT * FROM global WHERE language = '$lang'");

### HANDLE WWW ####
$dots_count = explode(".",$_SERVER['SERVER_NAME']);
if (count($dots_count) < 4) {
	header("HTTP/1.1 301 Moved Permanently");
	//header("location: http://www.".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
    // Need to return this line on web server
}
### HANDLE WWW ####
if (preg_match('/m.lasso/',$_SERVER['HTTP_REFERER'])) {
	$_SESSION['mobile']='no';
}

if( $detect->isMobile() && !$detect->isTablet() && $_SESSION['mobile']!='no'){
	$dots_count = explode(".",$_SERVER['SERVER_NAME']);
	if ($dots_count[0]=='www') {
		$dots_count[0]='m';
	} else {
		array_unshift($dots_count,'m');
	}
	header("location: http://".implode(".",$dots_count).$_SERVER['REQUEST_URI']);
}
?>