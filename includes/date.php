      <div class="DLINER">	  
      <?
	  $str = jdtojewish(gregoriantojd( date('m'), date('d'), date('Y')), true, CAL_JEWISH_ADD_GERESHAYIM); // for today
	  $str1 = iconv ('WINDOWS-1255', 'UTF-8', $str); // convert to utf-8
	  echo $str1;
	  ?>
      | <?=date("d.m.Y")?>
      </div>
      <div class="DLINEC">
      <?
	  /*
      פורטל <a href="http://www.rahitimtim.co.il" target="_blank">רהיטים</a> | <a href="http://www.rahitimtim.co.il/%D7%97%D7%93%D7%A8%D7%99-%D7%99%D7%9C%D7%93%D7%99%D7%9D" target="_blank">חדרי ילדים</a> | <a href="http://www.rahitimtim.co.il/%D7%90%D7%A8%D7%95%D7%A0%D7%95%D7%AA" target="_blank">ארונות</a> | <a href="http://www.rahitimtim.co.il/%D7%97%D7%93%D7%A8%D7%99-%D7%A9%D7%99%D7%A0%D7%94" target="_blank">חדרי שינה</a> | <a href="http://www.rahitimtim.co.il/%D7%9E%D7%98%D7%91%D7%97%D7%99%D7%9D" target="_blank">מטבחים</a> | <a href="http://www.rahitimtim.co.il/%D7%A9%D7%99%D7%93%D7%95%D7%AA" target="_blank">שידות</a>
      */
	  ?>
	  </div>
      <div class="DLINEL">
        <? include "includes/likebox.php"; ?> 
        <span class="ARTPR"><g:plusone></g:plusone></span>
        <span class="ARTPR">
			<div class="fb-like" data-href="http://www.facebook.com/pages/TopChic-%D7%98%D7%95%D7%A4-%D7%A9%D7%99%D7%A7-%D7%9E%D7%98%D7%A4%D7%97%D7%95%D7%AA-%D7%9E%D7%A2%D7%95%D7%A6%D7%91%D7%95%D7%AA-%D7%95%D7%90%D7%A7%D7%A1%D7%A1%D7%95%D7%A8%D7%99%D7%96/246157078805671" data-send="false" data-width="360" data-show-faces="false"></div>
        </span>
      </div>