<?
$tempid = $row['id'];
$template_sql = "SELECT * FROM templates WHERE hide !='yes'";
$template_query = $database->query($template_sql);
while($template_row = mysql_fetch_array($template_query)) {
	$templates[$template_row['name']] = $template_row['template']."?id=$tempid";
}
mysql_free_result($template_query);
?>