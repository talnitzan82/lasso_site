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
<!-- Basic meta tags -->
<? include "includes/meta.php"; ?>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<!--[if (gte IE 9)|!(IE)]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<![endif]-->
<link rel="stylesheet" href="css/jquery.bxslider.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/touchTouch.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/template.css"/>
<!--[if lt IE 9]>
	<script src="js/shiv.js"></script>
<![endif]-->

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/imagesloaded.js"></script>
<script type="text/javascript" defer src="js/jquery.bxslider.js"></script>
<script type="text/javascript" defer src="js/touchTouch.jquery.js"></script>
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
    <div class="container-fluid m-index">
          <div class="m-idx-i"></div>
          <div class="m-idx-con">
          <h1><?=($page['title1']!='') ? $page['title1'] : $page['name'];?></h1>
          <p>
          <?=$page['content1']?>
          </p>
          <?
		  $info = mysql_fetch_assoc($database->query("SELECT * FROM pages WHERE short_content = 'אודות'"));
		  $link = GetLink($info);
		  ?>
          </div>
          <div class="m-idx-mbtns" style="overflow:hidden">
          	  <div class="container-fluid m-index">
              		<div class="row-fluid">
                        <div class="span6 relative"><a href="<?=$link?>" class="idx-buttons idx-buttons3">אודות לאסו</a><span class="btn_profile"></span></div>
                        <div class="span6 relative"><span class="idx-buttons idx-buttons2">יצירת קשר</span><span class="btn_email"></span></div>
                	</div>

              </div>
          </div>
          
        <div class="m-footer" data-role="footer" data-fullscreen="true">
        <? include "includes/footer-m.php"; ?>
        </div>
        <script type="text/javascript" src="js/script.js"></script>
    </div>
</div>

</body>
</html>
