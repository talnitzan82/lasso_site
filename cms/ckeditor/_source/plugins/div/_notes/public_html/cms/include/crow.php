			<?
			$bg = Admin_bg($i,$row);			
			?>
            <tr<?=$bg?>>
            	<td>
                <input type="hidden" name="id<?=$i?>" value="<?=$row['id']?>">
                <input type="checkbox" name="check<?=$i?>" class="CHECK">
                </td>
                <td><input type="text" name="sort<?=$i?>" value="<?=$row['sort']?>" size="1"></td>
                <td>
				<?=$add?><input type="text" name="name<?=$i?>" value="<?=htmlspecialchars($row['name'])?>" class="INTEXT"><? if ($row['hide']=="yes" || $row['name']=='') { ?><img src=" images/hide.png" alt="" title="Hidden page OR Page name missing"><? } ?>
                <? if ($dril==1) { ?>                
                <select name="type<?=$i?>">
                	<option value="0"<? if ($row['type']=='0') {?> selected="selected"<? } ?>>רב בחירתי</option>
                    <option value="1"<? if ($row['type']=='1') {?> selected="selected"<? } ?>>בינארי</option>
                </select>
				<? } ?>
                </td>
                <td><input type="checkbox" name="hide<?=$i?>"<? if ($row['hide']=="yes") { ?> checked<? }?>></td>
                <td><input type="checkbox" name="front<?=$i?>"<? if ($row['front']=="yes") { ?> checked<? }?>></td>
                <td><input type="submit" name="add" value="<?=$row['id']?>" class="PADD"></td>
            </tr>