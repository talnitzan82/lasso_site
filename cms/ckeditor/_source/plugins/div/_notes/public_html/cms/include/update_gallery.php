<?
$table = "gallery";
include_once "../../../includes/config.php";
include_once "../".$includes_dir ."includes/sessions.php";
include_once "../".$includes_dir ."includes/db.php";
include_once "../".$includes_dir ."includes/auth.php";
include_once "../".$includes_dir ."includes/database.php";
include_once "../".$includes_dir ."includes/languages.php";
include_once "../".$includes_dir ."includes/templates.php";
include_once "../".$includes_dir ."includes/gallery.php";
include_once "../".$includes_dir ."includes/functions.php";
include_once "../"."languages.php";

$sql = "INSERT INTO $table (sub,filename) values ('{$_GET['id']}','{$_GET['filename']}')";
$database->query($sql);

?>
    	<table>
        	<?
			switch($_GET['lang']) {
				case('he'):
					?>            
             <tr class="TRH">
            	<th class="TH1 THB">סימון</th>
                <th class="TH5 THB">מיקום</th>
                <th class="TH2 THB">שם התמונה</th>
                <th class="TH4 THB">גודל התמונה</th>
                <th class="TH5 THB">שם קובץ בשרת</th>
                <th class="TH5 THB">תמונה</th>
                <th class="TH5 THB">הסתרה</th>
                <th class="TH3 THB">פעולות</th>
            </tr>
                    <?
					break;
				default:
					?>
           <tr class="TRH">
            	<th class="TH1 THB">Mark</th>
                <th class="TH5 THB">Order</th>
                <th class="TH2 THB">Image Name</th>
                <th class="TH4 THB">Image Size</th>
                <th class="TH5 THB">File name on Server</th>
                <th class="TH5 THB">Image</th>
                <th class="TH5 THB">Hide</th>
                <th class="TH3 THB">Actions</th>
            </tr>
                    <?
					break;					
			}
        	?>
            <?
			$i=0;
			$sql   = "SELECT * FROM $table WHERE sub = '{$_GET['id']}' ORDER BY sort ASC";			
			$query = $database->query($sql);
			while ($row=mysql_fetch_assoc($query)) {
				$i++;
				$add = '';
				include "grow.php";				          
			
			}
			?>
            <input name="total" type="hidden" value="<?=$i?>">            
            <tr class="TDBG2">
            	<td></td>
            	<td colspan="6"></td>
            </tr>
             <tr class="TDBG2">
            	<td></td>
            	<td colspan="7"><input type="submit" name="save" value="<?=$save_text?>" class="ABTN"> <input type="submit" name="delete" value="<?=$delete_text?>" class="ABTN"></td>
            </tr>
        </table>