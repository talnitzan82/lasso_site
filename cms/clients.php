<?
$table = "biz";
include "../../includes/config.php";
include $includes_dir ."includes/sessions.php";
include $includes_dir ."includes/db.php";
include $includes_dir ."includes/auth.php";
include $includes_dir ."includes/database.php";
include $includes_dir ."includes/languages.php";
include $includes_dir ."includes/templates.php";
include $includes_dir ."includes/clients.php";
include $includes_dir ."includes/functions.php";
include "include/languages.php";
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<title><?=$title?></title>
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
    <input type="hidden" name="lang" value="<?=$_GET['lang']?>">   
  	<br><br><br>    
    <input type="submit" name="add" value="<?=$add_text?>" class="ABTN">
    <div class="TABLE">
    	<table>
        	<?
			switch($_GET['lang']) {
				case('he'):
					?>            
             <tr class="TRH">
            	<th class="TH1 THB">סימון</th>
                <th class="TH5 THB">מיקום</th>
                <th class="TH2 THB">שם הדף</th>                
                <th class="TH5 THB">עריכה</th>
                <th class="TH5 THB">הסתרה</th>
                <th class="TH5 THB">הצפה</th>
                <th class="TH4 THB">מפרסם</th>
                <th class="TH3 THB">פעולות</th>
            </tr>
                    <?
					break;
				default:
					?>
           <tr class="TRH">
            	<th class="TH1 THB">Mark</th>
                <th class="TH5 THB">Order</th>
                <th class="TH2 THB">Page Name</th>                
                <th class="TH5 THB">Edit</th>
                <th class="TH5 THB">Hide</th>
                <th class="TH5 THB">front</th>
                <th class="TH4 THB">Advertise</th>
                <th class="TH3 THB">Actions</th>
            </tr>
                    <?
					break;					
			}
        	?>
            <?
			$i=0;
			$sql   = "SELECT * FROM $table WHERE sub = 0 ORDER BY sort ASC";			
			$query = $database->query($sql);
			while ($row=mysql_fetch_assoc($query)) {
				$i++;
				$add = '';
				include "include/rowbiz.php";        
			
			}
			?>
            <input name="total" type="hidden" value="<?=$i?>">            
            <tr class="TDBG2">
            	<td></td>
            	<td colspan="7"></td>
            </tr>
             <tr class="TDBG2">
            	<td></td>
            	<td colspan="7"><input type="submit" name="save" value="<?=$save_text?>" class="ABTN"> <input type="submit" name="delete" value="<?=$delete_text?>" class="ABTN"></td>
            </tr>
        </table>
    </div>
    </form>  
  </div>
  <div class="FOOTER">© All rights reserved to Dreamax Ltd 2011</div>

</div>
</body>
</html>