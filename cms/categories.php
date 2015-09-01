<?
$table = "categories";
include "../../includes/config.php";
include $includes_dir ."includes/sessions.php";
include $includes_dir ."includes/db.php";
include $includes_dir ."includes/auth.php";
include $includes_dir ."includes/database.php";
include $includes_dir ."includes/languages.php";
include $includes_dir ."includes/templates.php";
include $includes_dir ."includes/categories.php";
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
    <form action="" method="post"> 
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
                <th class="TH2 THB">שם</th>
                <th class="TH5 THB">הסתרה</th>
                <th class="TH5 THB">הצפה</th>
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
                <th class="TH4 THB">Template</th>
                <th class="TH5 THB">Edit</th>
                <th class="TH5 THB">Hide</th>
                <th class="TH5 THB">front</th>
                <th class="TH3 THB">Actions</th>
            </tr>
                    <?
					break;					
			}
        	?>
            <?
			$i=0;
			$sql   = "SELECT * FROM $table WHERE sub = 0 ORDER BY sort DESC";			
			$query = $database->query($sql);
			while ($row=mysql_fetch_assoc($query)) {
				$i++;
				$add = '';
				include $includes_dir ."includes/templates.php";
				$dril = 1;
				include "include/crow.php";
				$dril = 2;
				$sql2   = "SELECT * FROM $table WHERE sub = '{$row['id']}' ORDER BY sort DESC";
				$query2 = $database->query($sql2);
				while ($row2=mysql_fetch_assoc($query2)) {
					$i++;
					$row = $row2;
					include $includes_dir ."includes/templates.php";
					$add = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_ ';				
					include "include/crow.php";
					
					$sql3   = "SELECT * FROM $table WHERE sub = '{$row2['id']}' ORDER BY sort DESC";
					$query3 = $database->query($sql3);
					while ($row3=mysql_fetch_assoc($query3)) {
						$i++;
						$row = $row3;
						include $includes_dir ."includes/templates.php";
						$add = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_ ';				
						include "include/crow.php";	
						
						$sql4   = "SELECT * FROM $table WHERE sub = '{$row3['id']}' ORDER BY sort DESC";
						$query4 = $database->query($sql4);
						while ($row4=mysql_fetch_assoc($query4)) {
							$i++;
							$row = $row4;
							include $includes_dir ."includes/templates.php";
							$add = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_ ';				
							include "include/crow.php";				
						}  			
					}  
									
				}	          
			
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