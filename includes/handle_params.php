<?
$url=mb_substr(urldecode($_SERVER['REQUEST_URI']),1);
$params=explode("-",$url);
foreach ($params as $key=>$value) {
	$params[$key] = $value;//str_replace("0","\\",$value);
	if ($value=='') {
		unset($params[$key]);
	}
}
?>