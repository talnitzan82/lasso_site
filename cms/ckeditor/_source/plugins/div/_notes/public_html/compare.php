<? include_once "includes/requires.php"; ?>
<?
$ids = str_replace("_",",",Decode(end(explode("/",$_SERVER['REQUEST_URI'])),19));
$sql = "SELECT * FROM products WHERE id in ($ids) AND hide!='yes'";
$query = $database->query($sql);
while($row=mysql_fetch_assoc($query)) {
	if ($row['name']!='') {
		$products[] = $row;	
		foreach (explode(",",$row['categories']) as $value) {
			if ($value!='') {
				$cats[] = $value;
			}
		}
		$title_a[]= $row['name'];
	}
}
$title_a = ' השוואה בין '.implode(" - ",$title_a);
$page['meta_desc'] = $title_a;
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
<script type="text/javascript" src="<?=$root?>js/jquery.history.js"></script>
<script type="text/javascript" src="<?=$root?>js/migrate-1.2.1.js"></script>
<script type="text/javascript">
$(document).ready(function() {
 $(".data-thumb-item").imagesLoaded(function() {
	 
	  var smallest = 10000000;
	  $(".data-thumb-item").each(function(){
		  if ($(this).find("img").height() < smallest) {
			smallest = $(this).find("img").height();  
		  }
	  });
	  $(".data-thumb-item-over").height(smallest);
	  $(".data-thumb-item-over").css("overflow","hidden");
  
 });
});
</script>

<script type="text/javascript" src="<?=$root?>js/script.js"></script>

</head>
<body> 

<header style="height:auto !important;">

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

    
</header>
	<div class="container-fluid">
	<div class="row-fluid">

<section class="content">

	<div class="datatable">
    	<?
		/*
        <ul class="data-thumbs clearfix">
            <li class="last"><h4>השוואה בין המקומות</h4></li>
        	<?
			foreach ($products as $value) {
				$link = GetLink($value);
				$image = mysql_fetch_assoc($database->query("SELECT image FROM gallery WHERE sub = '{$value['id']}' AND front = 'yes'"));
			?>
        	<li>
            	<div class="data-thumb-item">
                	<a href="<?=$link?>"><img src="<?=$root.$image['image']?>" alt="" width="166" height="166" /></a>
                    <span class="thumb-caption"><a href="<?=$link?>"><?=$value['name']?></a></span>
                    <div class="data-thumb-action"><a href="#">&nbsp;</a></div>
                </div>
            </li>
            <?
			}
			?>
        </ul>
		<?
		*/
		$array1 = array("כתובת","טלפון","איש קשר","אתר אינטרנט");
		$array2 = array("address","phone","contact","website");
		?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="data-statistick">   
          <tr>
          	<td width="20%;" class="first-col" style="background:transparent;"><h4>השוואה בין המקומות</h4></td>            
		  <?
			foreach ($products as $value) {
				$link = GetLink($value);
				$image = mysql_fetch_assoc($database->query("SELECT image FROM gallery WHERE sub = '{$value['id']}' AND front = 'yes'"));
			?>
			<td style="background:transparent; width: <?=(100 - 20) / count($products)?>%" valign="top">
				<div class="data-thumb-item">
                	<div class="data-thumb-item-over">
                        <a href="<?=$link?>"><img src="<?=$root.$image['image']?>" alt="" /></a>
                        <span class="thumb-caption"><a href="<?=$link?>" target="_blank"><?=$value['name']?></a></span>
                    </div>
					<? /*<div class="data-thumb-action"><a href="#">&nbsp;</a></div>*/?>
				</div>
			</td>
			<?
			}
		  ?>
          </tr>
          <tr>
          	<td style="padding:0; text-align:right" colspan="<?=count($products)+1?>"><h4 class="table-title">פרטי מקום</h4></td>
          </tr>
          <?
		  $i=1;
		  foreach ($products as $key=>$value) {
		  ?>
          <tr<? if ($i%2){?> class="even"<? }?> style="width: <?=(100 - 20) / count($products)?>%">
          	<td width="20%;" class="first-col"><?=$array1[$key]?></td>
            <?
			foreach ($products as $key2=>$value2) {
			?>
            <td><?=$value2[$array2[$key]]?></td>
            <?
			}
			?>
          </tr>
          <?
		  $i++;
		  }
		  ?>         
        </table>
        
        <?
		$sql = "SELECT * FROM categories WHERE id in (".implode(",",$cats).")";
		$query = $database->query($sql);
		while($row=mysql_fetch_assoc($query)) {
			if ($row['name']!='') {
				
				## continue areas since there is "address" on top
				$parent1 = mysql_fetch_assoc($database->query("SELECT type,id,sub,name FROM categories WHERE id = '{$row['sub']}'"));
				$parent2 = mysql_fetch_assoc($database->query("SELECT type,id,sub,name FROM categories WHERE id = '{$parent1['sub']}'"));
				if ($parent1['name']=='איזורים' || $parent2['name']=='איזורים') {
					continue;	
				}
				
				if ($last_id==$parent1['id']) {
					continue;
				}
				
				if ($parent1['type']==0) {
					$last_id = $parent1['id'];
					$row['name'] = $parent1['name'];
					$row['type'] = '0';
					$categories[$row['id']] = $row;
					$categories[$row['id']]['id'] = $parent1['id'];
					
				} else {
					$categories[$row['id']] = $row;
				}
				/*
				if ($categories[$type['id']][0]['name']=='') {
					$categories[$type['id']][0] = $type;	
				}
				
				
				if ($type['type']=='0') {
					$row['type']               = $type['type'];
					$categories[$type['id']][] = $row; 
	
				} else {
					
					$categories[$row['id']] = $row;
						
				}
				*/
				
				
			}
		}
		?>
        
        <h4 class="table-title">מה כלול?</h4>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="data-statistick">
          <?
		  $i=1;
		  foreach ($categories as $key=>$value) {
		  ?>
          <tr<? if ($i%2){?> class="even"<? }?>>
            <td class="first-col" width="20%"><?=$value['name']?></td>
            <?
			foreach ($products as $key2=>$value2) {
			?>
            <td style="width: <?=(100 - 20) / count($products)?>%">
            	<?
				if ($value['type']=='') {
				?>
					<? if (in_array($key,explode(",",$value2['categories']))) {?>
                    <img src="<?=$root?>img/v_icon.png" alt="Yes">
                    <? } else { ?>
                    <img src="<?=$root?>img/x_icon.png" alt="No">
                    <? } ?>
                <?
				} else {
					
					$h = $database->query("SELECT * FROM categories WHERE sub = '{$value['id']}'");
					while($row=mysql_fetch_assoc($h)) {
						if (in_array($row['id'],explode(",",$value2['categories']))) {
							$con[] = $row['name'];
						}
					}
					if (is_array($con)) {
						echo implode(",",$con);
					} else {
						echo '-';	
					}
					unset($con);
                
                } 
				?>
            </td>
            <?
			}
			?>
          </tr>
          <?
		  $i++;
		  }
		  ?>
        </table>
    </div>
    
    <br />
    <a href="javascript:void()" onClick="window.open('http://www.facebook.com/sharer.php?u=http://<?=$_SERVER['SERVER_NAME']?><?=urldecode($_SERVER['REQUEST_URI'])?>','Share Lasso','toolbar=no,width=500,height=200,left=500,top=200,status=no,scrollbars=no,resize=no');return false" target="_blank" class="fb-like-plc"><img src="<?=$root?>img/fb-btn.gif" alt="" /></a>
    
    <? include "includes/send-to-friend.php"; ?>
<br />
    
</section>
</div>
</div>
<footer class="container-fluid" style="padding:0px;">
	<? include "includes/footer.php"; ?>
</footer>




</body>
</html>