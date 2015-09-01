			<?
			$bg = Admin_bg($i,$row);			
			?>
            <tr<?=$bg?>>
            	<td>
                <input type="hidden" name="id<?=$i?>" value="<?=$row['id']?>">
                <input type="checkbox" name="check<?=$i?>" class="CHECK">
                </td>
                <td><input type="text" name="sort<?=$i?>" value="<?=$row['sort']?>" size="1"></td>
                <td><?=$add?><input type="text" name="name<?=$i?>" value="<?=htmlspecialchars($row['name'])?>" class="INTEXT"><? if ($row['hide']=="yes" || $row['name']=='') { ?><img src=" images/hide.png" alt="" title="Hidden page OR Page name missing"><? } ?></td>
                <td><textarea name="content<?=$i?>" class="editor<?=$i?>"><?=$row['content1']?></textarea></td>
                <td><?=ceil($row['size']/1000)?>kb</td>
                <td><?=$row['filename']?></td>
                <td><img src="../<?=$row['image']?>" class="GIMG"/></td>
                <td><input type="checkbox" name="hide<?=$i?>"<? if ($row['hide']=="yes") { ?> checked<? }?>></td>
                <td><input type="checkbox" name="front<?=$i?>"<? if ($row['front']=="yes") { ?> checked<? }?>></td>
                <td><img src="images/delete.png" alt="" class="DI"></td>
            </tr>
            <script type="text/javascript">
			CKEDITOR.replace( 'content<?=$i?>', {
					filebrowserBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor',
					filebrowserImageBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=image',
					filebrowserFlashBrowseUrl : 'pdw_file_browser/index.php?editor=ckeditor&filter=flash',	
					language: '<?=$_GET['lang']?>',
					height : '40px',
					toolbarStartupExpanded : false,
					toolbar :
					[
						{ name: 'basicstyles', items : [ 'Source','Bold','Italic' ] },
						{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
						{ name: 'styles', items : [ 'Format','Font','FontSize' ] },
						{ name: 'colors', items : [ 'TextColor','BGColor' ] }						
					]					
			});
			
			</script>