<?
if ($_SESSION['LOGGED']==TRUE) {
	  ?>
      <img src="images/logo.png" alt="" style="height:90px;">
      <div class="ACTIONS"><a href="logout.php"><img src="images/logout.png" alt="" title="Logout"><br><?=$logout_text?></a></div>
      <div class="ACTIONS"><a href="settings.php<?='?'.substr($lang_link,1)?>"><img src="images/global.png" alt="" title="Global Settings"><br><?=$global_text?></a></div>
      <div class="ACTIONS"><a href="pages.php<?='?'.substr($lang_link,1)?>"><img src="images/editpages.png" alt="" title="Edit Pages"><br><?=$edit_pages_text?></a></div>
      <div class="ACTIONS"><a href="categories.php<?='?'.substr($lang_link,1)?>"><img src="images/lists.png" alt="" title="Edit Categories"><br><?=$edit_lists_text?></a></div>
      <div class="ACTIONS"><a href="products.php<?='?'.substr($lang_link,1)?>"><img src="images/products.png" alt="" title="Edit Products"><br><?=$edit_products_text?></a></div>


      <?
	  if ($_SESSION['ROLE']=='1') {
	  ?>
      <div class="ACTIONS"><a href="tracker.php<?='?'.substr($lang_link,1)?>"><img src="images/editpages.png" alt="" title="Edit Pages"><br>כלי קידום</a></div>
      <div class="ACTIONS"><a href="languages.php<?='?'.substr($lang_link,1)?>"><br><br><br><br><br><?=$edit_languages_text?></a></div>
      <div class="ACTIONS"><a href="templates.php<?='?'.substr($lang_link,1)?>"><br><br><br><br><br><?=$edit_templates_text?></a></div>
      <?
	  }
}
?>