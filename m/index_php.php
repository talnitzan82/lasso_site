<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

include_once "../includes/requires.php";
include_once "../includes/Mobile_Detect.php"; 
$detect = new Mobile_Detect;

$page = $database->fetch("SELECT * FROM pages WHERE template LIKE 'index.php%' AND language = '$lang'");
$global = $database->fetch("SELECT * FROM global WHERE language = '$lang'");
$global_txt = explode("@@@",$global['custom']);

include_once "../includes/handle_params.php";
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
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" />
<?
//if ( $detect->isMobile() ) {
?>
<link rel="stylesheet" type="text/css" href="css/jquery.mobile.custom.structure.css">
<link rel="stylesheet" type="text/css" href="css/jquery.mobile.custom.theme.css">
<?
//}
?>
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
<script type="text/javascript" src="js/migrate-1.2.1.js"></script>
<script type="text/javascript">

//$(document).pjax('.seachslotb,.dark-gray a', '#pjax-container')
//$.pjax.defaults.scrollTo = false;



$(document).ready(function() {	

	$(".search-inside").on("click",".EFCLOSE",function(){
		 $(".search-more").hide(); 
	});
	

	if ( !$.browser.msie ) {

		
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
				//console.log(data);
				//console.log(jQuery.parseJSON(data));
				var obj = jQuery.parseJSON(data);
				//console.log(href);
				History.replaceState({state:3,rand:Math.random()}, obj.title , href);
				$("#pjax-container").html(obj.data);
				
			});
			
		});	
	
	}
	
	
	// Call the layout function.
	$('#resultLand').imagesLoaded(function() {
		$('#resultLand li').wookmark({
			autoResize: true,
			container: $('#resultLand'),
			offset: 0,
			itemWidth: 255
		});
	});
	

});
</script>
<script type="text/javascript" src="js/script.js"></script>
<?
/*
if ( $detect->isMobile() ) {
?>
<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
<?
}
*/
?>
</head>
<body> 
<?
if ( $detect->isMobile() ) {
	/*
?>
<script>
$(window).load(function(){
	$(".m-con").fadeOut(1000);
	$(".m-wrap").fadeIn(1000);	
	
	$(".m-header-search").on("click",function(){
		if (!$(this).hasClass("m-header-search-o")) {
			$(this).addClass("m-header-search-o");
			$(".m-search-overflow").show();
			$(".m-search-overflow").css("left","0%");
			$(".m-header-search").css("width","60%");
			$(".m-header-search").height($("html").height()+"px");
			$(".m-header-logo").css("width","20%");
		} else {
			$(this).removeClass("m-header-search-o");
			$(".m-search-overflow").hide();
			$(".m-search-overflow").css("left","-100%");
			$(".m-header-search").css("width","20%");
			$(".m-header-search").height("56px");
			$(".m-header-logo").css("width","60%");
		}
	});
	
});
$(document).bind( "mobileinit", function(event) {
    $.extend($.mobile.zoom, {locked:true,enabled:false});
});
</script>
<?
/*
<div class="m-con">
    <div class="m-splash">
    	<div class="m-s-slogan"><img src="img/slogan1.png" alt=""></div>
        <div class="m-s-logo"><img src="img/logo.png" alt=""></div>
        <div class="m-s-slogan2"><img src="img/slogan2.png" alt=""></div>
        <div class="m-s-loader"><img src="img/ajax-loaderO.gif" alt=""></div>        
    </div>
</div>

?>
<div class="m-wrap">
	<div class="m-header" data-role="header" data-position="fixed" data-fullscreen="true">
    	<div class="m-header-logo">
        	<img src="img/logo.png" alt="" style="width:60px;">
        	<div class="m-header-logo-corner"></div> 
        </div>
        <div class="m-header-search" data-position="fixed">
        	<div class="m-search-glass"></div>
            <div class="m-search-arrow"></div>
        	<div class="m-header-search-corner"></div> 
            <div class="m-search-overflow">
                
                
                
                
                
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
						$sql2 = "SELECT * FROM categories WHERE sub = '{$row['id']}'  AND front = 'yes' AND name!='' ORDER BY sort DESC";
						$query2 = $database->query($sql2);						
						while($row2=mysql_fetch_assoc($query2)) {
						
							if (!in_array(str_replace(" ","_",$row2['name']),$params)) {
								$array2[]=$row2;
								$array2_ids[]=$row2['id'];
							}
							
							if (!in_array($row2['id'],$array2_ids)) {
								$array2_exists[] = $row2;						
								$counter3=0;
								//unset($array3,$array3_ids);
								$sql3 = "SELECT * FROM categories WHERE sub = '{$row2['id']}'  AND front = 'yes' ORDER BY sort DESC";
								
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
                    <li class="m-options-col">
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
                            <li><div class="ui-block-a"><a href="<?=$link?>" data-role="button" data-theme="b"><?=$value['name']?></a></div></li>                           
                            <?
                        }
                        //$all_links = implode("-",$all_links);
                        //$link = HandleSearch($all_links,$params);
						$link = HandleSearchAll($all_links,$params);
	                       unset($array3,$array2,$array3_ids,$array2_ids,$level3);
                        if ($row['type']=='0') {
                        ?>
                        <li class="dark-gray dark-gray4"><a href="<?=$link?>">בחר הכל</a></li>

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
        </div>           
    </div>
    <div class="m-index">
          <div class="m-idx-i"></div>
          <?
		  $i=0;
		  $sql = mysql_fetch_assoc($database->query("SELECT * FROM categories WHERE sub = 0 AND name = 'איזורים'"));
		  $sql = "SELECT * FROM categories WHERE sub = '{$sql['id']}' AND front = 'yes'";
		  $query =$database->query($sql);
		  while($row=mysql_fetch_assoc($query)) {
			  $link = GetLink($row);
			  if ($i==0) {
		 	  ?>
          	  <div class="ui-grid-a">
          	  <?
			  }
		  	  ?>
              <div class="ui-block-b"><a href="<?=$link?>" data-role="button" data-theme="c">וילות <?=$row['name']?></a></div>
          	  <?
			  $i++;
			  if ($i==2) {
		 	  ?>
              </div>
          	  <?
			  $i=0;
			  }
		  	  ?>         
          <?
		  $i++;
		  }
		  ?>
          </div>
          <div class="m-idx-con">
          <p>
          ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו ברוכים הבאים לאתר לאסו
          </p>
          </div>
          <div class="m-idx-mbtns" style="overflow:hidden">
          	  <div class="ui-grid-a" style="overflow:visible">
              	<div class="ui-block-a ui-block-idx2"><a href="<?=$link?>" data-role="button" data-theme="i">אודות לאסו</a><span class="btn_profile"></span></div>
               	<div class="ui-block-b ui-block-idx1"><a href="<?=$link?>" data-role="button" data-theme="j">יצירת קשר</a><span class="btn_email"></span></div>

              </div>
          </div>
    </div>
</div>
<div class="m-footer" data-role="footer" data-position="fixed" data-fullscreen="true">
	<? include "includes/footer-m.php"; ?>
</div>
<?

} else {
*/
?>
<header>

	<!--Mainnav-->
    <div class="nav_outer container-fluid">
	<div class="row-fluid">
	<div class="span12">
    	<div class="inside clearfix">
		
		
		
		    <div class="navbar">			 
              <div class="navbar-inner" style="background-color: rgba(0,0,0,0) !important;">                
				<a class="brand" href="<?=$root?>"><img src="img/logo.png"></a>
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <form action="<?=$root?>חיפוש/" method="get" class="navbar-form  search-site hidden-desktop" style="float:left;margin-bottom:5px; margin-right:5px;">
                    <div class="clearfix">
                        <input type="submit" value="" class="submit_btn" />
                        <input type="text" name="search" value="" class="keywords" />
                    </div>
                </form>	
                <div class="nav-collapse collapse">
                   <form action="<?=$root?>חיפוש/" method="get" class="navbar-form  search-site visible-desktop">
                   <div class="clearfix">
                	<input type="submit" value="" class="submit_btn" />
                    <input type="text" name="search" value="" class="keywords" />
                   </div>
              	   </form>
                 
                 <div class="mlike" style="float:left; padding-top:20px; padding-left:20px;">
                     <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=211218645601366";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-like" data-href="https://www.facebook.com/lasso.co.il" data-width="100" data-show-faces="false" data-send="false"></div>
                 </div> 
                                   
                 <ul class="nav">
            	 <?
				 include "includes/menu.php";
				 ?>
                 </ul>
               </div>                
            </div>
          </div>
					
					
        </div>
		
	</div>
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


<? 
include "includes/selection.php";
?>


<footer class="container-fluid" style="padding:0px;">
		<? include "includes/footer.php"; ?>
</footer>


<div class="COMP">
<form action="" method="post">
	<button type="submit" name="compareb"></button>
</form>	
</div>
<?
//}
?>
</body>
</html>
