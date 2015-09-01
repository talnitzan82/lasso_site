<nav>
<a href="<?=$root?>">דף הבית</a>
<?
$i=0;
$url = explode("/",urldecode($_SERVER['REQUEST_URI']));
$urlcount = count($url);
foreach ($url as $value) {
	$i++;
	$value_clear = str_replace("_"," ",$value);
	if ($value!='') {
		$link = $value;
		if (strpos($value,'אוטופיקס')!==false) {
				$link = $last."/".$value;
		}
		if ($i == $urlcount && $urlcount > 2) {
			$value_clear = $page['title'];
		}
	?>
&gt; <a href='<?=$root.$link?>'><?=$value_clear?></a>
    <?	
	}
	$last = $value;
}
?>
</nav>