<?
function Admin_bg($i,$row) {
	//if ($row['hide']!=='yes') {
		if ($i % 2) {
			$bg = ' class="TDBG1"';
		} else {
			$bg = ' class="TDBG2"';
		}	
	//} else {
		//$bg = ' style="background-color:#f0b9b9"';
	//}
	return $bg;
}
function Recycle($page,$database,$first='דף הבית') {
	
	$link = GetLink($page);
	if ($page['sub']!=0) {
	?>
    <a href="<?=$root.$link?>"><?=$page['name']?></a> &lt;
    <?
	$page = $database->query("SELECT * FROM pages WHERE id = '{$page['sub']}'");
	Recycle($page,$database);
	} else {
	?>
    <a href="<?=$root.$link?>"><?=$page['name']?></a> &lt;
    <?	
	}
	?>
    <a href="<?=$root?>"><?=$first?></a> &lt;
    <?
}
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function EmailValidate($email) {
	
	if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
		$email_validation = TRUE;
	} else {
		$email_validation = FALSE;
	}	
	
	return $email_validation;
	
}
function LimitText($text,$limit){
	$text = strip_tags($text);
	$text = str_replace(array('<p>', '</p>'), array('', ''), $text);
	//$text = strip_tags($text);
	if(strlen($text) < $limit) {
		echo $text;
	} else {
		$string = mb_substr($text,0,$limit);
		echo $string."...";
	}	

}

function LimitText2($text,$limit){
	$text = str_replace(array('<p>', '</p>'), array('', ''), $text);
	//$text = strip_tags($text);
	if(strlen($text) < $limit) {
		return $text;
	} else {
		$string = mb_substr($text,0,$limit);
		return $string."";
	}	

}
function RowEmpty($text) {
	
	if (!empty($text)) {
		echo $text;
	} else {
		echo "-";
	}
}

function RowSpecial($text) {
	
	if (!empty($text)) {
		echo $text;
	} else {
		echo "מכונאות כללית";
	}
}

function NavPages2($database,$table,$limit,$category,$url_i) {
	
	global $pagename;
	
	$total = ceil($database->num_rows("SELECT * FROM {$table} WHERE category = '$category' ") / $limit);
	
	$i = 1;
	while ($i <= $total) {
		if ($i == $url_i) {			
			echo '<a href="'.$pagename.'?p='.$i.'" class="NAVCHECKED">'.$i.'</a> ';
		} else {
			echo '<a href="'.$pagename.'?p='.$i.'">'.$i.'</a> ';
		}
	$i++;
	}	
	
}
function NavPages3($database,$table,$limit,$category,$url_i) {
	
	global $pagename;
	
	$total = ceil($database->num_rows("SELECT * FROM {$table}") / $limit);
	
	$i = 1;
	while ($i <= $total) {
		if ($i == $url_i) {			
			echo '<a href="'.$pagename.'?p='.$i.'" class="NAVCHECKED">'.$i.'</a> ';
		} else {
			echo '<a href="'.$pagename.'?p='.$i.'">'.$i.'</a> ';
		}
	$i++;
	}	
	
}
function NavPages($database,$table,$limit,$category,$url_i) {
	
	global $pagename;
	
	$total = ceil($database->num_rows("SELECT * FROM {$table} WHERE sub = '{$page['id']}' ") / $limit);
	
	$i = 1;
	while ($i <= $total) {
		if ($i == $url_i) {			
			echo '<a href="'.$pagename.'?p='.$i.'" class="NAVCHECKED">'.$i.'</a> ';
		} else {
			echo '<a href="'.$pagename.'?p='.$i.'">'.$i.'</a> ';
		}
	$i++;
	}	
	
}

?>