<?
function GetLink($row,$mark='_')
{
	global $root;
	if ($row['alink1']=='') {
		if ($row['mod_rewrite']!=='') {
			
			$link = $root.str_replace(" ",$mark,$row['mod_rewrite']);
			
		} else {
			
			$link = $root.str_replace(" ",$mark,$row['name']);
			
		}
	} else {
		$link = $row['alink1'];
	}
	
	return $link;

}

function GetTitle($row)
{
	global $root;
	if ($row['title1']=='') {
		$title = $row['name'];	
	} else {
		$title = $row['title1'];		
	}
	return $title;

}



function RecycleTitle($page,$database,$lang) {
	global $root;
	$link = GetLink($page);
	if ($page['sub']!=0) {	
		$page = $database->fetch("SELECT * FROM pages WHERE id = '{$page['sub']}' AND language = '$lang'");		
		RecycleTitle($page,$database,$lang);
	} else {
		//if ($page['title1']=='') { 
			echo $page['name'];
		//} else {
		//	echo $page['title1'];
		//}
	}
	
}

function GetImage($row,$num=1) {
		$image = explode(",",$row['image1']);
		$image = $image[1];
		return $image;

}

function MenuLimits($template,$limits,$result=true) {
	foreach ($limits as $value) {
		if (strpos($template,$value)!==false) {
			$result = false;
		}
	}
	return $result;
}

function CurlGetInfo($url) {
	if ($url!='') {
		$ch = curl_init($url);
		curl_exec($ch);
		$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);	
		return $info;
	}	
}

function Encode($decoded,$key) {
	
	$result = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $decoded, MCRYPT_MODE_CBC, md5(md5($key))));
	return str_replace("/","--",$result);
	
}

function Decode($encoded,$key) {
	$encoded = str_replace("--","/",$encoded);
	$result = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encoded), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	return $result;
	
}
function SubmitEmail($sender,$subject,$body,$to) {
	
	$header       = 'MIME-Version: 1.0' . "\r\n";
	$header      .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$header      .= "From: ".$sender." \r\n";
		
	if (mail($to, $subject, $body, $header)) {
		return true;	
	} else {
		return false;
	}
	
}
/*
function HandleString($string) {
	
	$array1 = array("\\","
	
	$string = trim(str_replace(" ","_",$string));
	
	return $string;
	
}
*/
function HandleSearch($string,$params) {
	
	$order_array = CategoriesOrdering();
	$url		 = mb_substr(urldecode($_SERVER['REQUEST_URI']),1);
	$string = trim(str_replace(" ","_",$string));
	//$string = trim(str_replace("0","\\",$string));

	foreach($order_array as $value) {
		// Add string to url with right order
		$value = trim(str_replace(array(" ","\\"),array("_","0"),$value));
		if (
				(
				(in_array($value,$params) && $value!=$string)
				||
				(!in_array($value,$params) && $value==$string)
				)
				&& !in_array($value,$new_url)
			) 
		{	
			//$value     = str_replace("\\","0",$value);
			$new_url[] = str_replace(" ","_",$value);
			
		}
			
	}
	
	$result = '/'.trim(implode("-",$new_url),"-");
	/*
	$string 	 = str_replace(array(" "),array("_"),$string);	
	if (!in_array($string,$params)) {

		if ($url!='/') {
			$delimiter = '-';
		}
		
		$result = $url.$delimiter.$string;
				
	} else {

		$result = trim(str_replace(
									array($string.'-',$string),
									array("",""),
									$url)
					,"-");	
	}
	*/
	return $result;
}
function HandleSearchAll($array,$params) {

	$url=urldecode($_SERVER['REQUEST_URI']);
	foreach ($array as $value) {
		
		$value=str_replace(array(" "),array("_"),$value);	

		if (!in_array($value,$params)) {
	
			if ($url!='/') {
				$delimiter = '-';
			}
			
			$result[] = $value;
					
		}
	}
	if ($url!='/') {
		$url .= '-';
	}
	$result = $url.implode("-",$result);
	return $result;
}

function CategoriesOrdering() {
	
	global $database;
	
	$sql = "SELECT * FROM categories WHERE sub = 0 AND front = 'yes' ORDER BY sort DESC";
	$query = $database->query($sql);
	while($row=mysql_fetch_assoc($query)) {
		
		$array[] = $row['name'];

		$sql2 = "SELECT * FROM categories WHERE sub = '{$row['id']}' AND front = 'yes' AND name!='' ORDER BY sort DESC";
		$query2 = $database->query($sql2);						
		while($row2=mysql_fetch_assoc($query2)) {
			
			$array[] = $row2['name'];
			

			$sql3 = "SELECT * FROM categories WHERE sub = '{$row2['id']}' AND front = 'yes' ORDER BY sort DESC";			
			$query3 = $database->query($sql3);								
			while($row3=mysql_fetch_assoc($query3)) {
				
				$array[] = $row3['name'];
				
			}

		}	
	}
	return $array;
	
}

?>