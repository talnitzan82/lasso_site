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

			$sql = "SELECT * FROM products WHERE sub != 0 AND hide !='yes' AND name!='' $search ORDER BY sort DESC, RAND()";
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
    <? /* <a href="javascript:void(0)" class="more-loader">&nbsp;</a> */ ?>
    
    <!--/Search Result-->
    
	</div>