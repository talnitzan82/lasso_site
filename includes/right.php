		<div class="RIGHTT"><? if ($lang=='en') { ?>Contact us<? } else { ?>צור קשר<? } ?></div>
        <div class="RIGHTC">     
        	   	
            <strong><? if ($lang=='en') { ?>Please fill the form<? } else { ?>אנא מלא את הטופס<? } ?></strong><br>
            <?=$form->LoadForm("",'vertical')?>
            <img src="<?=$root?>images/email.png" alt="דואל">
        </div>