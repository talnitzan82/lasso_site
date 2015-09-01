<?
$find = explode("/",urldecode($database->mysql_prep($_SERVER['REQUEST_URI'])));
$find = array_reverse($find);
$url=$find[0];
$params=explode("-",$url);
foreach ($params as $key=>$value) {
	$params[$key] = $value;//str_replace("0","\\",$value);
	if ($value=='') {
		unset($params[$key]);		
	}
}
?>