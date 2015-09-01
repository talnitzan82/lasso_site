<script type="text/javascript" src="<?=$root?>js/jquery.js"></script>
<script type="text/javascript" src="<?=$root?>js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?=$root?>js/jquery.kwicks-1.5.1.js"></script>
<script type="text/javascript" src="<?=$root?>js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?=$root?>js/jquery.ui.totop.js"></script>
<script type="text/javascript" src="<?=$root?>js/touchTouch.jquery.js"></script>

<script type="text/javascript">if($(window).width()>1024){document.write("<"+"script src='js/jquery.preloader.js'></"+"script>");}	</script> 


<script type="text/javascript">
$(document).ready(function(){
$x = $(window).width();		
if($x > 1024)
{			
jQuery("#content .row").preloader();
}	
})	

</script>



<script>		
	  jQuery(document).ready(function(){
		// Initialize the gallery
		jQuery('.magnifier').touchTouch();
	  }); 				
</script>
<script>
$(document).ready(function(){
	
	if ($(".bottom-series").length>5) {

		var slength = $(".bottom-series").length;
		var si = 0;
		
		$(".bottom-sl-b").on("click",function(){
			alert(1);
			$(".bottom-series li").animate({ margin-right :"-=140px"},1000);
			
			if ($(this).hasClass("bottom-sl-r")) {
								
					
			}			
			
		});	
		
	}
	
});
</script>
