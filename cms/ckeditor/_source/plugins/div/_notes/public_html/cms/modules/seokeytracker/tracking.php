<?
set_time_limit(0);

function scan($id,$url,$keyword,$database,$count=100) {

	$keyword_fixed = str_replace(" ","+",$keyword);
	
	$baseurl = "http://www.google.co.il/search?num=$count&hl=iw&q=$keyword_fixed";
	$baseurl = "http://www.google.com/search?num=$count&hl=iw&q=$keyword_fixed";
	$curlpage = $baseurl;
	//echo $curlpage."<br>";
	//die;

	
	$i=0;
	$limit = 1;
	while ($i<=$limit) {
		
		if ($i >= 1) {
			//$curlpage = $url."&start=".$i;
			$curlpage = $baseurl."&start=".($i*$count);
		}
		//echo $curlpage."<br>";
		
		$ch = curl_init($curlpage);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
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
		
		sleep(2);		
		
	$i++;		
	}	
	
	if (is_array($array_web)) {
		foreach ($array_web as $key=>$value) {	
			
			if (strpos($value,$url)!==false) {			
				$position = $key + 1;
				
				$date = date("Y-m-d , H:i");
				$yesterday = date("Y-m-d , H:i",strtotime("yesterday"));
				
				$title = $array_title[$key];
				
				$website = $value;
				
				$checker = $database->num_rows("SELECT * FROM scans WHERE date = '$yesterday' AND url = '$website' AND position = '$position'");
				if ($checker==0) {			
					$database->query("INSERT INTO scans (`position`,`date`,url,keyword,title) VALUES('$position','$date','$website','$keyword','$title')"); 
				}
			}			
		}
	}
	


}
if (isset($_POST['scan'])) {
	$i=1;
	$sql = $database->query("SELECT * FROM tracker");
	while ($row=mysql_fetch_assoc($sql)) {	
		
		$today = date("Y-m-d");
		
		$last = mysql_fetch_assoc($database->query("SELECT * FROM scans WHERE url = '{$row['url']}' AND keyword = '{$row['keyword']}'"));
		$last = date("Y-m-d",strtotime($last['date']));
		
		if ($last <= $today && $row['status'] == 1) {
		
			scan($row['id'],$row['url'],$row['keyword'],$database);
			
		} else {
		
			$msg[] = '<span style="font-weight:bold">#'.$i.'</span> | &nbsp;&nbsp;Url:<strong>'.$row['url'].'</strong>&nbsp;&nbsp; for Keyword:&nbsp;&nbsp;<strong>'.$row['keyword'].'</strong>&nbsp;&nbsp; Already scanned today!';	
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<script type="text/javascript" src="js/jquery1.6.1.js"></script>
<link href="stylesheets.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
$(document).ready(function() {
	$(".TSCLICK").click(function() {
		$(this).parent().parent().next(".SHOW").toggle();
	});
	
});
</script>
</head>

<body>
<div class="CONTAINER">
<div style="text-align:center"><img src="images/logo.jpg"></div>
<div class="MENU">
  <ul>
     <li><a href="tracking.php">Keyword Tracker</a></li>
     <li><a href="tracking.php">Branding Management</a></li>
  </ul>
</div>
<br><br>
<? 
if (isset($msg)) {
	
	echo '<span style="color:RED; font-weight:bold">Errors:</span><br><ul class="ERRORS">';
	
	foreach($msg as $value) {
		
		echo '<li>'.$value.'</li>';
		
	}
	echo '</ul><br><br>';
}
?>
<form action="" method="post">
<table class="ADDURL">
	<tr>
    	<td></td>
    	<td ><h2>Add Brand</h2></td>
    </tr>
	<tr>
    	<td>Brand Name:</td>
        <td><input type="text" name="brand"></td>
    </tr>
    <tr>
    	<td></td>
    	<td><button type="submit" name="addbrand" class="BUTTON">Add Brand</button></td>        
    </tr>
    <tr>
    	<td><br><br></td>
    </tr>
</table>
</form>
<form action="" method="post">
<table class="ADDURL">
	<tr>
    	<td></td>
    	<td><h2>Add Url</h2></td>
    </tr>
    <tr>
    	<td>Brand:</td>
        <td>
        <select name="brand">
        	<option value="">-- select brand --</option>
       	<?
			$sql = $database->query("SELECT * FROM brands WHERE sub = '{$_SESSION['USERID']}'");
			while ($row=mysql_fetch_assoc($sql)) {
				?>
                <option value="<?=$row['id']?>"><?=$row['name']?></option>
                <?
			}
			?>
        </select>
        </td>
    </tr>
	<tr>
    	<td>Keyword:</td>
        <td><input type="text" name="keyword"></td>
    </tr>
    <tr>
    	<td>Url:</td>
        <td><input type="text" name="url"></td>
    </tr>
    <tr>
    	<td></td>
    	<td><button type="submit" name="addkey"  class="BUTTON">Add Keyword</button></td>        
    </tr>
</table>
</form>
<br><br>
<form action="" method="get">
<select name="brand">
    <option value="">-- select brand --</option>
	<?
    $sql = $database->query("SELECT * FROM brands WHERE sub = '{$_SESSION['USERID']}'");
    while ($row=mysql_fetch_assoc($sql)) {
        ?>
        <option value="<?=$row['id']?>"><?=$row['name']?></option>
        <?
    }
    ?>
</select>
<button type="submit" name="selectbrand"  class="BUTTON">select brand</button>
</form>
<form action="" method="post">
<table class="TRACKLIST">
	<tr>
    	<th></th>
    	<th>#</th>
        <th>Keyword</th>
        <th>Url</th>
        <th>Position</th>
        <th>Status</th>
        <th>Date</th>
        <th>Brand</th>
        <th>More</th>
    </tr>
    <?
	$i = 1;
	$sql = $database->query("SELECT * FROM tracker WHERE sub = '{$_SESSION['USERID']}' ORDER BY id ASC");
	while ($row=mysql_fetch_assoc($sql)) {
	?>	
    <tr>
    	<td class="TSR"><input type="checkbox" name="item<?=$i?>" value="<?=$row['id']?>"><input type="hidden" name="id<?=$i?>" value="<?=$row['id']?>"></td>
    	<td class="TSR"><?=$i?></td>
    	<td class="TSR"><?=$row['keyword']?></td>
        <td class="TSR"><a href="<?=$row['url']?>" target="_blank"><?=$row['url']?></a></td>
        <td class="TSR">
            <?
			unset($lastposition);
			if ($row['url']!='') {
				$last = $database->query("SELECT * FROM scans WHERE url LIKE '{$row['url']}%'  AND keyword = '{$row['keyword']}' ORDER BY position ASC LIMIT 1");
				while ($row2=mysql_fetch_assoc($last)) {				
						$lastposition[] = $row2['position'];			
				}
			}
		
			?>
           <strong><? if (isset($lastposition)) { if ($lastposition[0]=='') { echo '0'; } else { echo $lastposition[0]; } } ?></strong>
        </td>
        <td class="TSR">
            <select name="status<?=$i?>">
        	    <option value="1" <? if ($row['status'] == 1) { ?> selected <? }?>>Active</option>
                <option value="0" <? if ($row['status'] == 0) { ?> selected <? }?>>Deactive</option>
             </select>
        </td>
        <td class="TSR"><?=date("Y-m-d , H:i",strtotime($row['date']))?></td>
        <td class="TSR">
        <?
		$brand = mysql_fetch_assoc($database->query("SELECT * FROM brands WHERE id = '{$row['brand']}'"));
		echo $brand['name'];
		?>
      </td>
      <td class="TSR"><span style="text-decoration:underline; color:#03C; cursor:pointer;" class="TSCLICK">View history</span></td>
    </tr>
    <tr class="SHOW" style="display:none">
		<td colspan="9">
        <table class="TRACKLIST2">
        	<tr>
                <th>#</th>
                <th>Page Meta Title</th>
                <th>Url</th>
                <th>Last Positions</th>
                <th>Scan Date</th>
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
                <td class="TSH"><a href="<?=$row2['url']?>" target="_blank"><?=urldecode($row2['url'])?></a></td>
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
</table>
<input type="hidden" name="total" value="<?=$i?>">
<div class="TOOLBAR">
   <ul>
   	  <li style="background-color:#757575; width:33px; height:30px;"></li>
      <li><button type="submit" name="delete">Delete Selected</button></li>
      <li><button type="submit" name="save">Save Changes</button></li>
      <li><button type="submit" name="scan"> Scan List</button></li>      
   </ul>
</div>
</form>
</div>
</body>
</html>