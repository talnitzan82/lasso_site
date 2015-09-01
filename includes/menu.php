		<?
		$sql = "SELECT * FROM pages WHERE sub = 0 AND hide != 'yes' AND hide_menu != 'yes' AND name !='' AND template !='' AND language = '$lang' ORDER BY sort ASC";
		$query = $database->query($sql);
		while($row=mysql_fetch_assoc($query)) {
			$link = GetLink($row);
			if(strpos($row['template'],'index')!==false) { 
				$link ='/';
				$class = ' class="active"';
			}
			$sql2 = "SELECT * FROM pages WHERE sub = {$row['id']} AND hide != 'yes' AND hide_menu != 'yes' AND name !='' AND template !='' AND language = '$lang' ORDER BY sort ASC";
			$num = $database->num_rows($sql2);
			if ($num>0 && MenuLimits($row['template'],$TemplateLimits)==true) {
				//$query2 = $database->fetch($sql2);
				//$link = GetLink($query2);
			}
			if ($page['id']==$row['id'] || $page['sub']==$row['id']) { $class = ' class="active"'; } else { unset($class,$style); }
		?>
       	   <li<?=$class?><? if ($menu_level > 1 && $num >0 && MenuLimits($row['template'],$TemplateLimits)==true) { ?> class="sub-menu"<? }?>><a href="<?=$pat.$link?>"><?=$row['name']?></a>
    	      <?
		      if ($menu_level > 1 && $num >0 && MenuLimits($row['template'],$TemplateLimits)==true) {
				  echo '<ul>';		     	  
		     	  $query2 = $database->query($sql2);
		     	  while($row2=mysql_fetch_assoc($query2)) {
			      	  $link = GetLink($row2);
					  $sql3 = "SELECT * FROM pages WHERE sub = {$row2['id']} AND hide != 'yes' AND hide_menu != 'yes' AND name !='' AND template !='' AND language = '$lang' ORDER BY sort ASC";
					  $num2 = $database->num_rows($sql3);
					  if ($num2>0 && MenuLimits($row2['template'],$TemplateLimits)==true) {
					  	  //$query3 = $database->fetch($sql3);
					      //$link = GetLink($query3);
					  }
		     	  ?>
       	     	  <li><a href="<?=$pat?><?=$link?>"><?=$row2['name']?></a>
                  <?
				  if ($menu_level > 2 && $num2 >0 && MenuLimits($row2['template'],$TemplateLimits)==true) {
					  echo '<ul>';		     	  
					  $query3 = $database->query($sql3);
					  while($row3=mysql_fetch_assoc($query3)) {
						  $link = GetLink($row3);
					  ?>
					  <li><a href="<?=$pat?><?=$link?>"><?=$row3['name']?></a></li>
					  <?
					  }
					  echo '</ul>';
				  }
				  ?>
                  </li>
    	      	  <?
		      	  }
				  echo '</ul>';
		      }
		      ?>
           </li>
        <?
		}
		?>