<?
include_once "../../includes/sessions.php";
include_once "../../includes/db.php";
include_once "../../includes/database.php";
include_once "../../includes/languages.php";
include_once "../../includes/form.php";
include_once "../../includes/config.php";
include_once "../../includes/functions.php";

include_once "config.php";
include_once "functions.php";
include_once "forms.php";

$page = $database->fetch("SELECT * FROM pages WHERE template LIKE 'index.php%' AND language = '$lang'");
$global = $database->fetch("SELECT * FROM global WHERE language = '$lang'");
$global_txt = explode("@@@",$global['custom']);

$_SERVER['REQUEST_URI'] = urldecode($_POST['href']);
include_once "handle_params.php";
ob_start();
?>
	<div class="row-fluid">
    
    <?
	/*
	if (!empty($params)) {
	?>
	 <div class="search-pannel seachslot">
     	<?
		foreach ($params as $value) {
			if ($value!='') {
				$link = HandleSearch($value,$params);
			?>
    	<a href="<?=$link?>" class="seachslotb"><div class="seachslotx">X</div><?=str_replace("_"," ",$value)?></a>
        	<?
			}
		}
		?>
    </div>
    <?
	}
	?>
    
	<!--Search Panel-->
	<div class="search-pannel search-pannel_h sapn12">
    	<div class="search-inside">
        	<div class="search-more"></div>
        	<form class="jNice no-margin clearfix">
                <ul class="search-options-col clearfix">
                	<?
					$counter1 = 1;
					$sql = "SELECT * FROM categories WHERE sub = 0  AND front = 'yes' ORDER BY sort DESC";
					$query = $database->query($sql);
					while($row=mysql_fetch_assoc($query)) {
						
						$array1[]=$row;
						$counter2 = 0;
						unset($array2,$array2_ids,$all_links);
						### This is PRE-checking if all categories already selected
						$sql2 = "SELECT * FROM categories WHERE sub = '{$row['id']}' AND front = 'yes' AND name!='' ORDER BY sort DESC";
						$query2 = $database->query($sql2);						
						while($row2=mysql_fetch_assoc($query2)) {
							
							$row2['name'] = $database->mysql_prep($row2['name']);
							
							if (!in_array(trim(str_replace(" ","_",$row2['name'])),$params)) {
		
								$array2[]=$row2;
								$array2_ids[]=$row2['id'];
							}
							
							if (!in_array($row2['id'],$array2_ids)) {
								$array2_exists[] = $row2;						
								$counter3=0;
								//unset($array3,$array3_ids);
								$sql3 = "SELECT * FROM categories WHERE sub = '{$row2['id']}' AND front = 'yes' ORDER BY sort DESC";
								
								$query3 = $database->query($sql3);								
								while($row3=mysql_fetch_assoc($query3)) {
									if (!in_array(str_replace(" ","_",$row3['name']),$params)) {
										$array3[$row2['id']][]=$row3;
										$array3_ids[$row2['id']][]=$row3['id'];										
																	
									}
									$counter3++;
									$array3_count[$row2['id']] = $counter3;
								}
								
							}
							$counter2++;
						}
						foreach ($array2_exists as $value) {
							if (in_array(str_replace(" ","_",$value['name']),$params) && !empty($array3)) {	
								$array2 = $array3[$value['id']];
								$counter2 = $array3_counter[$value['id']];
								$level3 = 1;
							}
						}
						
						if  (count($array2)==0
							|| 
							(count($array2)<$counter2 && $array3[0]['id'] != $array2[0]['id'] && $row['type']==0)) 
						{
							unset($array3,$array2,$array3_ids,$array2_ids);
							continue;
						}
						
						
						
						### END

					
					?>
                    <li class="options-col<? if ($counter1==5) {?> options-col2<? } ?><? if ($row['name']=='תוספות') { ?> options-col4<? } ?>">
                        <h3><?=$row['name']?></h3>
                        <ul class="options-list">
						<?
					    foreach ($array2 as $key=>$value) {
							
							if ($key>3 && $row['name']!='תוספות' || $row['name']=='תוספות' && $key>8) { 
								break; 
							}		
											
                            $link = HandleSearch(str_replace("\\","",$value['name']),$params);
                            $all_links[] = str_replace("\\","",$value['name']);
                            ?>                            
                        	<li class="dark-gray dark-gray3"><a href="<?=$link?>"><?=$value['name']?></a></li>
                            <?
                        }
                        //$all_links = implode("-",$all_links);
                        //$link = HandleSearch($all_links,$params);
						$link = HandleSearchAll($all_links,$params);
                        unset($array3,$array2,$array3_ids,$array2_ids,$level3);
                        if ($row['type']=='0') {
                        ?>
                        <li class="dark-gray dark-gray4"><a href="<?=$link?>">בחר הכל</a></li>
                        <li class="dark-gray dark-gray4 dark-click" id="<?=$row['id']?>" url="<?=$url?>">בחירה מרובה..</li>
                        <?
                        }
                        ?>
                        </ul>
                    </li>
                    <?
					$counter1++;
					}
					?>
                </ul>
            </form>
        </div>
        <?
		if ($counter1>5) {
		?>
		 <div class="search-submitter">
			<strong class="search-submitter-open">חיפוש מורחב</strong>
			<strong class="search-submitter-close">סגור חיפוש מורחב</strong>
		</div>
		<?
		}
		?>
    </div>
	</div>
    <!--/Search Panel-->    

   ?>
    
    <!--Search Result-->
	<div class="row-fluid">
	<div class="result-pannel span12">
    	<ul class="clearfix result-land" id="resultLand">
        	<?
			$url_explode = explode("-",$database->mysql_prep(mb_substr($_SERVER['REQUEST_URI'],1)));
			$url_implde = str_replace("_"," ",urldecode(implode("','",$url_explode)));	
			if ($url_implde!='') {
				$sql = "SELECT * FROM categories WHERE name in ('$url_implde') AND hide !='yes' ORDER BY sub DESC";
				$query =$database->query($sql);
				while($row=mysql_fetch_assoc($query)) {
						$url_sql[$row['sub']][] = "(categories = '{$row['id']}' OR categories like '{$row['id']},%' OR categories LIKE '%,{$row['id']}' OR categories LIKE '%,{$row['id']},%')";
				}
				
				if(!empty($url_sql)) {
					foreach ($url_sql as $value) {
						$search[] = '('.implode(" OR ",$value).')';
					}										
				}
				if (!empty($search)) {
					$search = ' AND '.	implode(" AND ",$search);
				}
			}
			$sql = "SELECT * FROM products WHERE sub != 0 AND hide !='yes' AND name!='' $search ORDER BY sort DESC";
			$query = $database->query($sql);
			while($row=mysql_fetch_assoc($query)) {
				$link = GetLink($row);
				$image = mysql_fetch_assoc($database->query("SELECT image FROM gallery WHERE sub = '{$row['id']}' AND front = 'yes'"));
			?>
            <li class="result-item">
            	<div class="result-padder">
                	<div class="result-content">
                    	<h4 class="title-bar"><a href="<?=$link?>" target="_blank"><?=$row['name']?></a></h4>
                        <div>
                        	<div class="result-image">
                        	<a href="<?=$link?>" target="_blank"><img src="<?=$image['image']?>" alt="" class="thumb" /></a>
                            </div>
                        	<p><?=$row['short_content']?></p>
                            <div class="clearfix">
                            	<a href="<?=$link?>" class="result-item-btn" target="_blank">פרטים נוספים</a>
                                <span class="clearfix item-chooser"><input type="checkbox" value="<?=$row['id']?>" class="CHECKBOX_C" /> סמן להשוואה</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?
			}			
			?>
        </ul>
        <?
		if ($database->num_rows($sql)==0) {
		?>
        <h3 style="text-align:center">לא נמצאו תוצאות</h3>
        <?
		}
		?>
        
        <a href="javascript:void()" class="page-scroller">&nbsp;</a>
        
    </div>
    <br style="clear:both;">
   
    
    <!--/Search Result-->
    */
	include_once "search_checked.php";
	include_once "categories.php";
	include_once "search_results.php";
	?>
	</div>
	
	
	
   
<script type="text/javascript">

if ( !$.browser.msie ) {
	
	$(".search-inside").on("click",".EFCLOSE",function(){
		 $(".search-more").hide(); 
	});

	$(".dark-gray a").each(function(){
		var href = $(this).attr("href");
		$(this).attr("href","javascript:void()");
		$(this).attr("url",href);
	});
	$(".seachslotb").each(function(){
		var href = $(this).attr("href");
		$(this).attr("href","javascript:void()");
		$(this).attr("url",href);
	});
	
	$(".dark-gray a,.seachslotb").on("click",function() {
		var href = $(this).attr("url");
		$.post("includes/push_state.php",{ href: href},function(data) {
			var obj = jQuery.parseJSON(data);
			History.replaceState({state:3,rand:Math.random()}, obj.title , href);			
			$("#pjax-container").html(obj.data);
			
		});
		
	});
}
$('#resultLand').imagesLoaded(function() {
	$('#resultLand li').wookmark({
		autoResize: true,
		container: $('#resultLand'),
		offset: 0,
		itemWidth: 255
	});
});
</script>
<script type="text/javascript" src="js/script.js"></script>
<?
$data = ob_get_clean();
$title = ($page['meta_title']=='') ? $page['title1'] : $page['meta_title'];
$title.= str_replace("_"," ",' '.implode(" ",$params));

$data = str_replace("\'","'",$data);
$title = str_replace("\'","'",$title);


//$data = trim(str_replace(array('"',"\n","\r","\t"),array('\"','','',""),$data));
//$data = json_encode($data);
//$json_object['data'] = $data;
//$json_object['title'] = $title.$global['perm_meta_title'];
//echo json_encode($json_object);

$data = trim(str_replace(array("\\",'"',"\n","\r","\t"),array("\\\\",'\"','','',""),$data));
echo '{"data":"'.$data.'","title":"'.$title.$global['perm_meta_title'].'"}';