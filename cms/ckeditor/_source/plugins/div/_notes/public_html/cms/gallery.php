<?
$table = "gallery";
include_once "../../includes/config.php";
include_once $includes_dir ."includes/sessions.php";
include_once $includes_dir ."includes/db.php";
include_once $includes_dir ."includes/auth.php";
include_once $includes_dir ."includes/database.php";
include_once $includes_dir ."includes/languages.php";
include_once $includes_dir ."includes/templates.php";
include_once $includes_dir ."includes/gallery.php";
include_once $includes_dir ."includes/functions.php";
include_once "include/languages.php";
$sql = "SELECT * FROM pages WHERE id = '{$_GET['id']}'";
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
	$(".CHECK").click(function() {
		if ($(this).is(":checked")) {
			$(this).parent().parent().css("background-color","#f0b9b9");
		} else {			
			$(this).parent().parent().css("background-color","#e8e8e8");
		}
	});
	
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




	CKEDITOR.replace( 'con1', {
			filebrowserBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor',
            filebrowserImageBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=image',
            filebrowserFlashBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=flash',	
			language: '<?=$_GET['lang']?>',
			height : '40px',
			toolbarStartupExpanded : false
			/*
			toolbar :
			[
				{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
				{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
				{ name: 'styles', items : [ 'Format','Font','FontSize' ] },
				{ name: 'colors', items : [ 'TextColor','BGColor' ] }						
			]
			*/	
	});	
	
	CKEDITOR.replace( 'con2', {
			filebrowserBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor',
            filebrowserImageBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=image',
            filebrowserFlashBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=flash',	
			language: '<?=$_GET['lang']?>',
			height : '40px',
			toolbarStartupExpanded : false
			/*
			toolbar :
			[
				{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
				{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
				{ name: 'styles', items : [ 'Format','Font','FontSize' ] },
				{ name: 'colors', items : [ 'TextColor','BGColor' ] }						
			]
			*/
	});

	
	
});
</script>
</head>

<body>
<div class="CONTAINER">
  <div class="TOP"><? include "include/top.php"; ?></div>
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
    <br><br><h1><?=$page['name']?></h1>
    <input type="hidden" name="id" value="<?=$_GET['id']?>">   
    <input type="hidden" name="lang" value="<?=$_GET['lang']?>"> 
    <table class="PTABLE">
        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$page_title1?></td>
        </tr>    
        <tr>
        	<td colspan="2"><input type="text" name="title1" class="TEXTINPUT" value="<?=$page['title1']?>"></td>
        </tr>   
    	<tr>
        	<td><br><?=$page_content1?></td>
        </tr>
        <tr>    
            <td><textarea id="edit1" name="con1"><?=$page['content1']?></textarea></td>
        </tr>
        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$page_title2?></td>
        </tr>    
        <tr>
        	<td colspan="2"><input type="text" name="title2" class="TEXTINPUT" value="<?=$page['title2']?>"></td>
        </tr>    
        <tr>
        	<td><br><?=$page_content2?></td>
        </tr>
        <tr>    
            <td><textarea id="edit2" name="con2"><?=$page['content2']?></textarea></td>
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
					$table = 'pages';
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
					$table = 'gallery';
					?>
                  </select>
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
        	<td colspan="2"><input type="text" name="meta_key" class="TEXTINPUT" value="<?=$page['meta_key']?>"></td>
        </tr>
        <tr>
        	<td colspan="2" class="PTITLE"><br><?=$page_meta_desc?></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="text" name="meta_desc" class="TEXTINPUT" value="<?=$page['meta_desc']?>"></td>
        </tr>
    </table>    
  	<br>    
    בחר קבצים להעלאה: <input type="file" name="upload[]" multiple><input type="submit" name="add" value="<?=$add_images_text?>" class="ABTN">

    <br><br>
    <div class="TABLE">
    	<table>
        	<?
			switch($_GET['lang']) {
				case('he'):
					?>            
             <tr class="TRH">
            	<th class="TH1 THB">סימון</th>
                <th class="TH5 THB">מיקום</th>
                <th class="TH2 THB">שם התמונה</th>
                <th class="TH2 THB">תוכן</th>
                <th class="TH4 THB">גודל התמונה</th>
                <th class="TH5 THB">שם קובץ בשרת</th>
                <th class="TH5 THB">תמונה</th>
                <th class="TH5 THB">הסתרה</th>
                <th class="TH5 THB">הצגה בראשי</th>
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
			$sql   = "SELECT * FROM $table WHERE sub = '{$_GET['id']}' ORDER BY sort ASC";			
			$query = $database->query($sql);
			while ($row=mysql_fetch_assoc($query)) {
				$i++;
				$add = '';
				include "include/grow.php";				          
			
			}
			?>
            <input name="total" type="hidden" value="<?=$i?>">            
            <tr class="TDBG2">
            	<td></td>
            	<td colspan="9"></td>
            </tr>
             <tr class="TDBG2">
            	<td></td>
            	<td colspan="9"><input type="submit" name="save" value="<?=$save_text?>" class="ABTN"> <input type="submit" name="delete" value="<?=$delete_text?>" class="ABTN"></td>
            </tr>
        </table>
    </div>
    </form>  
  </div>
  <div class="FOOTER">© All rights reserved to Dreamax Ltd 2011</div>

</div>
</body>
</html>