  
    <div id="tellfriend" class="contact_form2"<? if (isset($_POST['sendtofriend'])) {?> style="display:block"<? } ?>>
     <a class="close" href="javascript:void()" >סגור</a>
     <div class="SUC1 SUC1C" style="display:<?=($success!='yes') ? 'block' : 'none' ?>">
     <form id='tellafriend_form' method="post" action=""  >
    	<input type="hidden" name="pagename" value="<?=$page['name']?>" />
        <label for="from">אימייל: </label>
         <input class="std_input" type="text" id="from" name="to" 
         size="40" maxlength="35" value="" />
    
         <label for="name">שם מלא: </label>
         <input class="std_input" type="text" id="name" name="name" 
         size="40" maxlength="35" value="" />
    
         <label for="subject">נושא: </label>
         <input class="std_input" type="text" id="subject" 
         name="subject" size="40" value='<?='תסתכל על זה- "'.$page['name'].'" - לאסו'?>' />
    
         <label for="message">הודעה: </label>
         <textarea id="message" name="message" readonly rows="4" cols="40"><?='היי בוא תראה מה מצאתי בלאסו : "קישור לעמוד זה"'?>
         </textarea>
         <br />
         <input type="submit" name="sendtofriend" class="send-to-friend" value="שלח במייל לחבר"/>
    </form> 
    </div>
    <div class="SUC2" style="display:<?=($success=='yes') ? 'block' : 'none' ?>">
    	<br><br>
    	ההודעה נשלחה בהצלחה. תודה רבה והמשך גלישה נעימה.
    </div>
    </div>
    <script>
		jQuery.fn.fadeToggle = function(speed, easing, callback) {
			return this.animate({opacity: 'toggle'}, speed, easing, callback);  
		};
	
    </script>