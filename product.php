<? include_once "includes/requires.php"; ?>
<? 
include_once "includes/Mobile_Detect.php"; 
$detect = new Mobile_Detect;
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
<?
$image = mysql_fetch_assoc($database->query("SELECT `image` FROM gallery WHERE sub = '{$page['id']}' AND logo = 'yes' LIMIT 1"));
?>
<meta property="og:image" content="https://www.lasso.co.il/<?=$image['image']?>">
<!--[if (gte IE 9)|!(IE)]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<![endif]-->

<!-- CSS
================================================== -->
<link href="<?=$root?>css/bootstrap.css" rel="stylesheet" />
<link href="<?=$root?>css/bootstrap-responsive.min.css" rel="stylesheet" />
<link href="<?=$root?>css/template.css" rel="stylesheet" />
<link href="<?=$root?>css/jNice.css" rel="stylesheet" />

<link rel="stylesheet" href="<?=$root?>css/jquery.bxslider.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?=$root?>css/touchTouch.css" type="text/css" media="all" />

<!--[if lt IE 9]>
	<script src="js/shiv.js"></script>
<![endif]-->
<!-- JS
================================================== -->
<!-- jQuery -->
<script type="text/javascript" src="<?=$root?>js/jquery-1.8.3.min.js"></script> 
<script type="text/javascript" src="<?=$root?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?=$root?>js/imagesloaded.js"></script>

<script type="text/javascript" src="<?=$root?>js/wookmark.js"></script>
<script type="text/javascript">
    $(document).ready(new function() {
      // Call the layout function.
      $('#resultLand li').wookmark({
        autoResize: false,
        container: $('#resultLand'),
        offset: 0,
        itemWidth: 255
      });
    });
</script>

<!-- Box Slider -->
<script type="text/javascript" src="<?=$root?>js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?=$root?>js/jquery.fitvids.js"></script>
<script defer src="<?=$root?>js/jquery.bxslider.js"></script>
<script defer src="<?=$root?>js/touchTouch.jquery.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		
		$(".touchthumb").touchTouch();
		
		$("#bx-pager a").hover(function(){
			$(this).click();
		}, function () {
		});
		
		$('.bxslider').bxSlider({
		  	pagerCustom: '#bx-pager',
			speed: 200
		});
	});
</script>
<script>
$(document).ready(function(){

	var slength = $(".bottom-series li").length;
	var si = 0;
	
	$(".bottom-sl-b").on("click",function(){

		if (slength>5) {
			
			if ($(this).hasClass("bottom-sl-r")) {
				if (si < slength-5) {
					$(".bottom-series li").animate({ right :"-=183px"},1000);
					si++;
				}			
			} else {				
				if (si>0) {				
					$(".bottom-series li").animate({ right :"+=183px"},1000);
					si--;
				}				
			}			
	
		}		
	});	
});
</script>

<script type="text/javascript" src="<?=$root?>js/script.js"></script>
</head>
<?
$image = mysql_fetch_assoc($database->query("SELECT `image`,`repeat` FROM gallery WHERE sub = '{$page['id']}' AND background = 'yes' LIMIT 1"));
?>
<body class="subbody loading"<? if ($image['image']!='') {?> style="background-image:url(<?=$image['image']?>); <? if ($image['repeat']=='yes') { ?> background-repeat: repeat;<? } else { ?> background-repeat: no-repeat; background-size: 100% 100%;"<? } } ?>>

<div class="container-fluid">
    <div class="row-fluid">
    
        <div class="sub-content">
            <div class="span12" style="border-bottom:1px solid #cdcdcd;margin-bottom:25px; ">
            
                <div class="BACKL"><a href="<?=$root?>" class="BACKMAIN">חזרה ללאסו &rsaquo;&rsaquo;</a></div>
                <div class="row-fluid">
            		<div class="span3"></div>
                    <div class="span6">
                        <?
                        $image = mysql_fetch_assoc($database->query("SELECT image,name FROM gallery WHERE sub = '{$page['id']}' AND logo = 'yes' LIMIT 1"));
						$alt =($image['name']=='') ? $page['name'] : strip_tags($image['name']);
                        ?>
                        <span class="sub-button<?=($image['image']!='') ? ' sub-button2' : ''?>">
                        	<span><?=($image['image']!='') ? '<img src="'.$root.$image['image'].'" alt="'.$alt.'">' : $page['name']?>
                            </span>
                        </span>
                    </div>
                	<div class="span3"></div>                
                </div>                
            </div>       
        
        
            <div class="subcontent clearfix">
            
            
            <div class="row-fluid">
            
            
            
                <div class="slide-pannel span6">
                    
                    <div class="carousel-wrapper">
                        <ul class="bxslider">
                          <?
                          $sql = "SELECT * FROM gallery WHERE sub = '{$page['id']}' AND hide!='yes' ORDER BY sort DESC";
                          $query = $database->query($sql);
                          while($row=mysql_fetch_assoc($query)) {
                          ?>
                          <li><a href="<?=$row['image']?>" class="touchthumb"><img src="<?=$row['image']?>" alt="<?=($row['name']=='') ? $page['name'] : $row['name']?>" width="440" height="493" /></a></li>
                          <?
                          }
                          ?>
                        </ul>
                        <div id="bx-pager" class="clearfix">
                          <?
                          $i=0;
                          $sql = "SELECT * FROM gallery WHERE sub = '{$page['id']}' AND hide!='yes' ORDER BY sort DESC";
                          $query = $database->query($sql);
                          while($row=mysql_fetch_assoc($query)) {
							  if (file_exists($row['image'])) {
                          ?>
                          <a data-slide-index="<?=$i?>" href=""><img src="<?=$row['image']?>" alt="<?=($row['name']=='') ? $page['name'] : $row['name']?>"/></a>
                          <?
							  }
                          $i++;
                          }
                          ?>
                        </div>
                    </div>
                    
                    <div class="slide-bottom-info">
                        <h4>פרטים</h4>
                        <div>
                            <?
                            if ($page['area']!='') {
                            ?>
                            <strong>איזור:</strong> <?=$page['area']?><br />
                            <?
                            }
                            if ($page['address']!='') {
                            ?>
                            <strong>כתובת:</strong> <?=$page['address']?><br />
                            <?
                            }
                            if ($page['contact']!='') {
                            ?>
                            <strong>איש קשר:</strong> <?=$page['contact']?><br />
                            <?
                            }
                            if ($page['phone']!='') {
                                $phone = explode("/",$page['phone']);
                            ?>
                            <strong>טלפון:</strong> 
                                <?
                                foreach($phone as $value) {
                                    $value = trim($value);
                                    if ($value!='') {
                                        if ( $detect->isMobile() ) {
                                        ?>
                                        <a href="tel:<?=$value?>">
                                        <?
                                        }
                                        ?>
                                        <?=$value?>
                                        <?
                                        if ( $detect->isMobile() ) {
                                        ?>
                                        </a>
                                        <?
                                        }
                                    }
                                }
                            ?>
                            <br />
                            <?
                            }
                            if ($page['website']!='') {
                            ?>
                            <strong>אתר:</strong> <a href="<?=$page['website']?>" target="_blank"><?=$page['website']?></a> <br />
                            <?
                            }
                            if ($page['facebook']!='') {
                            ?>
                            <strong>עמוד פייסבוק:</strong> <a href="<?=$page['facebook']?>" target="_blank">לחץ כאן</a> 
                            <?
                            }
                            ?>
                        </div>
                    </div>
                    <?
                    if ($page['content2']!='') {
                    ?>
                    <a href="#" class="map-trigger-link">&nbsp;</a>
                    <?
                    }
                    ?>
                  </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                <div class="info-pannel span6">
                    <div class="info-desk">
                        <?=$page['content1']?>
                    </div>
                    
                    <div class="subwhite-box">
                        <h4>מה כלול?</h4>
                        <?
                        $categories = explode(",",$page['categories']);
                        ?>
                        <form action="#" class="jNice no-margin clearfix">
                            <ul class="search-options-col subwhite-checks clearfix options-list">
                                <?
                                $sql   = "SELECT * FROM `categories` WHERE sub = '0' AND hide!='yes' ORDER BY sort ASC";
                                $query = $database->query($sql);
                                while ($row=mysql_fetch_assoc($query)) {
									 $sql2   = "SELECT * FROM `categories` WHERE name!='' AND sub = '{$row['id']}' AND hide!='yes' ORDER BY sort ASC";
                                     $query2 = $database->query($sql2);
                                     while ($row2=mysql_fetch_assoc($query2)) {
                                        if (in_array($row2['id'],$categories)) {	
											$cats[] = $row2['name'];
										}
									 }
								}
								if (is_array($cats)) {
									foreach ($cats as $key=>$val) {
								    ?>
									<li class="dark-gray dark-gray2" style="width:150px; float:right;"><span class="CHECKBOX CHECKBOX2"></span><?=$val?></li>
									<?
									}
								}
                                ?>                        
                            </ul>
                        </form>
                    </div>
                    
                    <div class="clearfix">
                        <div class="fb-place">
                            <?
                            /*
                            <iframe src="includes/facebook.php" frameborder="0" scrolling="no" style="width:120px; height:60px; overflow:hidden;"></iframe>             
                            */
							
                            ?>
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=214300028695618";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                            <div class="fb-like" data-send="false" data-layout="standard" data-width="450" data-show-faces="false" data-colorscheme="light" data-action="like"></div>       
                        </div>
                        
                        <a href="javascript:void()" onClick="window.open('https://www.facebook.com/sharer.php?u=https://<?=$_SERVER['SERVER_NAME']?><?=urldecode($_SERVER['REQUEST_URI'])?>','Share Lasso','toolbar=no,width=500,height=200,left=500,top=200,status=no,scrollbars=no,resize=no');return false" target="_blank" class="fb-like-plc"><img src="<?=$root?>img/fb-btn.gif" alt="שתף בפייסבוק" /></a>
                        <div class="SENDCONT">
                        <? include "includes/send-to-friend.php"; ?>
                        </div>
                  </div>
                </div>
            </div>
            
            </div>
            
            
            
            
            
            <div class="sub-bottom-line">
                <h4 class="bottom-title">המלצות נוספות</h4>
                <div class="bottom-sl-b bottom-sl-r"></div>
                <div class="bottom-sl-b bottom-sl-l"></div>
                <div class="bottom-seris-con">
                <div class="bottom-seris-con2">
                    <ul class="bottom-series clearfix">           
                        <?
                        if ($categories[0]!='') {
                            $sql = "SELECT * FROM categories WHERE id in (".implode(",",$categories).") AND hide !='yes'";
                            $query=$database->query($sql);
                            while($row=mysql_fetch_assoc($query)) {
                                    $url_sql[] = "(categories = '{$row['id']}' OR categories like '{$row['id']},%' OR categories LIKE '%,{$row['id']}' OR categories LIKE '%,{$row['id']},%')";
                            }
                            
                            if(!empty($url_sql)) {
                                
                                $search = "AND ".implode(" OR ",$url_sql);
                                                    
                            }
                        }
                        $i=0;;
                        $sql = "SELECT * FROM products WHERE id != '{$page['id']}' AND sub != 0 AND hide !='yes' AND name!='' $search ORDER BY RAND() LIMIT 5";
                        $query=$database->query($sql);
                        while($row=mysql_fetch_assoc($query)) {	
                            if ($row['id']==$page['id']) {
                                continue;
                            }
                            $link = GetLink($row);
                            $image = mysql_fetch_assoc($database->query("SELECT image FROM gallery WHERE sub = '{$row['id']}' AND front = 'yes'"));		
                        ?>
                        <li<? /*if ($i==0) { ?> class="no-margin"<? } */?>>
                            <span class="thumb"><a href="<?=$link?>"><img src="<?=$root.$image['image']?>" alt="<?=$row['name']?>" width="127" height="124" /></a></span>
                            <div class="caption"><a href="<?=$link?>"><?=$row['name']?></a></div>
                        </li>
                        <?
                        $i++;
                        }
                        ?>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    
    
    
        </div>
</div>










<footer class="container-fluid" style="padding:0px;">
	<? include "includes/footer.php"; ?>
</footer>
<?
if ($page['content2']!='') {
?>
<div class="map-mask">&nbsp;</div>
<div class="map-body">
	<div class="map-title-bar clearfix"><a href="#" class="close-map">&nbsp;</a><span class="map-title"><?=$page['name']?> <?=$page['address']?></span></div>
    <div class="map-thumb"><?=$page['content2']?></div>
</div>
<?
}
?>

</body>
</html>