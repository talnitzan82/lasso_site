    <!--Search Result-->
	<div class="row-fluid">
	<div class="result-pannel span12">
    	<ul class="clearfix result-land" id="resultLand">
        	<?
			$url_explode = explode("-",$database->mysql_prep(mb_substr($_SERVER['REQUEST_URI'],1)));
			$url_implde = str_replace("_"," ",urldecode(implode("','",$url_explode)));	
			if ($url_implde!='') {
				$sql = "SELECT * FROM categories WHERE name in ('$url_implde')  ORDER BY sub DESC";				
				$query =$database->query($sql);
				while($row=mysql_fetch_assoc($query)) {
						$url_sql[$row['sub']][] = "(categories = '{$row['id']}' OR categories like '{$row['id']},%' OR categories LIKE '%,{$row['id']}' OR categories LIKE '%,{$row['id']},%')";
				}
				
				if(!empty($url_sql)) {
					foreach ($url_sql as $value) {
						$search[] = '('.implode(" AND ",$value).')';
					}										
				}
				if (!empty($search)) {
					$search = ' AND '.	implode(" AND ",$search);
				}
			}
			//$_POST['ids'] = str_replace('\\"',"",$_POST['ids']);
			$_POST['ids'] = str_replace(array('\\"','"'),array("",""),$_POST['ids']);
			if ($_POST['ids']!='') {
				$ids = explode(",",$database->mysql_prep($_POST['ids']));
				if (!empty($ids)){
					$search .= ' AND id NOT IN ('.implode(",",$ids).')'; 	
				}
			}

			$limit = 20;
			/// $p NO NEEDED ANY MORE SINCE I SEND $_POST['ids'] WHICH ONES ARE NOT REQUIRED
			/*
			$_POST['p'] = str_replace(array("\\",'"'),array("",""),$_POST['p']);
			$p     = ($_POST['p']=='') ? 0 : $_POST['p'] * $limit;
			*/
			$total = $database->num_rows("SELECT * FROM products WHERE sub != 0 AND hide !='yes' AND name!='' $search ORDER BY sort DESC, RAND() ");

			$sql   = "SELECT * FROM products WHERE sub != 0 AND hide !='yes' AND name!='' $search ORDER BY sort DESC, RAND() LIMIT 0,$limit";
			$query = $database->query($sql);
			//echo $sql;
			while($row=mysql_fetch_assoc($query)) {
				$link = GetLink($row);
				$image = mysql_fetch_assoc($database->query("SELECT image FROM gallery WHERE sub = '{$row['id']}' AND front = 'yes'"));
			?>
            <li class="result-item" itemid="<?=$row['id']?>">
            	<div class="result-padder">
                	<div itemscope itemtype="http://schema.org/Product" class="result-content">
                    	<h4 class="title-bar"><a href="<?=$link?>" target="_blank"><span itemprop="name"><?=$row['name']?></span></a></h4>
                        <div>
                        	<div class="result-image">
                        	<a href="<?=$link?>" target="_blank"><img itemprop="image" src="<?=$image['image']?>" alt="" class="thumb" /></a>
                            </div>
                        	<p itemprop="description"><?=$row['short_content']?></p>
                            <div class="clearfix">
                            	<a itemprop="url" href="<?=$link?>" class="result-item-btn" target="_blank">פרטים נוספים</a>
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

    <a href="javascript:void(0)" class="more-loader">&nbsp;</a>

    <!--/Search Result-->
    <a href="<?=($total > $limit*$p) ? $p+1 : ''?>" class="next_infinite">&nbsp;</a>
    <span class="infinite_url" url="<?=urldecode(implode("-",$url_explode))?>" style="display:none;"></span>
</div>    

<script>
var href_i  = $(".infinite_url").attr("url");
var p     = 0;
var new_p = 1;
$(window).scroll(function() {
   if($(window).scrollTop()+200 >= $("#resultLand").height() && (p < new_p || p==0)) {
	   p = new_p;
	   $(".more-loader").css("display","block");
	   var items_counter = 0;
	   var itemsids = new Array();
	   $(".result-item").each(function(){
		   itemsids[items_counter] = $(this).attr("itemid");
		   items_counter++;
		   //itemsids.push($(this).attr("itemid"));
	   });
	   $.ajax({
		  type: "POST",
		  url: "includes/push_state.php",
		  data: { p: '"'+p+'"' ,href: '/'+href_i+'' ,ids: '"'+itemsids.join(",")+'"' }
		}).done(function( html ) {		
			
			
			$(".more-loader").css("display","none");
			html = jQuery.parseJSON(html);
			html = $(html.data);
			var resultLand = html.find(".result-item");
			resultLand.each(function(){
				$(this).css("opacity",0);
			});
			$("#resultLand").append(resultLand);
			
			new_p   = html.find(".next_infinite").attr("href");
			href_i  = html.find(".infinite_url").attr("url");
			
	
			$('#resultLand li').wookmark({
				autoResize: true,
				container: $('#resultLand'),
				offset: 0,
				itemWidth: 255
			});
			
			$('#resultLand').imagesLoaded(function() {
				$('#resultLand').trigger('refreshWookmark');
				$('#resultLand .result-item').css("opacity","1")			

			});
				
		});
   }
});

</script>