<?
##### LANG SET ####
$lang_sql = "SELECT * FROM `global` ORDER BY `default` DESC";
$query = $database->query($lang_sql);
$i=0;
while($row=mysql_fetch_array($query)) {
	if ($i==0) { 
		$lang = $row['language'];
	}
	$languages[$row['language']] = $row['language_text'];
	$i++;
}
mysql_free_result($query);
unset($i);

##### LANG SET ####
?>