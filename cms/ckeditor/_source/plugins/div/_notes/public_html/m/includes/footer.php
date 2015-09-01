<div class="row-fluid">
	<div class="span12">
	<div class="footer-content row-fluid">
    <div class="clearfix footer-row">

		
        <div class="FOOTERLINKS">
           <?
           if ($template[0]=='product.php' && $page['content3']!='') {
               echo $page['content3'];
           } else {
               echo $global['footer'];
           }
           ?>
        </div>
			<div class="social">
        <ul class="social-icons">
            <li><a href="https://www.facebook.com/lasso.co.il" class="fb">&nbsp;</a></li>
            <? /*<li><a href="#" class="twitt">&nbsp;</a></li> */ ?>
            <li><a href="mailto:info@lasso.co.il" class="mail">&nbsp;</a></li>
        </ul>
		</div>		
    </div>
	<div class="container-fluid bottom-line">
	<div class="row-fluid">
    <div class=" clearfix">
        <div class="footer-logo clearfix span6"><img src="<?=$root?>img/footer-logo.png" alt="" />&copy; כל הזכויות שמורות ללאסו <?=date("Y")?><? if (date("Y")<2013) {?>-2013<? }?></div>
        <span class="footnote span6">עיצוב: <a href="http://www.andromedia.co.il/" target="_blank">AndromediA</a> / פיתוח: <a href="http://www.dreamax.co.il" target="_blank">Dreamax</a></span>
    </div>
	</div>
	</div>
	
		</div>
	</div>
</div>
<?=$global['script_footer']?>