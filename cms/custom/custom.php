<?
if (isset($_POST['update'])) {
	
	$language = $_POST['lang'];
	$id = $_POST['id'];
	$page['custom'] = $database->mysql_prep(implode("@@@",$_POST['custom']));	
	
	$page['custom2'] = $database->mysql_prep(implode("@@@",$_POST['custom2']));

	$database->query("UPDATE $table SET `custom` = '{$page['custom']}',`custom2` = '{$page['custom2']}' WHERE id = '$id'");
	
	$page = $database->fetch("SELECT * FROM $table WHERE id = '$id'"); 
	
}
$custom_txt = array(
	'en'=>array(array('input','Title 1'),array('textarea','Content 1'),array('input','Title 2'),array('textarea','Content 2')),
	'he'=>array(array('input','כותרת 1'),array('textarea','תוכן 1'),array('input','קישור 1'),array('input','כותרת 2'),array('textarea','תוכן 2'),array('input','קישור 2'),array('input','כותרת 3'),array('textarea','תוכן 3'),array('input','קישור 3'))
);

$custom = explode("@@@",$page['custom']);

foreach ($custom_txt[$_GET['lang']] as $key=>$value) {
?>
        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$custom_txt[$_GET['lang']][$key][1]?></td>
        </tr>
        <tr>
        	<td colspan="2">
            <?
			if ($custom_txt[$_GET['lang']][$key][0]=='input') { 
			?>
            <input type="text" name="custom[]" class="TEXTINPUT" value="<?=htmlspecialchars($custom[$key])?>">
            <?
			} else {
			?>
			<textarea name="custom[<?=$key?>]" class="editor<?=$key?>"><?=$custom[$key]?></textarea>
            <script type="text/javascript">
			CKEDITOR.replace( 'custom[<?=$key?>]', {
					filebrowserBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor',
					filebrowserImageBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=image',
					filebrowserFlashBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=flash',	
					language: '<?=$_GET['lang']?>'
			});
			</script>
            <?	
			}
			?>
            </td>
        </tr>        
<?
}

$custom_txt = array(
	'en'=>array(array('input','Title 1'),array('textarea','Content 1'),array('input','Title 2'),array('textarea','Content 2')),
	'he'=>array(array('textarea','סלוגן'))
);

$custom = explode("@@@",$page['custom2']);

foreach ($custom_txt[$_GET['lang']] as $key=>$value) {
?>
        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$custom_txt[$_GET['lang']][$key][1]?></td>
        </tr>
        <tr>
        	<td colspan="2">
            <?
			if ($custom_txt[$_GET['lang']][$key][0]=='input') { 
			?>
            <input type="text" name="custom2[]" class="TEXTINPUT" value="<?=htmlspecialchars($custom[$key])?>">
            <?
			} else {
			?>
			<textarea name="custom2[<?=$key?>]" class="editor<?=$key?>"><?=$custom[$key]?></textarea>
            <script type="text/javascript">
			CKEDITOR.replace( 'custom2[<?=$key?>]', {
					filebrowserBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor',
					filebrowserImageBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=image',
					filebrowserFlashBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=flash',	
					language: '<?=$_GET['lang']?>'
			});
			</script>
            <?	
			}
			?>
            </td>
        </tr>        
<?
}
?>