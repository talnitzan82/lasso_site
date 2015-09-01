			<?
			$bg = Admin_bg($i,$row);			
			?>
            <tr<?=$bg?>>
            	<td>
                <input type="hidden" name="id<?=$i?>" value="<?=$row['id']?>">
                <input type="checkbox" name="check<?=$i?>" class="CHECK">
                </td>
                <td><input type="text" name="sort<?=$i?>" value="<?=$row['sort']?>" size="1"></td>
                <td><img src="../<?=$row['image']?>" class="GIMG"/></td>
                <td><?=$add?><input type="text" name="name<?=$i?>" value="<?=htmlspecialchars($row['name'])?>" class="INTEXT"><? if ($row['hide']=="yes" || $row['name']=='') { ?><img src=" images/hide.png" alt="" title="Hidden page OR Page name missing"><? } ?></td>
                <td><?=ceil($row['size']/1000)?>kb</td>
                <td><?=$row['filename']?></td>
                <td><input type="checkbox" name="hide<?=$i?>"<? if ($row['hide']=="yes") { ?> checked<? }?>></td>
                <td><input type="checkbox" name="front<?=$i?>"<? if ($row['front']=="yes") { ?> checked<? }?>></td>
                <td><input type="checkbox" name="background<?=$i?>"<? if ($row['background']=="yes") { ?> checked<? }?>></td>
                <td><input type="checkbox" name="logo<?=$i?>"<? if ($row['logo']=="yes") { ?> checked<? }?>></td>
                <td><input type="checkbox" name="repeat<?=$i?>"<? if ($row['repeat']=="yes") { ?> checked<? }?>></td>
                <td><img src="images/delete.png" alt="" class="DI"></td>
            </tr>