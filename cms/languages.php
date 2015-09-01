<?
$table = "global";
include "../../includes/config.php";
include $includes_dir ."includes/sessions.php";
include $includes_dir ."includes/db.php";
include $includes_dir ."includes/auth.php";
include $includes_dir ."includes/config.php";
include $includes_dir ."includes/database.php";
include $includes_dir ."includes/langs.php";
include $includes_dir ."includes/languages.php";
include $includes_dir ."includes/functions.php";


include "include/languages.php";
$sql = "SELECT * FROM $table WHERE language = '{$_GET['lang']}'";
$page = mysql_fetch_assoc($database->query($sql));

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$title?></title>
<?=$css?>
<script type="text/javascript" src="js/jquery1.6.1.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
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
    
    <input type="submit" name="add" value="<?=$add_lang_text?>" class="ABTN">
    <div class="TABLE">
    	<table>
        	<?
			switch($_GET['lang']) {
				case('he'):
					?>
            <tr class="TRH">
            	<th class="TH1 THB">סימון</th>
                <th class="TH5 THB">שם שפה מלא</th>
                <th class="TH2 THB">שם שפה מקוצר (אנגלית)</th>
                <th class="TH4 THB">הסתרה</th>
                <th class="TH3 THB">פעולות</th>
            </tr> 
                    <?
					break;
				default:
					?>
            <tr class="TRH">
            	<th class="TH1 THB">Mark</th>
                <th class="TH2 THB">Language Full Name</th>
                <th class="TH4 THB">Language Short Name</th>
                <th class="TH5 THB">Hide</th>
                <th class="TH3 THB">Actions</th>
            </tr>
                    <?
					break;					
			}
        	?>
            <?
			$i=0;
			$sql   = "SELECT * FROM $table ORDER BY `default` ASC";			
			$query = $database->query($sql);
			while ($row=mysql_fetch_assoc($query)) {
				$i++;
				$bg = Admin_bg($i,$row);			
			?>
            <tr<?=$bg?>>
            	<td>
                <input type="hidden" name="id<?=$i?>" value="<?=$row['id']?>">
                <input type="checkbox" name="check<?=$i?>" class="CHECK">
                </td>
                <td><input type="text" name="language_text<?=$i?>" value="<?=htmlspecialchars($row['language_text'])?>" class="INTEXT"></td>
                <td><input type="text" name="language<?=$i?>" value="<?=htmlspecialchars($row['language'])?>" class="INTEXT"></td>                
                <td><input type="checkbox" name="hide<?=$i?>"<? if ($row['hide']=="yes") { ?> checked<? }?>></td>
                <td><img src="images/delete.png" alt="<?=$row['id']?>" class="DELETE"></td>
            </tr>        
			<?
			}
			?>
            <input name="total" type="hidden" value="<?=$i?>">            
            <tr class="TDBG2">
            	<td></td>
            	<td colspan="5"></td>
            </tr>
             <tr class="TDBG2">
            	<td></td>
            	<td colspan="6"><input type="submit" name="save" value="<?=$save_text?>" class="ABTN"> <input type="submit" name="delete" value="<?=$delete_text?>" class="ABTN"></td>
            </tr>
        </table>
    </div>
    </form>          
  </div>
  <div class="FOOTER">© All rights reserved to Dreamax Ltd 2011</div>
</div>
</body>
</html>