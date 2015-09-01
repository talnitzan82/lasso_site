        <ul>
        <?
		if ($page['sub']!=0) {
			$sql = "SELECT * FROM pages WHERE sub = '{$page['sub']}' AND hide != 'yes' AND name !='' AND template !='' AND language = '$lang' ORDER BY sort ASC";
		} else {
			$sql = "SELECT * FROM pages WHERE id = '{$page['id']}' AND hide != 'yes' AND name !='' AND template !=''  AND language = '$lang' ORDER BY sort ASC";
		}
		$query = $database->query($sql);
		while($row=mysql_fetch_assoc($query)) {
			$link = GetLink($row);
			$sql2 = "SELECT * FROM pages WHERE sub = '{$row['id']}' AND hide != 'yes' AND name !='' AND template !='' AND language = '$lang' ORDER BY sort ASC";
			$num = $database->num_rows($sql2);
			if ($num>0 && MenuLimits($row['template'],$TemplateLimits)==true) {
				$query2 = $database->fetch($sql2);
				$link = GetLink($query2);
			}
			if ($page['sub']==$row['id'] || $row['id']==$page['id']) { $class = ' class="SEL"'; } else { unset($class); }
		?>
       	   <li<?=$class?>><a href="<?=$pat?><?=$link?>"<?=$class?>>• <?=$row['name']?></a>
    	      <?
		      if ($right_menu_level > 1 && MenuLimits($row['template'],$TemplateLimits)==true) {
				  echo '<ul>';		     	  
		     	  $query2 = $database->query($sql2);
		     	  while($row2=mysql_fetch_assoc($query2)) {
			      	  $link = GetLink($row2);
		     	  ?>
       	     	  <li><a href="<?=$pat?><?=$link?>">• <?=$row2['name']?></a>
    	      	  <?		   
		      	  }
				   echo '</ul>';
		      }
		      ?>
           </li>
        <?
		}
		?>
       </ul>
       <div class="PCRC"></div>