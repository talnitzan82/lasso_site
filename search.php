<?  include_once "includes/requires.php"; ?>
<?
$page = $database->fetch("SELECT * FROM pages WHERE template LIKE 'index.php%' AND language = '$lang'");
$global = $database->fetch("SELECT * FROM global WHERE language = '$lang'");
$global_txt = explode("@@@",$global['custom']);

$search_key = $_GET['search'];

$url=mb_substr(urldecode($_SERVER['REQUEST_URI']),1);
$params=explode("-",$url);

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
<link href="<?=$root?>css/bootstrap.css" rel="stylesheet" />
<link href="<?=$root?>css/bootstrap-responsive.min.css" rel="stylesheet" />
<link href="<?=$root?>css/template.css" rel="stylesheet" />

<!--[if lt IE 9]>
	<script src="js/shiv.js"></script>
<![endif]-->
<!-- JS
================================================== --> 
<script type="text/javascript" src="<?=$root?>js/jquery-1.8.3.min.js"></script> 
<script type="text/javascript" src="<?=$root?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?=$root?>js/imagesloaded.js"></script>
<script type="text/javascript" src="<?=$root?>js/wookmark.js"></script>

<script type="text/javascript" src="<?=$root?>js/script.js"></script>

</head>
<body> 

<header>

	<!--Mainnav-->
    <div class="nav_outer container-fluid">
	<div class="row-fluid">
	<div class="span12">
    	<div class="inside clearfix">
		
		
		
		    <div class="navbar">			 
              <div class="navbar-inner" style="background-color: rgba(0,0,0,0) !important;">                
				<a class="brand" href="<?=$root?>"><img src="<?=$root?>img/logo.png"></a>
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
                <img src="<?=$root.$row['image']?>" alt="<?=$row['name']?>" />
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

<div class="container-fluid">

<div class="row-fluid">
<section class="content">
   <?
   $search_key_prep = $database->mysql_prep($search_key); 
   $sql  = "SELECT * FROM products WHERE name LIKE '%$search_key_prep%' OR content1 LIKE '%$search_key_prep%' AND hide!='yes'";
   $num  = $database->num_rows($sql);
   $sql2 = "SELECT * FROM pages WHERE name LIKE '%$search_key_prep%' OR content1 LIKE '%$search_key_prep%' AND hide!='yes'";
   $num2  = $database->num_rows($sql2);
   
   ?>
   <h2><span class="H2R">נמצאו</span> <?=$num+$num2?> <span class="H2R">תוצאות ל-</span><?=$search_key?></h2>
    <!--Search Result-->
	<div class="result-row-box">
    	<ul class="result-rows">
        	    <?
			if ($num+$num2>0) {
				$i=0;
				$query = $database->query($sql);
				while($row=mysql_fetch_assoc($query)) {
					$i++;
					$link = GetLink($row);
					$image = mysql_fetch_assoc($database->query("SELECT image FROM gallery WHERE sub = '{$row['id']}' AND front = 'yes'"));
			?>
        	<li class="row-items clearfix<? if ($i==1) {?> first<? } elseif($i==$num+$num2) {?> last<? } ?>">
            	<div class="row-holder clearfix">
                	<div class="thumb span2"><a href="<?=$link?>" target="_blank"><img src="<?=$root.$image['image']?>" alt="" width="127" height="123" /></a></div>
                    <div class="descrption span8">
                        <h4><a href="<?=$link?>" target="_blank"><?=$row['name']?></a></h4>
                        <?=$row['short_content']?>
                    </div>
                    <div class="row-button span2"">
                    	<a href="<?=$link?>" target="_blank" class="result-item-btn">לפרטים נוספים</a>
                    	<span class="clearfix item-chooser"><input type="checkbox" value="<?=$row['id']?>" class="CHECKBOX_C" /> סמן להשוואה</span>
                    </div>
                </div>
            </li>
            <?				
				}
				$query = $database->query($sql2);
				while($row=mysql_fetch_assoc($query)) {
					$i++;
					$link = GetLink($row);
			?>
        	<li class="row-items clearfix<? if ($i==1) {?> first<? } elseif($i==$num+$num2) {?> last<? } ?>">
            	<div class="row-holder clearfix">
                	<?
					if ($row['image1']!='') {
					?>
                	<div class="thumb span2"><a href="<?=$link?>" target="_blank"><img src="<?=$root.$row['image1']?>" alt="" width="127" height="123" /></a></div>
                    <?
					}
					?>
                    <div class="descrption span8">
                        <h4><a href="<?=$link?>" target="_blank"><?=$row['name']?></a></h4>
                        <?=$row['short_content']?>
                    </div>
                    <div class="row-button span2"">
                    	<a href="<?=$link?>" target="_blank" class="result-item-btn">לפרטים נוספים</a>
                    	<span class="clearfix item-chooser"><input type="checkbox" value="<?=$row['id']?>" class="CHECKBOX_C" /> סמן להשוואה</span>
                    </div>
                </div>
            </li>
            <?				
				}
			}
			?>
        </ul>    
        
        <a href="javascript:void()" class="page-scroller">&nbsp;</a>
        
    </div>
    
    <!--/Search Result-->
    
</section>
    </div>    
 </div>
<footer class="container-fluid" style="padding:0px;">
	<? include "includes/footer.php"; ?>
</footer>
<div class="COMP">
<form action="" method="post">
	<button type="submit" name="compareb"></button>
</form>	
</div>
</body>
</html>