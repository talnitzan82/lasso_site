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
<link rel="stylesheet" href="css/jquery.bxslider.css" type="text/css" media="all" />
<link rel="stylesheet" href="/css/touchTouch.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" href="css/template.css"/>
<!--[if lt IE 9]>
	<script src="js/shiv.js"></script>
<![endif]-->
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/imagesloaded.js"></script>
<script type="text/javascript" src="js/jquery.bxslider.js"></script>
<script type="text/javascript" src="js/touchTouch.jquery.js"></script>

</head>
<body> 
<?=$global['script_header']?> 
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
        	<a href="<?=$lasturl?>"><img src="../img/logo.png" alt="" style="width:40px;"><br>בחזרה ללאסו</a>
        </div>  
        <div class="m-header-product-logo">
        	<?
			$image = mysql_fetch_assoc($database->query("SELECT image FROM gallery WHERE sub = '{$page['id']}' AND logo = 'yes' LIMIT 1"));
			?>
			<a href="" class="sub-button<?=($image['image']!='') ? ' sub-button2' : ''?>"><span><?=($image['image']!='') ? '<img src="https://www.lasso.co.il/'.$image['image'].'" alt="'.$page['name'].'">' : '<span style="font-size:40px;padding-top:18px; padding-left:10px; display:inline-block">'.$page['name'].'</span>'?></span></a>
        </div>                
    </div>
    <div class="m-index">
          
          <div class="m-product-padding"></div>
          <div class="carousel-wrapper">
            <ul class="bxslider">
              <?
              $sql = "SELECT * FROM gallery WHERE sub = '{$page['id']}' AND hide!='yes'";
              $query = $database->query($sql);
              while($row=mysql_fetch_assoc($query)) {
              ?>
              <li><a href="../<?=$row['image']?>" class="touchthumb"><img src="https://www.lasso.co.il/<?=$row['image']?>" alt="<?=$page['name']?>" /></a></li>
              <?
              }
              ?>
            </ul>
            <div id="bx-pager" class="clearfix" style="display:none;">
              <?
              $i=0;
              $sql = "SELECT * FROM gallery WHERE sub = '{$page['id']}' AND hide!='yes'";
              $query = $database->query($sql);
              while($row=mysql_fetch_assoc($query)) {
              ?>
              <a data-slide-index="<?=$i?>" href=""><img src="https://www.lasso.co.il/<?=$row['image']?>" alt="<?=$page['name']?>"/></a>
              <?
              $i++;
              }
              ?>
            </div>
        </div>        
        
        <div class="slide-bottom-info">
            <h4>פרטי יצירת קשר</h4>
            <div>
                <?
                if ($page['area']!='') {
                ?>
                <strong>איזור:</strong> <?=$page['area']?><br />
                <?
                }
                if ($page['address']!='') {
                ?>
                <strong>כתובת:</strong> <a href="<?=$pagename?>?מפה"><?=$page['address']?></a><br />
                <?
                }
                if ($page['contact']!='') {
                ?>
                <strong>איש קשר:</strong> <?=$page['contact']?><br />
                <?
                }
                if ($page['phone']!='') {
                    $phone = explode("/",$page['phone']);
                ?>
                <strong>טלפון:</strong> 
                    <?
                    foreach($phone as $value) {
                        $value = trim($value);
                        if ($value!='') {
                            if ( $detect->isMobile() ) {
                            ?>
                            <a href="tel:<?=$value?>">
                            <?
                            }
                            ?>
                            <?=$value?>
                            <?
                            if ( $detect->isMobile() ) {
                            ?>
                            </a>
                            <?
                            }
                        }
                    }
                ?>
                <br />
                <?
                }
                if ($page['website']!='') {
                ?>
                <strong>אתר:</strong> <a href="<?=$page['website']?>" target="_blank"><?=$page['website']?></a> <br />
                <?
                }
                if ($page['facebook']!='') {
                ?>
                <strong>עמוד פייסבוק:</strong> <a href="<?=$page['facebook']?>" target="_blank">לחץ כאן</a> 
                <?
                }
                ?>
            </div>
        </div>        
      </div>
      
      
        <div class="m-idx-con m-idx-con-p">
            <p><?=$page['content1']?></p>
        </div>        
		<?
        if ($page['content2']!='') {
            $spani = 4;
        } else {
            $spani = 6;
        }
        ?>
        <div class="m-idx-mbtns" style="overflow:hidden">
              <div class="container-fluid m-index">
                    <div class="row-fluid">
                        <?
                        if ($page['content2']!='') {
                        ?>
                        <div class="span<?=$spani?> relative"><a href="<?=$pagename?>?מפה" class="idx-buttons idx-buttons4 idx-btn-pad ">איך מגיעים</a><span class="btn_icon1"></span></div>
                        <?
                        }
                        ?>
                        <div class="span<?=$spani?> relative"><a href="<?=$pagename?>?שלח" class="idx-buttons idx-buttons2 idx-btn-pad">שלח לחבר</a><span class="btn_icon2"></span></div>
                        <div class="span<?=$spani?> relative"><a href="javascript:void()" onClick="window.open('http://www.facebook.com/sharer.php?u=http://<?=$_SERVER['SERVER_NAME']?><?=urldecode($_SERVER['REQUEST_URI'])?>','Share Lasso','toolbar=no,width=500,height=200,left=500,top=200,status=no,scrollbars=no,resize=no');return false" target="_blank" class="fb-like-plc idx-buttons idx-buttons1 idx-btn-pad">שתף</a><span class="btn_icon3"></span></div>
                    </div>
        
              </div>
          </div>
        
        
        
        <div class="slide-bottom-info info-pannel container-fluid">
            <div class="subwhite-box row-fluid">
                <div class="span12">
                <h4 class="prod-h4">מה כלול?</h4>
                <?
                $categories = explode(",",$page['categories']);
                ?>
                <form action="#" class="jNice no-margin clearfix">
                    <ul class="search-options-col search-options-col2 subwhite-checks clearfix"  style="margin:0; padding:0; padding-top:10px">
                        <?
                        $sql   = "SELECT * FROM `categories` WHERE sub = '0' AND hide!='yes' ORDER BY sort ASC";
                        $query = $database->query($sql);
                        while ($row=mysql_fetch_assoc($query)) {	
                        ?>
                        <li class="options-col3">
                            <ul class="options-list">
                                <?
                                $sql2   = "SELECT * FROM `categories` WHERE sub = '{$row['id']}' AND hide!='yes' ORDER BY sort ASC";
                                $query2 = $database->query($sql2);
                                while ($row2=mysql_fetch_assoc($query2)) {
                                    if (in_array($row2['id'],$categories)) {
                                ?>	
                                <li class="dark-gray dark-gray2"><span class="CHECKBOX CHECKBOX2"></span><?=($row['type']=='0') ? $row2['name'] : $row2['name']?></li>
                                <?
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <?
                        }
                        ?>                        
                    </ul>
                </form>
            	</div>
            </div>
        </div>
        
        <div class="sub-bottom-line">
            <h4 class="bottom-title">המלצות נוספות</h4>
            <div class="bottom-sl-b bottom-sl-r"></div>
            <div class="bottom-sl-b bottom-sl-l"></div>
            <div class="bottom-seris-con">
            <div class="bottom-seris-con2">
                <ul class="bottom-series clearfix">           
                    <?
                    if ($categories[0]!='') {
                        $sql = "SELECT * FROM categories WHERE id in (".implode(",",$categories).") AND hide !='yes'";
                        $query=$database->query($sql);
                        while($row=mysql_fetch_assoc($query)) {
                                $url_sql[] = "(categories = '{$row['id']}' OR categories like '{$row['id']},%' OR categories LIKE '%,{$row['id']}' OR categories LIKE '%,{$row['id']},%')";
                        }
                        
                        if(!empty($url_sql)) {
                            
                            $search = "AND ".implode(" OR ",$url_sql);
                                                
                        }
                    }
                    $i=0;;
                    $sql = "SELECT * FROM products WHERE id != '{$page['id']}' AND sub != 0 AND hide !='yes' AND name!='' $search ORDER BY RAND() LIMIT 5";
                    $query=$database->query($sql);
                    while($row=mysql_fetch_assoc($query)) {	
                        if ($row['id']==$page['id']) {
                            continue;
                        }
                        $link = GetLink($row);
                        $image = mysql_fetch_assoc($database->query("SELECT image FROM gallery WHERE sub = '{$row['id']}' AND front = 'yes'"));		
                    ?>
                    <li<? /*if ($i==0) { ?> class="no-margin"<? } */?>>
                        <span class="thumb"><a href="<?=$link?>"><img src="https://www.lasso.co.il<?=$root.$image['image']?>" alt="<?=$row['name']?>" width="127" height="124" /></a></span>
                        <div class="caption"><a href="<?=$link?>"><?=$row['name']?></a></div>
                    </li>
                    <?
                    $i++;
                    }
                    ?>
                </ul>
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
