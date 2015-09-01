<? 
if (strpos($_SERVER['REQUEST_URI'],'index.php')!==false) {
	header( "HTTP/1.1 301 Moved Permanently" );
	header("location: http://".$_SERVER['SERVER_NAME']);	
}
$s = strrpos($_SERVER['REQUEST_URI'], "/");
$t = strrpos($_SERVER['REQUEST_URI'], "?");

$r = $t - $s;

$string = substr($_SERVER['REQUEST_URI'],$s+1);
	
if ($string == "") { 
	$string = "index.php";	
}

$http = $_SERVER['SERVER_NAME'];

### CREATE REQUIRE FOLDERS IF NOT EXIST ###
$working_dir = getcwd();

$root = "/";
?>