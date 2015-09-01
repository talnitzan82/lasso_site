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
/*
if ($_SERVER['REQUEST_URI']!='/404.php') {
	if ($_SESSION["LASTURL1"] != urldecode($_SERVER['REQUEST_URI'])) {
		$_SESSION["LASTURL2"] = $_SESSION["LASTURL1"];
		$_SESSION["LASTURL1"] = urldecode($_SERVER['REQUEST_URI']);
		$lasturl              = $_SESSION["LASTURL2"];
		
	} else {
		$lasturl              = $_SESSION["LASTURL2"];
	}
}
*/
$lasturl = $pagename;
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
            <div class="m-header-logo" style="width:20%; cursor:pointer">
                <a href="<?=$lasturl?>"><img src="/img/logo.png" alt="" style="width:40px;"><br>חזרה</a>
            </div>  
            <div class="m-header-product-logo">
                <?
                $image = mysql_fetch_assoc($database->query("SELECT image FROM gallery WHERE sub = '{$page['id']}' AND logo = 'yes' LIMIT 1"));
                ?>
                <a href="" class="sub-button<?=($image['image']!='') ? ' sub-button2' : ''?>"><span><?=($image['image']!='') ? '<img src="http://www.lasso.co.il/'.$image['image'].'" alt="'.$page['name'].'">' : $page['name']?></span></a>         
            </div>                
        </div>      
      
        <div class="m-idx-con m-idx-con-p">
            <p>
            <? 
			if ($page['content4']!='') {
				$page['content2'] = $page['content4'];
			}
            $page['content2'] = str_replace(array("https","<iframe"),array("http",'<iframe style="margin-top:20px; position:relative; right:-10%; padding-bottom:10px"'),$page['content2']);
            $page['content2'] = preg_replace('/width="(.+?)"/','width="120%"',$page['content2']);
            echo $page['content2'];
            ?>
            </p>
        </div>
        
        <div class="m-footer" data-role="footer" data-fullscreen="true">
            <? include "includes/footer-m.php"; ?>
        </div>
        <script type="text/javascript" src="js/script.js"></script>
</div>
</body>
</html>
