<? include_once "includes/requires.php"; ?>
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
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $("#submit_btn").click(function() { 
        //get input field values
        var user_name       = $('input[name=name]').val(); 
        var user_email      = $('input[name=email]').val();
        var user_phone      = $('input[name=phone]').val();
        var user_message    = $('textarea[name=message]').val();
        
        //simple validation at client's end
        //we simply change border color to red if empty field using .css()
        var proceed = true;
        if(user_name==""){ 
            $('input[name=name]').css('border-color','red'); 
            proceed = false;
        }
        if(user_email==""){ 
            $('input[name=email]').css('border-color','red'); 
            proceed = false;
        }
        if(user_phone=="") {    
            $('input[name=phone]').css('border-color','red'); 
            proceed = false;
        }
        if(user_message=="") {  
            $('textarea[name=message]').css('border-color','red'); 
            proceed = false;
        }
        
        //everything looks good! proceed...
        if(proceed) 
        {
            //data to be sent to server
            post_data = {'userName':user_name, 'userEmail':user_email, 'userPhone':user_phone, 'userMessage':user_message};
            
            //Ajax post data to server
            $.post('includes/contact.php', post_data, function(data){  
                
                //load success massage in #result div element, with slide effect.       
                $("#result").hide().html('<div class="success">'+data+'</div>').slideDown();
                
                //reset values in all input fields
                $('#contact_form input').val(''); 
                $('#contact_form textarea').val(''); 
                
            }).fail(function(err) {  //load any error data
                $("#result").hide().html('<div class="error">'+err.statusText+'</div>').slideDown();
            });
        }
                
    });
    
    //reset previously set border colors and hide all message on .keyup()
    $("#contact_form input, #contact_form textarea").keyup(function() { 
        $("#contact_form input, #contact_form textarea").css('border-color',''); 
        $("#result").slideUp();
    });
    
});
</script>
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









<section class="content container-fluid" id="pjax-container">
	<div class="row-fluid">
    <div class="result-pannel span12">
    	<div class="CONTENT">
        	<h1><?=($page['title1']!='') ? $page['title1'] : $page['name']?></h1>
            <?=$page['content1']?>
            
            <fieldset id="contact_form">
            	<strong>שילחו פניה</strong>
                <div id="result"></div>
                <label for="name"><span>שם</span>
                <input type="text" name="name" id="name" placeholder="אנא מלאו שם מלא" />
                </label>
                
                <label for="email"><span>אימייל</span>
                <input type="text" name="email" id="email" placeholder="אנא מלאו אימייל" />
                </label>
                
                <label for="phone"><span>טלפון</span>
                <input type="text" name="phone" id="phone" placeholder="אנא מלאו טלפון" />
                </label>
                
                <label for="message"><span>הודעה</span>
                <textarea name="message" id="message" placeholder="אנא מלאו הודעה"></textarea>
                </label>
                
                <label><span>&nbsp;</span>
                <button class="submit_btn" id="submit_btn">שלחו פניה</button>
                </label>
            </fieldset>
            
        </div>
    </div>
	</div>
	
	
	
</section>

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
