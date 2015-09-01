<?
$table = "global";
include "../../includes/config.php";
include $includes_dir ."includes/sessions.php";
include $includes_dir ."includes/db.php";
include $includes_dir ."includes/auth.php";
include $includes_dir ."includes/config.php";
include $includes_dir ."includes/database.php";
include $includes_dir ."includes/languages.php";
include $includes_dir ."includes/functions.php";

if (isset($_POST['update'])) {
	$footer          = $database->mysql_prep($_POST['footer']);
	$script_footer   = $database->mysql_prep($_POST['script_footer']);
	$script_header   = $database->mysql_prep($_POST['script_header']);
	$perm_meta_title = $database->mysql_prep($_POST['perm_meta_title']);
	$language = $_POST['lang'];
	$id = $_POST['id'];
	$database->query("UPDATE $table SET script_footer = '$script_footer',script_header = '$script_header',footer = '$footer',perm_meta_title = '$perm_meta_title' WHERE id = '$id'");
	
}
include "include/languages.php";
$sql = "SELECT * FROM $table WHERE language = '{$_GET['lang']}'";
$page = $database->fetch($sql);

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$title?></title>
<?=$css?>
<script type="text/javascript" src="js/jquery1.6.1.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	CKEDITOR.replace( 'footer', {
			filebrowserBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor',
            filebrowserImageBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=image',
            filebrowserFlashBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=flash',	
			language: '<?=$_GET['lang']?>'
	});
});
</script>
</head>

<body>
<div class="CONTAINER">
  <div class="TOP">
      <? include "include/top.php"; ?>
  </div>
  <div class="MIDDLE">
  <BR>
  	<form action="" method="get">
    	<?
		if (count($languages) > 1) {
		echo $lang_text;			
		?> 
		<select name="lang">
			<?
			foreach ($languages as $key=>$value) {
			?>
			<option value="<?=$key?>"<? if ($_GET['lang']==$key) { ?> selected<? }?>><?=$value?></option>
			<?
			}
			?>
		</select>
        <input type="submit" value="Go" class="ABTN">
		<? } ?>
    </form>
  <form action="" method="post" enctype="multipart/form-data">
  	<input type="hidden" name="lang" value="<?=$_GET['lang']?>">
    <input type="hidden" name="id" value="<?=$page['id']?>">
  	<br><br><br>
    <table class="PTABLE">        
        <tr>
        	<td colspan="2"><input type="submit" name="update" value="<?=$save_changes?>" class="ABTN"></td>
        </tr>
        <tr>
        	<td><br><strong><?=$settings_global_text?></strong></td>
        </tr>
        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$settings_perm_title?></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="text" name="perm_meta_title" class="TEXTINPUT" value="<?=htmlspecialchars($page['perm_meta_title'])?>"></td>
        </tr>
		<tr>
        	<td><br><?=$settings_header_scripts?></td>
        </tr>
        <tr>    
            <td><textarea name="script_header" class="TEXTA" style="text-align:left;direction:ltr"><?=$page['script_header']?></textarea></td>
        </tr>
        <tr>
        	<td><br><?=$settings_footer_scripts?></td>
        </tr>
        <tr>    
            <td><textarea name="script_footer" class="TEXTA" style="text-align:left;direction:ltr"><?=$page['script_footer']?></textarea></td>
        </tr>

        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$settings_footer?></td>
        </tr>
        <tr>
        	<td colspan="2"><textarea id="editor1" name="footer"><?=$page['footer']?></textarea></td>
        </tr>
        <? //include "custom/custom.php"; ?>
        <tr>
        	<td colspan="2"><br><br><input type="submit" name="update" value="<?=$save_changes?>" class="ABTN"></td>
        </tr>
    </table>
    </form>          
  </div>
  <div class="FOOTER">© All rights reserved to Dreamax Ltd 2011</div>
</div>
</body>
</html>