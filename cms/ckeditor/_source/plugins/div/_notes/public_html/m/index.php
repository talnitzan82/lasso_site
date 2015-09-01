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
<link rel="stylesheet" type="text/css" href="css/template-home-page.css"/>
<!--[if lt IE 9]>
	<script src="js/shiv.js"></script>
<![endif]-->

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
<?=$global['script_header']?>
<div class="all-screen">
     <div class="top-logo">
            <div class="logo"></div>
            <div class="sentence">
                מי שמבין, בוחר לאסו
            </div>
        </div>
<div class="m-wrap" data-role="page">
	<div class="container-fluid m-index">
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
          	  	<div class="row-fluid buttons-row">
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

          

</div>
<div class="m-idx-mbtns bottom-part" style="overflow:hidden">
          	  <div class="container-fluid m-index">
              		<div class="row-fluid bottom-links">
						<?
                        $info = mysql_fetch_assoc($database->query("SELECT * FROM pages WHERE short_content = 'אודות'"));
                        $link = GetLink($info);
                        ?>
                        <div class="span6 relative about-us"><a href="<?=$link?>" class="idx-buttons idx-buttons3">אודותינו</a><span class="btn_profile"></span></div>
                        <?
                        $info = mysql_fetch_assoc($database->query("SELECT * FROM pages WHERE template LIKE 'contact.php%'"));
                        $link = GetLink($info);
                        ?>
                        <div class="span6 relative contact-us"><a href="<?=$link?>" class="idx-buttons idx-buttons2">צור קשר</a><span class="btn_email"></span></div>
                	</div>

              </div>
          </div>
          </div>
          <script>
          setTimeout(function() {
            $('.logo').fadeIn(1000);
          },1000);
          setTimeout(function() {
            $('.sentence').fadeIn();
          },2000);
          </script>
</body>
</html>
