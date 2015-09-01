<?
$table = "products";
include_once "../../includes/config.php";
include_once $includes_dir ."includes/sessions.php";
include_once $includes_dir ."includes/db.php";
include_once $includes_dir ."includes/auth.php";
include_once $includes_dir ."includes/database.php";
include_once $includes_dir ."includes/languages.php";
include_once $includes_dir ."includes/templates.php";
include_once $includes_dir ."includes/products.php";
include_once $includes_dir ."includes/functions.php";
include_once "include/languages.php";
$id = (int)$_GET['id'];
$sql = "SELECT * FROM $table WHERE id = $id";
$page = $database->fetch($sql);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<title><?=$title?></title>
<?=$css?>
<script type="text/javascript" src="js/jquery1.6.1.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	
	$(".DELIMAGE1").click(function() {
		
		var pid  = $(this).attr("alt");		
		var num  = $(this).attr("num");
		var element = $(this);
		$.post('include/delete.php',{action: '1', id: pid, image: num}, function(data) {  
			element.parent().remove();
			element.parent().parent().append(data);
		});
		
	});
	$(".DELIMAGE2").click(function() {
		
		var pid  = $(this).attr("alt");
		var num = $(this).attr("num");
		var element = $(this);
		$.post('include/delete.php',{action: '2', id: pid, image: num}, function(data) {  
		
			element.parent().parent().remove();	
		
		});
		
	});
	$(".DELFILE1").click(function() {
		
		var pid  = $(this).attr("alt");
		var num = $(this).attr("num");
		var element = $(this);
		$.post('include/delete.php',{action: '3', id: pid, image: num}, function(data) {  
		
			element.parent().remove();	
			element.parent().parent().append(data);
		
		});
		
	});
	$(".DELFILE2").click(function() {
		
		var pid  = $(this).attr("alt");
		var num = $(this).attr("num");
		var element = $(this);
		$.post('include/delete.php',{action: '4', id: pid, image: num}, function(data) {  
		
			element.parent().parent().remove();	
		
		});
		
	});
	
	
	CKEDITOR.replace( 'content1', {
			filebrowserBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor',
            filebrowserImageBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=image',
            filebrowserFlashBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=flash',	
			language: '<?=$_GET['lang']?>'
	});
	
	<?
	//if ($set_template=='index' || $set_template=='contact') {
	?>
	CKEDITOR.replace( 'content2', {
			filebrowserBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor',
            filebrowserImageBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=image',
            filebrowserFlashBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=flash',	
			language: '<?=$_GET['lang']?>'
	});
	<?
	//}
	//if ($set_template=='index') {
	?>
	CKEDITOR.replace( 'content3', {
			filebrowserBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor',
            filebrowserImageBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=image',
            filebrowserFlashBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=flash',	
			language: '<?=$_GET['lang']?>'
	});
	
	CKEDITOR.replace( 'content4', {
			filebrowserBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor',
            filebrowserImageBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=image',
            filebrowserFlashBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=flash',	
			language: '<?=$_GET['lang']?>'
	});
	<?	
	//}
	?>
	
	
});
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<div class="CONTAINER">
  <div class="TOP">
      <? include "include/top.php"; ?>
  </div>  
  <div class="MIDDLE">
  <form action="" method="post" enctype="multipart/form-data">
  	<input type="hidden" name="lang" value="<?=$page['language']?>">
  	<br><br><br>
    <table class="PTABLE">        
        <tr>
        	<td colspan="2"><input type="submit" name="update" value="<?=$save_changes?>" class="ABTN"> <input type="submit" name="updateclose" value="<?=$save_close?>" class="ABTN"></td>
        </tr>
        <tr>
        	<td><br><strong><?=$edit_page?></strong></td>
        </tr>
        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$page_name?> <input type="text" name="name" class="TEXTINPUT2" value="<?=htmlspecialchars($page['name'])?>"></td>
        </tr>
    	<tr>
        	<td colspan="2" class="PLINK"><br><?=$page_link?> <a href="http://<?=$_SERVER['SERVER_NAME']?>/<?=$page['mod_rewrite']?>" target="_blank" style="direction:ltr;">http://<?=$_SERVER['SERVER_NAME']?>/<?=$page['mod_rewrite']?></a></td>
        </tr>
        <tr>
        	<td colspan="2" class="PLINK"><br><?=$page_category?>
            	  <select name="category">
                	<option value=""><?=$page_category_select?></option>
                    <?
					$i=0;
					$sql   = "SELECT * FROM $table WHERE sub = 0 AND language = '{$_GET['lang']}' ORDER BY sort ASC";			
					$query = $database->query($sql);
					while ($row=mysql_fetch_assoc($query)) {
						$i++;
						$add = '';
						?>
                        <option value="<?=$row['id']?>"<? if ($row['id']==$page['sub']) {?> selected<? }?>><?=$add?> <?=$row['name']?></option>
                        <?						
						$sql2   = "SELECT * FROM $table WHERE sub = '{$row['id']}' ORDER BY sort ASC";
						$query2 = $database->query($sql2);
						while ($row2=mysql_fetch_assoc($query2)) {
							$i++;
							$row = $row2;
							$add = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_ ';				
							?>
                            <option value="<?=$row['id']?>"<? if ($row['id']==$page['sub']) {?> selected<? }?>><?=$add?> <?=$row['name']?></option>
                            <?							
							$sql3   = "SELECT * FROM $table WHERE sub = '{$row2['id']}' ORDER BY sort ASC";
							$query3 = $database->query($sql3);
							while ($row3=mysql_fetch_assoc($query3)) {
								$i++;
								$row = $row3;
								$add = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_ ';				
								?>
                                <option value="<?=$row['id']?>"<? if ($row['id']==$page['sub']) {?> selected<? }?>><?=$add?> <?=$row['name']?></option>
                                <?
								
								$sql4   = "SELECT * FROM $table WHERE sub = '{$row3['id']}' ORDER BY sort ASC";
								$query4 = $database->query($sql4);
								while ($row4=mysql_fetch_assoc($query4)) {
									$i++;
									$row = $row4;
									$add = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_ ';				
									?>
                                    <option value="<?=$row['id']?>"<? if ($row['id']==$page['sub']) {?> selected<? }?>><?=$add?> <?=$row['name']?></option>
                                    <?			
								}  			
							}  
											
						}	          
					
					}
					?>
                  </select>
            </td>
        </tr>
        <tr>
        	<td colspan="2" class="PLINK"><br><strong><?=$page_assign_category?></strong><bR><bR>
                    <?
					$categories = explode(",",$page['categories']);
					$i=0;
					$sql   = "SELECT * FROM `categories` WHERE sub = 0  AND name!='' ORDER BY sort ASC";			
					$query = $database->query($sql);
					while ($row=mysql_fetch_assoc($query)) {
						$i++;
						$add = '';
						?>
                        <div style="width:200px; float:right">
                        <div class="CATEDIV">
                        <?
						/*
                        <input type="checkbox" name="categories[]" value="<?=$row['id']?>"<? if (in_array($row['id'],$categories)) {?> checked<? }?>>
						*/
						?>
						<strong><?=$add?> <?=$row['name']?></strong><br>
						</div>
                        <?						
						$sql2   = "SELECT * FROM `categories` WHERE sub = '{$row['id']}' ORDER BY sort ASC";
						$query2 = $database->query($sql2);
						while ($row2=mysql_fetch_assoc($query2)) {							
							$i++;
							$row = $row2;
							$add = '&nbsp;&nbsp;&nbsp;&nbsp;|_ ';				
							?>
                            <div class="CATEDIV"><input type="checkbox" name="categories[]" value="<?=$row['id']?>"<? if (in_array($row['id'],$categories)) {?> checked<? }?>><?=$add?> <?=$row['name']?></div>
                            <?							
							$sql3   = "SELECT * FROM `categories` WHERE sub = '{$row2['id']}' ORDER BY sort ASC";
							$query3 = $database->query($sql3);
							while ($row3=mysql_fetch_assoc($query3)) {
								$i++;
								$row = $row3;
								$add = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_ ';				
								?>
                                <div class="CATEDIV"><input type="checkbox" name="categories[]" value="<?=$row['id']?>"<? if (in_array($row['id'],$categories)) {?> checked<? }?>><?=$add?> <?=$row['name']?></div>
                                <?
								
								$sql4   = "SELECT * FROM `categories` WHERE sub = '{$row3['id']}' ORDER BY sort ASC";
								$query4 = $database->query($sql4);
								while ($row4=mysql_fetch_assoc($query4)) {
									$i++;
									$row = $row4;
									$add = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_ ';				

									?>
                                    <div class="CATEDIV"><input type="checkbox" name="categories[]" value="<?=$row['id']?>"<? if (in_array($row['id'],$categories)) {?> checked<? }?>><?=$add?> <?=$row['name']?></div>
                                    <?			
								}  			
							}  
											
						}
						?>
                        </div>
                        <?	          
					
					}
					?>
            </td>
        </tr>
        <tr>
        	<td colspan="2" class="PLINK">
               <br>
               <table>
                   <tr>
                       <td>הסתר מוצר</td>
                       <td><input type="checkbox" name="hide"<? if ($page['hide']=="yes") { ?> checked<? }?>></td>
                   </tr>
                   <tr>
                       <td>הצג מוצר בראשי</td>
                       <td><input type="checkbox" name="front"<? if ($page['front']=="yes") { ?> checked<? }?>></td>
                   </tr>
                   <tr>
                       <td><?=$page_date?></td>
                       <td> <input type="text" name="date" value="<?=date("Y-m-d",strtotime($page['date']))?>"></td>
                   </tr>
                </table>   
            </td>
        </tr>
    	<tr>
        	<td colspan="2" class="PTITLE"><br><?=$page_title1?></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="text" name="title1" class="TEXTINPUT" value="<?=$page['title1']?>"></td>
        </tr>
        <tr>
        	<td><br><?=$page_short_content?></td>
        </tr>
        <tr>    
            <td><textarea name="short_content"><?=$page['short_content']?></textarea></td>
        </tr>
        <tr>
        	<td><br><?=$page_content1?></td>
        </tr>
        <tr>    
            <td><textarea id="editor1" name="content1"><?=$page['content1']?></textarea></td>
        </tr>
        <?
		//if ($set_template=='index' || $set_template=='contact') {
		?>
        <tr>
        	<td colspan="2" class="PTITLE"><br><strong>פרטי יצירת קשר</strong></td>
        </tr> 
        <tr>
        	<td colspan="2">כתובת: <input type="text" name="area" class="TEXTINPUT" value="<?=$page['area']?>"></td>
        </tr>   
        <tr>
        	<td colspan="2">כתובת: <input type="text" name="address" class="TEXTINPUT" value="<?=$page['address']?>"></td>
        </tr>
        <tr>
        	<td colspan="2">טלפון: <input type="text" name="phone" class="TEXTINPUT" value="<?=$page['phone']?>"></td>
        </tr>
        <tr>
        	<td colspan="2">איש קשר: <input type="text" name="contact" class="TEXTINPUT" value="<?=$page['contact']?>"></td>
        </tr>
        <tr>
        	<td colspan="2">אתר: <input type="text" name="website" class="TEXTINPUT" value="<?=$page['website']?>"></td>
        </tr>
        <tr>
        	<td colspan="2">קישור פייסבוק: <input type="text" name="facebook" class="TEXTINPUT" value="<?=$page['facebook']?>"></td>
        </tr>
        <tr>
        	<td><br>מפת גוגל</td>
        </tr>
        <tr>    
            <td><textarea id="editor2" name="content2"><?=$page['content2']?></textarea></td>
        </tr>
        <tr>
        	<td><br>מפת גוגל מובייל</td>
        </tr>
        <tr>    
            <td><textarea id="editor4" name="content4"><?=$page['content4']?></textarea></td>
        </tr>
        <?
		//}
		//if ($set_template=='index') {
		?> 
        <?
		/*
        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$page_title3?></td>
        </tr>    

        <tr>
        	<td colspan="2"><input type="text" name="title3" class="TEXTINPUT" value="<?=$page['title3']?>"></td>
        </tr> 
		*/
		?>
        <tr>
        	<td><br><?=$page_content3?></td>
        </tr>
        <tr>    
            <td><textarea id="editor3" name="content3"><?=$page['content3']?></textarea></td>
        </tr>   
            <?
		//}
		?>
        <tr>
        	<td><br><strong><?=$page_seo?></strong></td>
        </tr>
        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$page_friendly?></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="text" name="mod_rewrite" class="TEXTINPUT" value="<?=$page['mod_rewrite']?>"></td>
        </tr>
        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$page_meta_title?></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="text" name="meta_title" class="TEXTINPUT" value="<?=$page['meta_title']?>"></td>
        </tr>
        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$page_meta_keywords?></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="text" name="meta_key" class="TEXTINPUT" value="<?=htmlspecialchars($page['meta_key'])?>"></td>
        </tr>
        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$page_meta_desc?></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="text" name="meta_desc" class="TEXTINPUT" value="<?=$page['meta_desc']?>"></td>
        </tr>
        <tr>
        	<td colspan="2"><br><br><input type="submit" name="update" value="<?=$save_text?>" class="ABTN"> <input type="submit" name="updateclose" value="<?=$save_close?>" class="ABTN"></td>
        </tr>
    </table>    
    </form> 
    <form action="" method="post" enctype="multipart/form-data"> 
    <br><br><h1><?=$page['name']?> גלריית תמונות</h1>
    <strong>בחר קבצים להעלאה:</strong>
    <br>
    <input type="file" name="upload[]" multiple>
    <br>
    <input type="submit" name="add" value="<?=$add_images_text?>" class="ABTN">
    <br><br>

    <input type="hidden" name="id" value="<?=$_GET['id']?>">   
    <input type="hidden" name="lang" value="<?=$_GET['lang']?>"> 
    <div class="TABLE">
    	<table>
        	<?
			switch($_GET['lang']) {
				case('he'):
					?>            
             <tr class="TRH">
            	<th class="TH1 THB">סימון</th>
                <th class="TH5 THB">מיקום</th>
                <th class="TH2 THB">תמונה</th>
                <th class="TH2 THB">שם התמונה</th>
                <th class="TH4 THB">גודל התמונה</th>
                <th class="TH4 THB">שם קובץ בשרת</th>
                <th class="TH5 THB">הסתרה</th>
                <th class="TH5 THB">תמונה ראשית</th>
                <th class="TH5 THB">תמונת רקע</th>
                <th class="TH5 THB">לוגו</th>
                <th class="TH5 THB">BG REPEAT</th>
                <th class="TH3 THB">פעולות</th>
            </tr>
                    <?
					break;
				default:
					?>
           <tr class="TRH">
            	<th class="TH1 THB">Mark</th>
                <th class="TH5 THB">Order</th>
                <th class="TH2 THB">Image Name</th>
                <th class="TH2 THB">Content</th>
                <th class="TH4 THB">Image Size</th>
                <th class="TH5 THB">File name on Server</th>
                <th class="TH5 THB">Image</th>
                <th class="TH5 THB">Hide</th>
                <th class="TH5 THB">Show Front</th>
                <th class="TH3 THB">Actions</th>
            </tr>
                    <?
					break;					
			}
        	?>
            <?
			$i=0;
			$sql   = "SELECT * FROM gallery WHERE sub = '{$_GET['id']}' ORDER BY sort ASC";	
			$query = $database->query($sql);
			while ($row=mysql_fetch_assoc($query)) {
				$i++;
				$add = '';
				include "include/grow2.php";				          
			
			}
			?>
            <input name="total" type="hidden" value="<?=$i?>">            
            <tr class="TDBG2">
            	<td></td>
            	<td colspan="11"></td>
            </tr>
             <tr class="TDBG2">
            	<td></td>
            	<td colspan="11"><input type="submit" name="save_gallery" value="<?=$save_text?>" class="ABTN"> <input type="submit" name="delete_gallery" value="<?=$delete_text?>" class="ABTN"></td>
            </tr>
        </table>
        </div>
        </form>
    </div>         
  </div>
  <div class="FOOTER">© All rights reserved to Dreamax Ltd 2011</div>
</div>
</body>
</html>