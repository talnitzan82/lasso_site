<?
$table = "pages";
include "../../includes/config.php";
include $includes_dir ."includes/sessions.php";
include $includes_dir ."includes/db.php";
include $includes_dir ."includes/auth.php";
include $includes_dir ."includes/database.php";
include $includes_dir ."includes/languages.php";
include $includes_dir ."includes/templates.php";
include $includes_dir ."includes/pages.php";
include $includes_dir ."includes/functions.php";
include "include/languages.php";
set_time_limit(0);
//error_reporting(E_ALL); 
ini_set('display_errors', 'On');
//ignore_user_abort(true);

function getTime()
{
$a = explode (' ',microtime());
return(double) $a[0] + $a[1];
}

function scan($id,$url,$keyword,$database,$count=100) {
	$date = date("Y-m-d");
	$checker2 = $database->num_rows("SELECT * FROM scans WHERE keyword = '$keyword' AND url LIKE '$url%' AND sub = '$id' AND `date` LIKE '$date%'");
	if ($checker2 == 0) {
		
		$keyword_fixed = str_replace(" ","+",$keyword);
		
		$baseurl = "http://www.google.co.il/search?num=$count&hl=iw&q=$keyword_fixed";
		//$baseurl = "http://www.google.com/search?num=$count&hl=iw&q=$keyword_fixed";
		$curlpage = $baseurl;
		
		$i=0;
		$limit = 1;
		while ($i<=$limit) {
			
			if ($i > 0) {				
				$curlpage = $baseurl."&start=".($i*$count);
			}
			
			$ch = curl_init($curlpage);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_REFERER,'');
			$output = curl_exec($ch);      
			curl_close($ch);			
			
	
			preg_match_all('@<script>(.+?)</script>@s',$output,$new);
			
			$newi = str_replace(array($new[1][0],$new[1][1],$new[1][2],$new[1][3]),array(''),$output);
			
			preg_match_all('@<li(.+)@s',$newi,$newr);
			
			preg_match_all('@<h3 class="r">(.+?)</h3>@s',$newr[1][0],$divs);
			
			foreach ($divs[1] as $key=>$value) {
				
				### SET THE URL ###			
				preg_match('@href="(.+?)">@s',$value,$v);
				$v = explode('"',$v[1]);
				$website =  urldecode($v[0]);	
					
				$array_web[] = $website;
				### SET THE URL ###	
				### SET TTIEL ###	
				$title = strip_tags($value);
				$array_title[] = $title;
				### SET TTIEL ###	
								
			}
			unset($output,$divs,$new,$newr,$newi);
		$i++;				
		}	
	
		if (is_array($array_web)) {
			foreach ($array_web as $key=>$value) {	
				
				if (strpos($value,$url)!==false) {	
						
					$position = $key + 1;
					
					$date = date("Y-m-d , H:i");
					
					$title = $array_title[$key];
					
					$website = $value;	
	
					$database->query("INSERT INTO scans (`sub`,`position`,`date`,url,keyword,title) VALUES('$id','$position','$date','$website','$keyword','$title')"); 
					
					$added = 'yes';
				}			
			}
		}
		if ($added !='yes') {
			$database->query("INSERT INTO scans (`sub`,`position`,`date`,url,keyword,title) VALUES('$id','-','$date','-','$keyword','$title')"); 	
		}
		unset($array_web,$array_title,$added);
		
		
		
	}	

}
if (isset($_POST['scan'])) {
	$i=1;
	$count = $database->num_rows("SELECT * FROM tracker");
	$sql = $database->query("SELECT * FROM tracker");
	while ($row=mysql_fetch_assoc($sql)) {	
		
		$today = date("Y-m-d");
		
		$last = mysql_fetch_assoc($database->query("SELECT * FROM scans WHERE url = '{$row['url']}' AND keyword = '{$row['keyword']}'"));
		$last = date("Y-m-d",strtotime($last['date']));
		
		if (($last <= $today || $last=='') && $row['status'] == 1) {
			
			//$Start = getTime();	
			scan($row['id'],$row['url'],$row['keyword'],$database);						
			sleep(4);			
			//$End = getTime(); echo "Time taken = ".number_format(($End - $Start),2)." secs<br>";
			if ($i==$count) {
				break;
			}
			
		} else {
		
			$msg[] = '<span style="font-weight:bold">#'.$i.'</span> | &nbsp;&nbsp;כתובת אתר:<strong>'.$row['url'].'</strong>&nbsp;&nbsp; למילת חיפוש:&nbsp;&nbsp;<strong>'.$row['keyword'].'</strong>&nbsp;&nbsp; כבר נסרק היום, ניתן לסרוק פעם ביום!';	
		}
	$i++;	
	}
	
}

if (isset($_POST['delete'])) {
	
	$total = $_POST['total'];
	$i=1;
	while ($i <= $total) {
		$item   = $_POST["item$i"];
		$check = $database->num_rows("SELECT * FROM tracker WHERE id = '$item'");
		if ($check > 0) {
			$database->query("DELETE FROM tracker WHERE id = '$item'");
		}
		$i++;
	}
	
}

if (isset($_POST['save'])) {
	
	$total = $_POST['total'];
	$i=1;
	while ($i <= $total) {
		$id     = $_POST["id$i"];
		$status = $_POST["status$i"];	
		$check  = $database->num_rows("SELECT * FROM tracker WHERE id = '$id'");
		if ($check > 0) {
			$database->query("UPDATE tracker SET status = '$status' WHERE id = '$id'");
		}
		$i++;
	}
	
}

if (isset($_POST['addkey'])) {	
	
	$keyword = trim($_POST['keyword']);
	$url     = urldecode($_POST['url']);
	$date    = date("Y-m-d , H:i");
	$status  = '1';
	$brand   = $_POST['brand'];
	
	if (strpos($url,'http://')===false) {	$url = 'http://'.$url;	}
	
	if (strpos($keyword,",")!==false) {
		
		$exploded = explode(",",$keyword);
		foreach ($exploded as $value) {		
			$database->query("INSERT INTO tracker (`brand`,`keyword`,`url`,`date`,`status`) VALUES ('$brand','$value','$url','$date','$status')");			
		}
		
	} else {
		$database->query("INSERT INTO tracker (`brand`,`keyword`,`url`,`date`,`status`) VALUES ('$brand','$keyword','$url','$date','$status')");
	}
}
if (isset($_POST['addbrand'])) {	
	
	$brand  = trim($_POST['brand']);
	$status = 1;
	$date   = date("Y-m-d , H:i");
	
	$database->query("INSERT INTO brands (`name`,`date`,`status`) VALUES ('$brand','$date','$status')");	

}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<title><?=$title?></title>
<link href="tracker_css.css" rel="stylesheet" type="text/css">
<?=$css?>
<script type="text/javascript" src="js/jquery1.6.1.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".CHECK").click(function() {
		if ($(this).is(":checked")) {
			$(this).parent().parent().css("background-color","#f0b9b9");
		} else {			
			$(this).parent().parent().css("background-color","#e8e8e8");
		}
	});
	
	$(".TSCLICK").click(function() {
		$(this).parent().parent().next(".SHOW").toggle();
	});
	
	
});

</script>
</head>

<body>
<div class="CONTAINER">
  <div class="TOP"><? include "include/top.php"; ?></div>
  <div class="MIDDLE">
  	<BR>
  	<form action="" method="get">
    	<?
		if (count($languages) > 1) {
		echo $lang_text;			
		?> 
		<select name="lang">
			<?
			foreach ($languages as $key=>$value) {
			?>
			<option value="<?=$key?>"<? if ($_GET['lang']==$key) { ?> selected<? }?>><?=$value?></option>
			<?
			}
			?>
		</select>
        <input type="submit" value="Go" class="ABTN">
		<? } ?>
    </form>
    <form action="" method="post">
    <table class="ADDURL">
        <tr>
            <td></td>
            <td><h2>הוסף חיפוש</h2></td>
        </tr>
        <tr>
            <td>מילות מפתח (מופרדות ב ","):</td>
            <td><input type="text" name="keyword" class="TEXTINPUT2"></td>
        </tr>
        <tr>
            <td>כתובת האתר:</td>
            <td><input type="text" name="url" class="TEXTINPUT2" value="<?=$_SERVER['SERVER_NAME']?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="addkey"  class="ABTN">הוסף מילות חיפוש</button></td>        
        </tr>
    </table>
    </form>
    <? 
	if (isset($msg)) {
		
		echo '<span style="color:RED; font-weight:bold">שגיאות:</span><br><ul class="ERRORS">';
		
		foreach($msg as $value) {
			
			echo '<li>'.$value.'</li>';
			
		}
		echo '</ul><br><br>';
	}
	?>
    <form action="" method="post"> 
    <input type="hidden" name="lang" value="<?=$_GET['lang']?>">   
  	<br><br><br>    
    <div class="TABLE">
    	<table>
        	<?
			switch($_GET['lang']) {
				case('he'):
					?>            
            <tr class="TRH">
                <th class="TH1 THB"></th>
                <th class="TH2 THB">#</th>
                <th class="THB">שם האתר</th>
                <th class="THB">מילת מפתח</th>
                <th class="THB">כתובת</th>
                <th class="THB">מיקום</th>
                <th class="THB">סטטוס</th>
                <th class="THB">תאריך</th>                
                <th class="THB">עוד</th>
            </tr>
                    <?
					break;
				default:
					?>
           <tr class="TRH">
                <th class="THB"></th>
                <th class="THB">#</th>
                <th class="THB">Brand</th>
                <th class="THB">Keyword</th>
                <th class="THB">Url</th>
                <th class="THB">Position</th>
                <th class="THB">Status</th>
                <th class="THB">Date</th>
                <th class="THB">More</th>
            </tr>
                    <?
					break;					
			}
        	?>
            <?
			$i = 1;
			$sql = $database->query("SELECT * FROM tracker ORDER BY id ASC");
			while ($row=mysql_fetch_assoc($sql)) {
				unset($lastposition,$lasturl);
				if ($row['url']!='') {
					$last = $database->query("SELECT * FROM scans WHERE url LIKE '{$row['url']}%'  AND keyword = '{$row['keyword']}' ORDER BY date DESC LIMIT 1");
					while ($row2=mysql_fetch_assoc($last)) {				
							$lastposition[] = $row2['position'];
							$lasturl[] = $row2['url'];		
					}
				}
			?>	
			<tr class="THHO">
				<td class="TSR"><input type="checkbox" name="item<?=$i?>" value="<?=$row['id']?>"><input type="hidden" name="id<?=$i?>" value="<?=$row['id']?>"></td>
				<td class="TSR"><?=$i?></td>
                <td class="TSR"><? $exurl = explode("/",$row['url']); echo $exurl[1]; ?></td>
				<td class="TSR"><?=$row['keyword']?></td>
				<td class="TSR" style="direction:ltr"><a href="<?=$lasturl[0]?>" target="_blank"><?=$lasturl[0]?></a></td>
				<td class="TSR">
				   <strong><? if (!isset($lastposition))  { echo '-'; } else { echo $lastposition[0]; } ?></strong>
				</td>
				<td class="TSR">
					<select name="status<?=$i?>">
						<option value="1" <? if ($row['status'] == 1) { ?> selected <? }?>>Active</option>
						<option value="0" <? if ($row['status'] == 0) { ?> selected <? }?>>Deactive</option>
					 </select>
				</td>
				<td class="TSR"><?=date("Y-m-d , H:i",strtotime($row['date']))?></td>				
			  <td class="TSR"><span style="text-decoration:underline; color:#03C; cursor:pointer;" class="TSCLICK">View history</span></td>
			</tr>
			<tr class="SHOW" style="display:none">
				<td colspan="9">
				<table class="TRACKLIST2">
					<tr>
						<th class="THB">#</th>
						<th class="THB">כותרת העמוד</th>
						<th class="THB">כתובת מלאה של העמוד</th>
						<th class="THB">מיקומים אחרונים</th>
						<th class="THB">תאריך סריקה</th>
					</tr>
				<?
				$j=1;
				$sql2 = $database->query("SELECT * FROM scans WHERE sub = '{$row['id']}' GROUP BY url ORDER BY position ASC");
				while ($row2=mysql_fetch_assoc($sql2)) {
					 $sql3 = $database->query("SELECT * FROM scans WHERE sub = '{$row['id']}' AND url = '{$row2['url']}' ORDER BY position ASC LIMIT 10");
					 while ($row3=mysql_fetch_assoc($sql3)) {
						 $laster[] = $row3['position'];
					 }
					 if (is_array($laster)) {
						$laster = implode(" > ",$laster);	 
					 }
				?>
					<tr>
						<td class="TSH"><?=$j?></td>
						<td class="TSH"><?=$row2['title']?></td>
						<td class="TSH" style="direction:ltr"><a href="<?=$row2['url']?>" target="_blank"><?=urldecode($row2['url'])?></a></td>
						<td class="TSH"><strong><?=$laster?></strong></td>
						<td class="TSH"><?=date("Y-m-d , H:i",strtotime($row2['date']))?></td>
					</tr>        
				<?
					unset($laster);
				$j++;
				}
			?>
				</table>
				</td>
			</tr>
			<?	
			$i++;
			}
			?>
			<input type="hidden" name="total" value="<?=$i?>">          
            <tr class="TDBG2">
            	<td></td>
            	<td colspan="8"></td>
            </tr>
             <tr class="TDBG2">
            	<td></td>
            	<td colspan="8"><input type="submit" name="save" value="<?=$save_text?>" class="ABTN"> <input type="submit" name="delete" value="<?=$delete_text?>" class="ABTN"> <input type="submit" name="scan" value="סרוק מילים" class="ABTN"></td>
            </tr>
        </table>
    </div>
    </form>  
  </div>
  <div class="FOOTER">© All rights reserved to Dreamax Ltd 2011</div>

</div>
</body>
</html>