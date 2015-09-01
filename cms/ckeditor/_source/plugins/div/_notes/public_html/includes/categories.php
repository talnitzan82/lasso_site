	<!--Search Panel-->
	<div class="search-pannel search-pannel_h sapn12">
    	<div class="search-inside">
        	<div class="search-more"></div>
        	<form class="jNice no-margin clearfix">
                <ul class="search-options-col clearfix">
                	<?
					$counter1 = 1;
					$sql = "SELECT * FROM categories WHERE sub = 0  AND front = 'yes' ORDER BY sort DESC";
					$query = $database->query($sql);
					while($row=mysql_fetch_assoc($query)) {
						$array1[]=$row;
						$counter2 = 0;
						unset($array2,$array2_ids,$all_links,$level2,$array3_counter);
						### This is PRE-checking if all categories already selected
						$sql2 = "SELECT * FROM categories WHERE sub = '{$row['id']}'  AND front = 'yes' AND name!='' ORDER BY sort DESC";
						$query2 = $database->query($sql2);						
						while($row2=mysql_fetch_assoc($query2)) {
						
							if (!in_array(str_replace(array(" ","\\"),array("_","0"),$row2['name']),$params)) {
								$array2[]=$row2;
								$array2_ids[]=$row2['id'];
							} else {
								$level2 = 1;	
							}
							
							if (!in_array($row2['id'],$array2_ids)) {
								$array2_exists[] = $row2;						
								$counter3=0;
								//unset($array3,$array3_ids);
								$sql3 = "SELECT * FROM categories WHERE sub = '{$row2['id']}'  AND front = 'yes' ORDER BY sort DESC";
								
								$query3 = $database->query($sql3);								
								while($row3=mysql_fetch_assoc($query3)) {
									if (!in_array(str_replace(array(" ","\\"),array("_","0"),$row3['name']),$params)) {
										$array3[$row2['id']][]=$row3;
										$array3_ids[$row2['id']][]=$row3['id'];	
										$array3_counter[] = $row3['id'];
										$level3 = 1;																	
									}
									$counter3++;
									$array3_count[$row2['id']] = $counter3;
								}
								
							}
							$counter2++;
						}
			
						foreach ($array2_exists as $value) {
							if (in_array(str_replace(array(" ","\\"),array("_","0"),$value['name']),$params) && !empty($array3)) {	
								$array2 = $array3[$value['id']];
								$counter2 = $array3_counter[$value['id']];
								$level3 = 1;
							}
						}
						/*
						?>
                        <script>
						console.log('<?=$row['name']?>');
						console.log('<?=count($array2).'-'.$counter2?>');
						console.log('<?=count($array3_counter)?>');
						console.log('<?=count($array3_counter).'-'.$counter3?>');
						console.log('<?=$level2?>');
						</script>
                        <?
						*/

						if  (count($array2)==0
							|| 
							( 
								( count($array2)<$counter2 && empty($array3_counter) ) 
								|| 
								( count($array3_counter)<$counter3 && !empty($array3_counter) && $level2==1 )
							)
							&& $row['type']==0)
						{
		
							unset($array3,$array2,$array3_ids,$array2_ids);
							continue;
						}
							
						### END

					
					?>
                    <li class="options-col<? if ($counter1==5) {?> options-col2<? } ?><? if ($row['name']=='תוספות') { ?> options-col4<? } ?>">
                        <h3><?=$row['name']?></h3>
                        <ul class="options-list">
						<?	
				        foreach ($array2 as $key=>$value) {							
							
							if ($key>3 && $row['name']!='תוספות' || $row['name']=='תוספות' && $key>8) { 
								break; 
							}	
							$select_more_test_id = $value['sub'];					
                            $link = HandleSearch(str_replace("\\","0",$value['name']),$params);
                            $all_links[] = str_replace("\\","0",$value['name']);
                            ?>                            
                        	<li class="dark-gray dark-gray3"><a href="<?=$link?>"><?=$value['name']?></a></li>
                            <?
                        }
                        //$all_links = implode("-",$all_links);
                        //$link = HandleSearch($all_links,$params);
						$link = HandleSearchAll($all_links,$params);
	                    unset($array3,$array2,$array3_ids,$array2_ids,$level3,$level2);
                        if ($row['type']!='0') {
                        ?>
                        <? /*<li class="dark-gray dark-gray4"><a href="<?=$link?>">בחר הכל</a></li>*/ ?>
                        <li class="dark-gray dark-gray4 dark-click" id="<?=$select_more_test_id?>" url="<?=$url?>">בחירה מרובה..</li>
                        <?
						}
						?>
                       
                        <?
                        //}
                        ?>
                        </ul>
                    </li>
                    <?
					$counter1++;
					}
					?>
                </ul>
                <?
				/*
                <div class="search-submitter">
                	<input type="text" value="" class="submit-options" />
                    <a href="#"><strong>לאבק בזכות</strong></a>
                </div>
				*/
				?>
            </form>
        </div>
        <?
		if ($counter1>6) {
		?>
		 <div class="search-submitter search-submitter2">
			<strong class="search-submitter-open">חיפוש מורחב</strong>
			<strong class="search-submitter-close">סגור חיפוש מורחב</strong>
		</div>
		<?
		}
		?>
    </div>
	</div>
    <!--/Search Panel-->