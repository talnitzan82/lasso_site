<?
if (isset($_POST['compareb'])) {
	$compare_array = $database->mysql_prep(implode("_",$_POST['compare']));
	if ($compare_array!='') {
		/*
		$sql = "SELECT * FROM products WHERE id in ($compare_array)";
		$query=$database->query($sql);
		while($row=mysql_fetch_assoc($query)) {
			
			$params			
						
		}
		*/
		$post_link = Encode($compare_array,19);
		header("location: /השוואה/".$post_link);
	}
}
if (isset($_POST['sendtofriend'])) {
	
	$to      = $_POST['to'];
	$name    = $_POST['name'];
	$subject = $_POST['subject'];

	$message = str_replace("קישור לעמוד זה",'<a href="https://'.$_SERVER['SERVER_NAME'].urldecode($_SERVER['REQUEST_URI']).'">'.$_POST['pagename'].'</a>',str_replace("\\","",$_POST['message']));
	
	if ($to!='' && $subject!='' && $message!= '') {
		$sender = 'info@lasso.co.il';
		if (SubmitEmail($sender,$subject,$message,$to)==true) {
			$success = 'yes';
			$msg = 'ההודעה נשלחה בהצלחה';
		}

	}
	
	
}

if (isset($_POST['more'])) {
	include_once "../../includes/sessions.php";
	include_once "../../includes/db.php";
	include_once "../../includes/database.php";
	include_once "../../includes/languages.php";
	include_once "../../includes/form.php";
	include_once "../../includes/config.php";
	include_once "../../includes/functions.php";
	
	include_once "config.php";
	include_once "functions.php";
	
	$id  = $database->mysql_prep($_POST['id']);
	$url = $_POST['url'];
	$_SERVER['REQUEST_URI'] = '/'.$url;

	include_once "handle_params.php";
	
	foreach ($params as $value) {
		
		?>
        <div style="display:none">
        <input type="checkbox" name="checkbox[]" url="<?='/'.str_replace(array(" ","\\"),array("_","0"),$value)?>" checked="checked" />

        </div>
        <?	
		
	}

	$id  = $database->mysql_prep($_POST['id']);
	$main = mysql_fetch_assoc($database->query("SELECT * FROM categories where id = $id"));
	?>
<form action="/includes/forms.php" method="post" class="jNice no-margin clearfix">
<input type="hidden" name="url" value="<?=$url?>" />
<div class="EFCLOSE">סגור בחירה מרובה X</div>
<h3 class="H3F"><?=$main['name']?></h3>
<ul class="options-list options-listf">
	<?
    $counter = 1;
    $sql = "SELECT * FROM categories WHERE sub = '$id' ORDER BY sort DESC";
    $query = $database->query($sql);
    while($row=mysql_fetch_assoc($query)) {
		?>
        <li class="dark-gray dark-gray3 dark-gray3f">
        	<div class="squaredThree">
            	<?
				if (!in_array(str_replace(array(" ","\\"),array("_","0"),$row['name']),$params)) {
					$in_array = 0;	
				} else {
					$in_array = 1;
				}
				?>
                <input type="checkbox" id="squaredThree<?=$row['id']?>" <? if ($in_array==0) {?>name="checkbox[]"<? } ?> value="<?=str_replace(array(" ","\\"),array("_","0"),$row['name'])?>" url="<?='/'.str_replace(array(" ","\\"),array("_","0"),$row['name'])?>" />
                <label for="squaredThree<?=$row['id']?>"></label>
                <span><?=$row['name']?></span>
            </div>        	
        </li>
        <?
		/*
        $sql2 = "SELECT * FROM categories WHERE sub = '{$row['id']}' ORDER BY sort DESC";
        $query2 = $database->query($sql2);
        while($row2=mysql_fetch_assoc($query2)) {			
            
            $link = HandleSearch($row2['name']);
            $all_links[] = $row2['name'];
            ?>                            
        <li class="dark-gray dark-gray3 dark-gray3f">
        	<div class="squaredThree">
                <input type="checkbox" id="squaredThree<?=$row2['id']?>" name="checkbox[]" value="<?=str_replace(" ","_",$row2['name'])?>" />
                <label for="squaredThree<?=$row2['id']?>"></label>
                <span><?=$row2['name']?></span>
            </div>        	
        </li>
            <?

        }
		*/


    $counter++;
    }
    ?>
</ul>
<div class="search-submitter">
    <input type="button" value="" name="filter" class="submit-options" />
</div>
</form>
<?			
	
	
	
}

if (isset($_POST['filter'])) {
	
	include_once "../../includes/sessions.php";
	include_once "../../includes/db.php";
	include_once "../../includes/database.php";
	include_once "../../includes/languages.php";
	include_once "../../includes/form.php";
	include_once "../../includes/config.php";
	include_once "../../includes/functions.php";
	
	include_once "config.php";
	include_once "functions.php";
	
	$url=mb_substr(urldecode($_SERVER['REQUEST_URI']),1);
	$url = $_POST['url'];

	$params=explode("-",$url);
	if ($params[0]=='') { unset($params[0]); }
	foreach ($_POST['checkbox'] as $value) {
		if ($value!=''){ 
			$params[] = $value;
		}
	}
	$new_url = implode("-",$params);
	header('location: /'.$new_url);
	
	
}
?>