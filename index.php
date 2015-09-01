<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

include_once "includes/requires.php";
$page = $database->fetch("SELECT * FROM pages WHERE template LIKE 'index.php%' AND language = '$lang'");
$global = $database->fetch("SELECT * FROM global WHERE language = '$lang'");
$global_txt = explode("@@@",$global['custom']);

include_once "includes/handle_params.php";
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
		 $(".search-submitter2").show();
	});
	

	if ( !$.browser.msie ) {

		
		$(".dark-gray a").each(function(){
			var href = $(this).attr("href");
			$(this).attr("href","javascript:void(0)");
			$(this).attr("url",href);
		});
		$(".seachslotb").each(function(){
			var href = $(this).attr("href");
			$(this).attr("href","javascript:void(0)");
			$(this).attr("url",href);
		});
	
		$("#pjax-container").on("click",".dark-gray a, .seachslotb, .submit-options",function() {
			var href = $(this).attr("url");
			
			
			var array = new Array();	
			if ($(this).hasClass("submit-options")) {
				var c = 0;
				$("input[name='checkbox[]']:checked").each(function(){
					array[c] = $(this).attr("url").substr(1);
					c++;
				});

				if (array.length>0) {
					href = '/'+array.join("-");	
				}
			}
			

			$.post("includes/push_state.php",{ href: href},function(data) {
				var obj = jQuery.parseJSON(data);
				History.replaceState({state:3,rand:Math.random()}, obj.title , href);
				$("#pjax-container").html(obj.data);
				
				$('#resultLand').imagesLoaded(function() {
				
					$(".result-item").each(function(){
						if ($(this).find(".result-image").height() < $(this).find("img").height()) {
							$(this).height( $(this).height() + $(this).find("img").height());			
						}											
					});
				
				});
				//$('#resultLand').trigger('refreshWookmark');
				
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
/*
var p = 0;
var new_p = -1;
$(window).scroll(function() {
   if($(window).scrollTop()+200 >= $("#resultLand").height() && (p < new_p || p==0)) {
	   if (new_p==-1) {
		   p=1;
	   } else {
		 p = $(".next_infinite").last().attr("href");
	   }
	   
	   $(".more-loader").css("display","block");
	   $.ajax({
		  type: "POST",
		  url: "includes/push_state.php",
		  data: { p: '"'+p+'"' ,href: "/<?=implode("-",$params)?>" }
		}).done(function( html ) {		
			$(".more-loader").css("display","none");
			html = jQuery.parseJSON(html);
			html = $(html.data);	
			var resultLand = html.find(".result-item");
			$("#resultLand").append(resultLand);
			new_p = html.find(".next_infinite").attr("href");
			
			
			$('#resultLand li').wookmark({
				autoResize: true,
				container: $('#resultLand'),
				offset: 0,
				itemWidth: 255
			});	
			$('#resultLand').trigger('refreshWookmark');
		});
   }
});
*/


</script>
<script type="text/javascript" src="js/script.js"></script>

</head>
<body>
<?=$global['script_header']?> 
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
    <div class="row-fluid">
	<div class="span12">
    	<div id="big-header" style=" padding: 1px 1px;
    margin-top: 10px;
    background-color: transparent;
    color: white;
    text-align: center;
    font-family: tahoma;
    -webkit-text-stroke: 2px black;" class="inside clearfix">
            <h1 style="font-size: 56px;">וילות ולופטים להשכרה</h1>
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

</body>
</html>
