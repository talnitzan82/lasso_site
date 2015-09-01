<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', '1');


$headers = getallheaders();
if($headers['X-PJAX'] == 'true') {
	include "includes/pjax_index.php";
} else {

?>
<? include_once "includes/requires.php"; ?>
<?
$page = $database->fetch("SELECT * FROM pages WHERE template LIKE 'index.php%' AND language = '$lang'");
$global = $database->fetch("SELECT * FROM global WHERE language = '$lang'");
$global_txt = explode("@@@",$global['custom']);

$url=mb_substr(urldecode($_SERVER['REQUEST_URI']),1);
$params=explode("-",$url);
foreach ($params as $value) {
	//$page['meta_title'] .= $value;
}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="not-ie" lang="en">
<!--<![endif]-->
<head>
<!-- Basic meta tags -->
<? include "includes/meta.php"; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--[if (gte IE 9)|!(IE)]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<![endif]-->

<!-- CSS
================================================== -->
<link href="css/bootstrap.css" rel="stylesheet" />
<link href="css/template.css" rel="stylesheet" />

<!--[if lt IE 9]>
	<script src="js/shiv.js"></script>
<![endif]-->
<!-- JS
================================================== --> 
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/imagesloaded.js"></script>
<script type="text/javascript" src="js/wookmark.js"></script>
<script type="text/javascript" src="js/jquery.history.js"></script>
<script type="text/javascript">

//$(document).pjax('.seachslotb,.dark-gray a', '#pjax-container')
//$.pjax.defaults.scrollTo = false;



$(document).ready(function() {	


	// Establish Variables
	var
		State = History.getState(),
		$log = $('#log');

	// Log Initial State
	History.log('initial:', State.data, State.title, State.url);

	// Bind to State Change
	History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
		// Log the State
		var State = History.getState(); // Note: We are using History.getState() instead of event.state
		History.log('statechange:', State.data, State.title, State.url);
	});
	
	$(".dark-gray").on("click",function() {
		alert(1);
		History.replaceState({state:3,rand:Math.random()}, "State 3", "?state=3");
		
	});		
	
	// Call the layout function.
	$('#resultLand').imagesLoaded(function() {
		$('#resultLand li').wookmark({
			autoResize: true,
			container: $('#resultLand'),
			offset: 0,
			itemWidth: 255
		});
	});
	
	
	/*
	$(document).on("click",function() {
		$('#resultLand li').eq(1).fadeOut(300,function() { 
			$(this).remove(); 
			//$('#resultLand li').trigger('refreshWookmark');
			$('#resultLand li').wookmark({
				autoResize: true,
				container: $('#resultLand'),
				offset: 0,
				itemWidth: 255,
				onLayoutChanged: undefined
			});
		});		
		
	});
	
	/*
	var options = {
      autoResize: true, // This will auto-update the layout when the browser window is resized.
      container: $('#tiles'), // Optional, used for some extra CSS styling
      offset: 9, // Optional, the distance between grid items
      flexibleWidth: 210 // Optional, the maximum width of a grid item
    };
    var handler = $('#resultLand li');
    $('#resultLand').imagesLoaded(function() {
      // Prepare layout options.
      // Get a reference to your grid items.
      // Call the layout function.
      handler.wookmark(options);
    });
	*/
	

});
</script>

<script type="text/javascript" src="js/script.js"></script>

</head>
<body> 

<header>

	<!--Mainnav-->
    <div class="nav_outer">
    	<div class="inside clearfix">
        	<form action="<?=$root?>חיפוש/" method="get" class="search-site no-margin">
            	<div class="clearfix">
                	<input type="submit" value="" class="submit_btn" />
                    <input type="text" name="search" value="" class="keywords" />
                </div>
            </form>
        	<ul class="main_nav">
                <li class="logo"><a href="<?=$root?>">&nbsp;</a></li>
            	<?
				include "includes/menu.php";
				?>
            </ul>
        </div>
    </div>
    <!--/Mainnav-->

	<!--Main slider-->
	<div id="top_caurosel" class="carousel slide">
        <!-- Carousel items -->
        <div class="carousel-inner">
        	<?
			$i=0;
			$sql = mysql_fetch_assoc($database->query("SELECT * FROM pages WHERE template LIKE 'gallery%'"));
			$sql = "SELECT * FROM gallery WHERE sub = '{$sql['id']}' AND hide!='yes'";
			$query=$database->query($sql);
			while($row=mysql_fetch_assoc($query)) {
			?>
            <div class="<? if ($i==0) {?>active <? } ?>item">
                <img src="<?=$row['image']?>" alt="<?=$row['name']?>" />
                <h3 class="slide-caption"><?=$row['name']?></h3>
            </div>
            <?
			$i++;
			}
			?>
        </div>
        <!-- Carousel nav -->
        <div class="arrow_holder">
            <a class="carousel-control left" href="#top_caurosel" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#top_caurosel" data-slide="next">&rsaquo;</a>
        </div>
    </div>
    <!--/Main slider-->
    
</header>

<section class="content" id="pjax-container">
	<?
	if ($params[0]!='') {
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
	<div class="search-pannel">
    	<div class="search-inside">
          	<div class="search-more"></div>
        	<form class="jNice no-margin clearfix">
                <ul class="search-options-col clearfix">
                	<?
					$counter1 = 1;
					$sql = "SELECT * FROM categories WHERE sub = 0 AND hide !='yes' AND front = 'yes' ORDER BY sort DESC";
					$query = $database->query($sql);
					while($row=mysql_fetch_assoc($query)) {
						
						$array1[]=$row;
						$counter2 = 0;
						unset($array2,$array2_ids,$all_links);
						### This is PRE-checking if all categories already selected
						$sql2 = "SELECT * FROM categories WHERE sub = '{$row['id']}' AND hide !='yes' AND front = 'yes' AND name!='' ORDER BY sort DESC";
						$query2 = $database->query($sql2);						
						while($row2=mysql_fetch_assoc($query2)) {
							
							if (!in_array(str_replace(" ","_",$row2['name']),$params)) {
								$array2[]=$row2;
								$array2_ids[]=$row2['id'];
							}
							
							if (in_array($row2['id'],$array2_ids)) {						
								
								$counter3=0;
								unset($array3,$array3_ids);
								$sql3 = "SELECT * FROM categories WHERE sub = '{$row2['id']}' AND hide !='yes' AND front = 'yes' ORDER BY sort DESC";
								$query3 = $database->query($sql3);								
								while($row3=mysql_fetch_assoc($query3)) {
									if (!in_array(str_replace(" ","_",$row3['name']),$params)) {
										$array3[$counter2][]=$row3;
										$array3_ids[$counter2][]=$row3['id'];
																	
									}
									$counter3++;
								}
							}
							$counter2++;
						}
						if  (count($array2)==0
							|| 
							(count($array2)<$counter2 && $row['type']==0)) 
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
                        foreach ($array2 as $value) {						
                            $link = HandleSearch($value['name'],$params);
                            $all_links[] = $value['name'];
                            ?>                            
                        	<li class="dark-gray dark-gray3"><a href="<?=$link?>"><?=$value['name']?></a></li>
                            <?
                        }
                        //$all_links = implode("-",$all_links);
                        //$link = HandleSearch($all_links,$params);
						$link = HandleSearchAll($all_links,$params);
                        unset($array3,$array2,$array3_ids,$array2_ids);
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
                <?
				if ($counter1>5) {
				?>
                 <div class="search-submitter">
                    <strong class="search-submitter-open">חיפוש מורחב</strong>
                    <strong class="search-submitter-close">סגור חיפוש מורחב</strong>
              	</div>
                <?
				}
				/*
                <div class="search-submitter">
                	<input type="text" value="" class="submit-options" />
                    <a href="#"><strong>לאבק בזכות</strong></a>
                </div>
				*/
				?>
            </form>
        </div>
    </div>
    <!--/Search Panel-->    
   
    
    <!--Search Result-->
	<div class="result-pannel">
    	<ul class="clearfix result-land" id="resultLand">
        	<?
			$url_explode = explode("-",$database->mysql_prep(mb_substr($_SERVER['REQUEST_URI'],1)));
			$url_implde = str_replace("_"," ",urldecode(implode("','",$url_explode)));	
			if ($url_implde!='') {
				$sql = "SELECT * FROM categories WHERE name in ('$url_implde') AND hide !='yes'";
				$query =$database->query($sql);
				while($row=mysql_fetch_assoc($query)) {
						$url_sql[] = "(categories = '{$row['id']}' OR categories like '{$row['id']},%' OR categories LIKE '%,{$row['id']}' OR categories LIKE '%,{$row['id']},%')";
				}
				
				if(!empty($url_sql)) {
					
					$search = "AND ".implode(" AND ",$url_sql);
										
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
    
    <? /* <a href="javascript:void(0)" class="more-loader">&nbsp;</a> */ ?>
    
    <!--/Search Result-->
    
</section>

<footer>
	<? include "includes/footer.php"; ?>
</footer>
<div class="COMP">
<form action="" method="post">
	<button type="submit" name="compareb"></button>
</form>	
</div>
</body>
</html>
<?
}
?>