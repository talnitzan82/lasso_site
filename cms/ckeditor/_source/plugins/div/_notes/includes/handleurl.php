<?
$pageurl  = explode("/",urldecode($_SERVER['REQUEST_URI']));
$pagename = $pageurl[1];
$pagekeys = explode("_",$pageurl[2]);
$pagenumber = $pageurl[3];
if (is_numeric($pageurl[2])) {
	$pagenumber = $pageurl[2];
}
/*
if (strpos(urldecode($_SERVER['REQUEST_URI']),'פתח-תקוה')!==false) {
	//$pagekeys = str_replace('פתח-תקוה','פתח-תקווה',$pagekeys);
	header( "HTTP/1.1 301 Moved Permanently");
	header('location:'.str_replace('פתח-תקוה','פתח-תקווה',urldecode($_SERVER['REQUEST_URI'])));
}
*/
?>