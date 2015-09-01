<?
$table = "pages";
include_once "../../includes/config.php";
include_once $includes_dir ."includes/sessions.php";
include_once $includes_dir ."includes/db.php";
include_once $includes_dir ."includes/auth.php";
include_once $includes_dir ."includes/database.php";
include_once $includes_dir ."includes/languages.php";
include_once $includes_dir ."includes/templates.php";
include_once $includes_dir ."includes/pages.php";
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
	if ($set_template=='index') {
	?>
	CKEDITOR.replace( 'content3', {
			filebrowserBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor',
            filebrowserImageBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=image',
            filebrowserFlashBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=flash',	
			language: '<?=$_GET['lang']?>'
	});
	<?	
	}
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
        	<td colspan="2" class="PTITLE"><br><?=$page_olink?> <input type="text" name="alink1" class="TEXTINPUT2" value="<?=$page['alink1']?>"></td>
        </tr>
    	<tr>
        	<td colspan="2" class="PLINK"><br><?=$page_link?> <a href="http://<?=$_SERVER['SERVER_NAME']?>/<?=$page['mod_rewrite']?>" target="_blank">http://<?=$_SERVER['SERVER_NAME']?>/<?=$page['mod_rewrite']?></a></td>
        </tr>
        <tr>
        	<td colspan="2" class="PLINK"><br><?=$page_template?>
            	  <select name="template">
                	<option value=""><?=$page_template_select?></option>
                    <?
					$row = $page;
					include $includes_dir ."includes/templates.php";
					foreach ($templates as $key=>$value) {
						?>
                    <option value="<?=$value?>"<? if ($value==$page['template']) {?> selected<? }?>><?=$key?></option>    
                        <?
					}
					?>
                  </select>
            </td>
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
        	<td colspan="2" class="PLINK"><br><?=$page_category?>
                    <?
					$categories = explode(",",$page['categories']);
					$i=0;
					$sql   = "SELECT * FROM $table WHERE sub = 0 AND language = '{$_GET['lang']}' ORDER BY sort ASC";			
					$query = $database->query($sql);
					while ($row=mysql_fetch_assoc($query)) {
						$i++;
						$add = '';
						?>
                        <div class="CATEDIV"><input type="checkbox" name="categories[]" value="<?=$row['id']?>"<? if (in_array($row['id'],$categories)) {?> checked<? }?>><?=$add?> <?=$row['name']?></option></div>
                        <?						
						$sql2   = "SELECT * FROM $table WHERE sub = '{$row['id']}' ORDER BY sort ASC";
						$query2 = $database->query($sql2);
						while ($row2=mysql_fetch_assoc($query2)) {
							$i++;
							$row = $row2;
							$add = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_ ';				
							?>
                            <div class="CATEDIV"><input type="checkbox" name="categories[]" value="<?=$row['id']?>"<? if (in_array($row['id'],$categories)) {?> checked<? }?>><?=$add?> <?=$row['name']?></option></div>
                            <?							
							$sql3   = "SELECT * FROM $table WHERE sub = '{$row2['id']}' ORDER BY sort ASC";
							$query3 = $database->query($sql3);
							while ($row3=mysql_fetch_assoc($query3)) {
								$i++;
								$row = $row3;
								$add = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_ ';				
								?>
                                <div class="CATEDIV"><input type="checkbox" name="categories[]" value="<?=$row['id']?>"<? if (in_array($row['id'],$categories)) {?> checked<? }?>><?=$add?> <?=$row['name']?></option></div>
                                <?
								
								$sql4   = "SELECT * FROM $table WHERE sub = '{$row3['id']}' ORDER BY sort ASC";
								$query4 = $database->query($sql4);
								while ($row4=mysql_fetch_assoc($query4)) {
									$i++;
									$row = $row4;
									$add = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_ ';				

									?>
                                    <div class="CATEDIV"><input type="checkbox" name="categories[]" value="<?=$row['id']?>"<? if (in_array($row['id'],$categories)) {?> checked<? }?>><?=$add?> <?=$row['name']?></option></div>
                                    <?			
								}  			
							}  
											
						}	          
					
					}
					?>
            </td>
        </tr>
        <tr>
        	<td colspan="2" class="PLINK">
               <br>
               <table>
                   <tr>
                       <td><?=$page_hide?></td>
                       <td><input type="checkbox" name="hide"<? if ($page['hide']=="yes") { ?> checked<? }?>></td>
                   </tr>
                   <tr>
                       <td><?=$page_hide_menu?></td>
                       <td><input type="checkbox" name="hide_menu"<? if ($page['hide_menu']=="yes") { ?> checked<? }?>></td>
                   </tr>
                   <tr>
                       <td><?=$page_front?></td>
                       <td><input type="checkbox" name="front"<? if ($page['front']=="yes") { ?> checked<? }?>></td>
                   </tr>
                   <tr>
                       <td><?=$page_date?></td>
                       <td> <input type="text" name="date" value="<?=date("Y-m-d",strtotime($page['date']))?>"></td>
                   </tr>
                   <?				   
				   if ($images_store == 'rows') {
				       $i=1;					   
				       while ($i <= $images) {						   
				       ?>
                   <tr>
                       <td><?=$page_image?> <?=$i?>:</td>
                       <td>
                       <input type="file" name="image<?=$i?>">
                       <? if ($page["image$i"]!='') { ?>
                       <span>
                       &nbsp; 
                       <a href="../<?=$page["image$i"]?>" target="_blank"><img src="images/image.png" alt="" title="<?=$page_image_view?>" style="height:17px;"></a>
                       &nbsp;
                       <img src="images/delete.png" alt="<?=$page["id"]?>" num="<?=$i?>" class="DELIMAGE1" title="<?=$page_image_delete?>">
                       </span>
					   <? } ?>                       
                       </td>
                   </tr>
                       <?
				       $i++;
				       }
				   } else {
					   $images_ex = explode(",",$page['image1']);
					   $images_names_ex = explode(",",$page['image1_names']);
					   if (is_array($images_ex)) {
						   foreach($images_ex as $key=>$value) {
							   if ($value!='') {
								   $images_total = $key;
							   ?>
                   <tr>
                       <td><?=$page_image?> <?=$images_total?>:</td>
                       <td>
                       <input type="file" name="image<?=$images_total?>">
                       <input type="text" name="image_name<?=$images_total?>" value="<?=$images_names_ex[$key]?>">
                       &nbsp; 
                       <a href="../<?=$value?>" target="_blank"><img src="images/image.png" alt="" title="<?=$page_image_view?>" style="height:17px;"></a>
                       &nbsp;
                       <img src="images/delete.png" alt="<?=$page["id"]?>" num="<?=$key?>" class="DELIMAGE2" title="<?=$page_image_delete?>">
                       </td>
                   </tr>             
							   <? 
							   }
						   }						   
					   }
					   ?>
                       <input type="hidden" name="total_images_store" value="<?=(int)$images_total+1?>">
                   <tr>
                       <td><strong><?=$page_image_upload?></strong></td>
                       <td><input type="file" name="image<?=$images_total+1?>"></td>
                   </tr> 
                       <?
				   }
				   ?>
                   <?
				   if ($files_store == 'rows') {
				       $i=1;
				       while ($i <= $files) {
				       ?>
                   <tr>
                       <td><?=$page_file?> <?=$i?>:</td>
                       <td>
                       <input type="file" name="file<?=$i?>">
                       <? if ($page["file$i"]!='') { ?>
                       <span>
                       &nbsp; 
                       <a href="../<?=$page["file$i"]?>" target="_blank"><img src="images/pdf.png" alt="" title="<?=$page_file_view?>" style="height:17px;"></a>
                       &nbsp;
                       <img src="images/delete.png" alt="<?=$page["id"]?>" num="<?=$i?>" class="DELFILE1" title="<?=$page_file_delete?>">
                       </span>
					   <? } ?>
                       </td>
                   </tr>
                       <?
				       $i++;
				       }
				   } else {
					   $files_ex = explode(",",$page['file1']);
					   $files_names_ex = explode(",",$page['file1_names']);
					   if (is_array($files_ex)) {
						   foreach($files_ex as $key=>$value) {
							   if ($value!='') {
								   $files_total = $key;
							   ?>
                   <tr>
                       <td><?=$page_file?> <?=$files_total?>:</td>
                       <td>
                       <input type="file" name="file<?=$files_total?>">
                       <input type="text" name="file_name<?=$files_total?>" value="<?=$files_names_ex[$key]?>">
                       &nbsp; 
                       <a href="../<?=$value?>" target="_blank"><img src="images/pdf.png" alt="" title="<?=$page_file_view?>" style="height:17px;"></a>
                       &nbsp;
                       <img src="images/delete.png" alt="<?=$page["id"]?>" num="<?=$key?>" class="DELFILE2" title="<?=$page_file_delete?>">
                       </td>
                   </tr>             
							   <? 
							   }
						   }						   
					   }
					   ?>
                       <input type="hidden" name="total_files_store" value="<?=(int)$files_total+1?>">
                   <tr>
                       <td><strong><?=$page_file_upload?></strong></td>
                       <td><input type="file" name="file<?=$files_total+1?>"></td>
                   </tr> 
                       <?
				   }
				   ?>
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
			/*
		?>
        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$page_title2?></td>
        </tr>    
        <tr>
        	<td colspan="2"><input type="text" name="title2" class="TEXTINPUT" value="<?=$page['title2']?>"></td>
        </tr>    
		*/
		?>
        <tr>
        	<td><br><?=$page_content2?></td>
        </tr>
        <tr>    
            <td><textarea id="editor2" name="content2"><?=$page['content2']?></textarea></td>
        </tr>
        <?
		//}
		/*
		if ($set_template=='index') {
		?> 
        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$page_title3?></td>
        </tr>    
        <tr>
        	<td colspan="2"><input type="text" name="title3" class="TEXTINPUT" value="<?=$page['title3']?>"></td>
        </tr>    
        <tr>
        	<td><br><?=$page_content3?></td>
        </tr>
        <tr>    
            <td><textarea id="editor3" name="content3"><?=$page['content3']?></textarea></td>
        </tr>   
            <?
		}
		*/
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
  </div>
  <div class="FOOTER">© All rights reserved to Dreamax Ltd 2011</div>
</div>
</body>
</html>