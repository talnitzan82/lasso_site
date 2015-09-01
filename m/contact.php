<?
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include_once "../../includes/sessions.php";
include_once "../../includes/db.php";
include_once "../../includes/database.php";
include_once "../../includes/languages.php";
include_once "../../includes/form.php";
include_once "../../includes/config.php";
include_once "../../includes/functions.php";

include_once "includes/config.php";
include_once "includes/functions.php";
include_once "includes/forms.php";

include_once "includes/Mobile_Detect.php"; 
$detect = new Mobile_Detect;


include_once "includes/handle_params.php";

?>
<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="not-ie" lang="en">
<!--<![endif]-->
<head>
<? include "includes/meta.php"; ?>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<!--[if (gte IE 9)|!(IE)]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<![endif]-->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" href="css/template.css"/>
<!--[if lt IE 9]>
	<script src="js/shiv.js"></script>
<![endif]-->
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/imagesloaded.js"></script>

</head>
<body> 
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
*/
?>
<div class="m-wrap" data-role="page">
	
        <div class="m-header" data-role="header" data-position="fixed" data-fullscreen="true">
            <div class="m-header-logo">
                <a href="<?=$root?>"><img src="img/logo.png" alt="" style="width:60px;"></a>
            </div>
            <div class="m-header-search" data-position="fixed">
                <div class="m-search-glass"></div>
                <div class="m-search-arrow"></div>
                <div class="m-search-overflow">
                <? include "includes/mobile-search.php"; ?>
                </div>
             
            </div>           
        </div>      
      
        <div class="m-idx-con m-idx-con-p m-idx-con-s">                
            <div id="tellfriend">
             <div class="SUC1" style="display:<?=($success!='yes') ? 'block' : 'none' ?>">
             <form id='tellafriend_form' method="post" action=""  >
                <input type="hidden" name="pagename" value="<?=$page['name']?>" />
                <label for="from">אימייל של חבר: </label>
                 <input class="std_input" type="text" id="from" name="to" 
                 size="40" maxlength="35" value="" />
            
                 <label for="name">שם מלא: </label>
                 <input class="std_input" type="text" id="name" name="name" 
                 size="40" maxlength="35" value="" />
            
                 <label for="subject">נושא: </label>
                 <input class="std_input" type="text" id="subject" 
                 name="subject" size="40" value='' />
            
                 <label for="message">הודעה: </label>
                 <textarea id="message" name="message" readonly rows="4" cols="40"></textarea>
                 <br />
                 <input type="submit" name="sendtofriend" class="send-to-friend" value="שלח במייל לחבר"/>
            </form> 
            </div>
            <div class="SUC2" style="display:<?=($success=='yes') ? 'block' : 'none' ?>; padding-bottom:110px;">
                <br><br>
                ההודעה נשלחה בהצלחה. תודה רבה והמשך גלישה נעימה.
            </div>
            </div>
            <script>
                jQuery.fn.fadeToggle = function(speed, easing, callback) {
                    return this.animate({opacity: 'toggle'}, speed, easing, callback);  
                };
            </script>
        </div>
        
        <div class="m-footer" data-role="footer" data-fullscreen="true">
            <? include "includes/footer-m.php"; ?>
        </div>
        <script type="text/javascript" src="js/script.js"></script>
</div>
</body>
</html>
