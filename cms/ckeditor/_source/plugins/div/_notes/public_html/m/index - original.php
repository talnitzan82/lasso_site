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

$page = $database->fetch("SELECT * FROM pages WHERE template LIKE 'index_mobile%' AND language = '$lang'");
$global = $database->fetch("SELECT * FROM global WHERE language = '$lang'");
$global_txt = explode("@@@",$global['custom']);

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
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/template.css"/>
<!--[if lt IE 9]>
	<script src="js/shiv.js"></script>
<![endif]-->

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
<?=$global['script_header']?> 
<div class="m-con">
    <div class="m-splash">
    	<div class="m-s-slogan"><img src="img/slogan1.png" alt=""></div>
        <div class="m-s-logo"><img src="img/logo.png" alt=""></div>
        <div class="m-s-slogan2"><img src="img/slogan2.png" alt=""></div>
        <div class="m-s-loader"><img src="img/ajax-loaderO.gif" alt=""></div>        
    </div>
</div>

<div class="m-wrap" data-role="page">
	<div class="m-header" data-role="header">
    	<div class="m-header-logo">
        	<a href="<?=$root?>"><img src="/img/logo.png" alt="" style="width:60px;"></a>
        </div>
        <div class="m-header-search">
        	<div class="m-search-glass"></div>
            <div class="m-search-arrow"></div>
            <div class="m-search-overflow">
            <? include "includes/mobile-search.php"; ?>
            </div>
         
        </div>           
    </div>
    <div class="container-fluid m-index">
			<?
            $i     = 0;
            $sql   = mysql_fetch_assoc($database->query("SELECT * FROM pages WHERE title1 = '1212'"));
            $sql   = "SELECT * FROM gallery WHERE sub = '{$sql['id']}' AND hide!='yes' ORDER BY sort DESC,front DESC LIMIT 1";
			$query = mysql_fetch_assoc($database->query($sql));
			$midxi = ' style="background-size: cover; background-image:url(http://www.lasso.co.il/'.$query['image'].');"';
            ?>
          <div class="m-idx-i"<?=$midxi?>></div>
          <?
		  $i=0;
		  $sql = mysql_fetch_assoc($database->query("SELECT * FROM pages WHERE template LIKE 'index_mobile%'"));
		  $sql = "SELECT * FROM pages WHERE sub = '{$sql['id']}' AND hide!='yes' AND name!=''";
		  $query =$database->query($sql);
		  while($row=mysql_fetch_assoc($query)) {
			  $link = $root.urlencode($row['name']);
			  if ($i==0) 
			  {
		 	  	?>
          	  	<div class="row-fluid">
          	  	<?
			  }
		  	  	?>
              	<div class="span6"><a href="<?=$row['alink1']?>" class="idx-buttons-home idx-buttons"><?=$row['name']?></a></div>
          	  	<?			 
			  if ($i==1) 
			  {
		 	  	?>
              	</div>
          	  	<?
			  	$i=0;
			  } else {
			  	$i++;
			  }

		  }
		  ?>
          </div>
          <div class="m-idx-con">

          <?=$page['content1']?>
                  
          </div>
          
          <div class="m-idx-mbtns" style="overflow:hidden">
          	  <div class="container-fluid m-index">
              		<div class="row-fluid">
						<?
                        $info = mysql_fetch_assoc($database->query("SELECT * FROM pages WHERE short_content = 'אודות'"));
                        $link = GetLink($info);
                        ?>
                        <div class="span6 relative"><a href="<?=$link?>" class="idx-buttons idx-buttons3">אודות לאסו</a><span class="btn_profile"></span></div>
                        <?
                        $info = mysql_fetch_assoc($database->query("SELECT * FROM pages WHERE template LIKE 'contact.php%'"));
                        $link = GetLink($info);
                        ?>
                        <div class="span6 relative"><a href="<?=$link?>" class="idx-buttons idx-buttons2">יצירת קשר</a><span class="btn_email"></span></div>
                	</div>

              </div>
          </div>
          
        <div class="m-footer" data-role="footer" data-fullscreen="true">
        <? include "includes/footer-m.php"; ?>
        </div>        
</div>
</body>
</html>
