		<?
		  $find = array_reverse($find);
		  $count = count($find)-1;
          $i=1;
          $total = ceil($database->num_rows($sql2) / $limit);
          while ($i < $total) {
			 
              if (is_numeric($find[$count])) {
				  unset($find[$count]);
			  }
			  $link = '/';			  			
			  foreach($find as $val) {
				  if (trim($val)!='') {
					  //echo $val."<br>";
					$link .= urldecode($val).'/';
				  }
			  }
			  $link.=$i."/";
			  if ($i == $old_num) { $class=' class="SEL"'; } else { $class=''; }			  			  
            ?>
            <a href="<?=$link?>"<?=$class?>><?=$i?></a>
            <?  
            $i++;
          }
          ?>