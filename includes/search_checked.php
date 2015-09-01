<?
	if (!empty($params)) {
	?>
	 <div class="search-pannel seachslot">
     	<?
		foreach ($params as $value) {
			if ($value!='') {
				$link = HandleSearch($value,$params);
			?>
    	<a href="<?=$link?>" class="seachslotb"><div class="seachslotx"></div><?=str_replace(array("_","0"),array(" ","\\"),$value)?></a>
        	<?
			}
		}
		?>
    </div>
    <?
	}