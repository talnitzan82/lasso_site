$(function(){
	
	$("#resultLand").on("click",".CHECKBOX_C",function() {
		if ($(this).prop("checked")==true) {
			$(this).parent().addClass("item-chooser2");
			$(".COMP form").append('<input type="checkbox" name="compare[]" value="'+ $(this).val() +'" checked />');
		} else {
			$(this).parent().removeClass("item-chooser2");
			$(".COMP form").find('input[value="'+ $(this).val() +'"]').remove();
		}
		if ($(".COMP input").length == 0) {
			$(".COMP").animate({right:"-87px"},500);
		} else {
			$(".COMP").animate({right:"0px"},500);
		}
	});
	
	$(".search-submitter-open").on("click",function() {
		
		$(".search-pannel_h").animate({ "height": "400px"},1000);
		$(".search-submitter-open").hide()
		$(".search-submitter-close").show();
	});
	
	$(".search-submitter-close").on("click",function() {
		
		$(".search-pannel_h").animate({ "height": "200px"},1000);
		$(".search-submitter-close").hide();
		$(".search-submitter-open").show();
	});

	$(".page-scroller").click(function (){
		$('html, body').animate({
			scrollTop: $("html, body").offset().top
		}, 1000);
	});
	
	$('.map-trigger-link').click(function(){
		$('.map-mask').fadeIn('slow');
		$('.map-body').addClass("active");
		//$('.map-body').fadeIn();
		return false
	})
	
	$('.close-map').click(function(){
		$('.map-body').removeClass("active");
		$('.map-mask').fadeOut('slow');
		return false
	})
	
	$(".dark-click").on("click",function(){
		var catid = $(this).attr("id");
		var caturl = $(this).attr("url");
		$.post("includes/forms.php",{more:'1',id:catid, url: caturl },function(data) {
			$(".search-more").html(data);
			$(".search-more").show();
			$(".search-submitter2").hide();
		});
	});
	
	$(".EFCLOSE").on("click",function(){
		//$(".search-more").hide();	
	});
	
	$("header").imagesLoaded(function() {
		
		$("header").height($(".active.item").outerHeight());
	
	});
	$(".sub-bottom-line").on("click",".bottom-sl-r",function(){
		
		//if ($(".bottom-series li").length > 5) {
		
			$(".bottom-series").animate({ right: "-=181px" },400,function(){
					  $(".bottom-series").append($(".bottom-series li").eq(0));
					  $(".bottom-series").css("right","0");
			});
		
		//}
	
	});
	$(".sub-bottom-line").on("click",".bottom-sl-l",function(){
		//if ($(".bottom-series li").length > 5) {
			$(".bottom-series").animate({ right: "+=181px" },400,function(){
					  $(".bottom-series").prepend($(".bottom-series li").last());
					  $(".bottom-series").css("right","0");
			});
		//}
	
	});
	
	
});