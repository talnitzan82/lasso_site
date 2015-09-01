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

$page = $database->fetch("SELECT * FROM pages WHERE template LIKE 'index.php%' AND language = '$lang'");
$global = $database->fetch("SELECT * FROM global WHERE language = '$lang'");
$global_txt = explode("@@@",$global['custom']);

include_once "includes/handle_params.php";
if ($_SERVER['REQUEST_URI']!='/404.php') {
	if ($_SESSION["LASTURL1"] != urldecode($_SERVER['REQUEST_URI'])) {
		$_SESSION["LASTURL2"] = $_SESSION["LASTURL1"];
		$_SESSION["LASTURL1"] = urldecode($_SERVER['REQUEST_URI']);
		$lasturl              = $_SESSION["LASTURL2"];
		
	} else {
		$lasturl              = $_SESSION["LASTURL2"];
	}
}

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
<?
/*
<link rel="stylesheet" type="text/css" href="css/jquery.mobile.custom.structure.css">
<link rel="stylesheet" type="text/css" href="css/jquery.mobile.custom.theme.css">
*/
?>
<link rel="stylesheet" href="css/jquery.bxslider.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/touchTouch.css" type="text/css" media="all" />
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
        	<a href="<?=$root?>"><img src="/img/logo.png" alt="" style="width:60px;"></a>
        </div>
        <div class="m-header-search" data-position="fixed">
        	<div class="m-search-glass"></div>
            <div class="m-search-arrow"></div>
            <div class="m-search-overflow">
            <? include "includes/mobile-search.php"; ?>
            </div>           
        </div>           
    </div>
    <div class="m-index">
    	  <div class="m-list-padding"></div>
           <?
		  	$i=0;
			$url_explode = explode("-",$database->mysql_prep(mb_substr($_SERVER['REQUEST_URI'],1)));
			$url_implde = str_replace("_"," ",urldecode(implode("','",$url_explode)));	
			if ($url_implde!='') {
				$sql = "SELECT * FROM categories WHERE name in ('$url_implde')  ORDER BY sub DESC";				
				$query =$database->query($sql);
				while($row=mysql_fetch_assoc($query)) {
						$url_sql[$row['sub']][] = "(categories = '{$row['id']}' OR categories like '{$row['id']},%' OR categories LIKE '%,{$row['id']}' OR categories LIKE '%,{$row['id']},%')";
				}
				
				if(!empty($url_sql)) {
					foreach ($url_sql as $value) {
						$search[] = '('.implode(" AND ",$value).')';
					}										
				}
				if (!empty($search)) {
					$search = ' AND '.	implode(" AND ",$search);
				}
			}
			
			$sql = "SELECT * FROM products WHERE sub != 0 AND hide !='yes' AND name!='' $search ORDER BY sort DESC, RAND()";
			$query = $database->query($sql);
			while($row=mysql_fetch_assoc($query)) {
				$row['name'] = urlencode($row['name']);
				$link = GetLink($row);
				$image = mysql_fetch_assoc($database->query("SELECT image FROM gallery WHERE sub = '{$row['id']}' AND front = 'yes'"));	
			  	//$link = $root.urlencode($row['name']);
				$row['name'] = urldecode($row['name']);
			?>
              	<div class="prod_box">
                	<a href="<?=$link?>"><img src="https://www.lasso.co.il/<?=$image['image']?>" alt=""></a>
                	<a href="<?=$link?>" class="prod_box_title"><strong><?=$row['name']?></strong><br><?=$row['address']?></a>
                    
                </div>
          	  <?         
		  $i++;
		  }
		  ?>
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
    <script type="text/javascript" src="js/script.js"></script>
</div>
</body>
</html>
