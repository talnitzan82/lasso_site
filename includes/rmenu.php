   <?
   $sql = "SELECT * FROM pages WHERE sub = '{$page['id']}' OR (sub = '{$page['sub']}' AND sub!='0') AND hide!='yes' ORDER BY sort ASC";
   if ($database->num_rows($sql)>0) {
	   $sub_menu = true;
   ?>
   <div class="RSUB">
        <ul>
            <?			
            $query = $database->query($sql);
            while($row=mysql_fetch_assoc($query)) {
               $link = GetLink($row);
            ?>
            <li><a href="<?=$link?>"><?=$row['name']?></a></li>
            <?	
            }						
            ?>
        </ul>
   </div>
   <?
   }
   ?>