$(function(){
	
	window.addEventListener("load",function() {
		// Set a timeout...
		setTimeout(function(){
			// Hide the address bar!
			window.scrollTo(0, 1);
		}, 0);
	});
	
	
	$('.map-trigger-link').click(function(){
		$('.map-mask').fadeIn('slow');
		$('.map-body').fadeIn();
		return false
	})
	
	$('.close-map').click(function(){
		$('.map-body').fadeOut();
		$('.map-mask').fadeOut('slow');
		return false
	})
	
	$(".dark-click").on("click",function(){
		var catid = $(this).attr("id");
		var caturl = $(this).attr("url");
		$.post("includes/forms.php",{more:'1',id:catid, url: caturl },function(data) {
			$(".search-more").html(data);
			$(".search-more").show();
		});
	});
	
	$(".EFCLOSE").on("click",function(){
		//$(".search-more").hide();	
	});
	
	
	$(".search-inside").on("click",".EFCLOSE",function(){
		 $(".search-more").hide(); 
	});
	
	if ($(".touchthumb").length > 0) {
		$(".touchthumb").touchTouch();
	}
	
	if ($("#bx-pager a").length > 0) {
		
		$("#bx-pager a").hover(function(){
			$(this).click();
			}, function () {
			}
		);
		
		$('.bxslider').bxSlider({
			pagerCustom: '#bx-pager',
			speed: 200
		});
		
	}
	
	

	$(".m-con").delay(1000).fadeOut(1000);
	$(".m-wrap").fadeIn(1000);	
	
	var original_mwrap = $(".m-wrap").height();
	$(".m-wrap").on("click","div.m-header-search",function(){
		
		if (!$(this).hasClass("m-header-search-o")) {
			
			$(this).addClass("m-header-search-o");
			$("div.m-search-arrow").addClass("m-search-arrow2");
			$("div.m-search-overflow").addClass("m-search-overflow2");
			$("div.m-header-logo").addClass("m-header-logo2");
			//$(this).css({"height": $("html").height()+"px"  });
			
			var sheight = $(".search-options-col").height()+180;
			$(".m-wrap").height(sheight);
			
			
			// HANDLE THE SEARCH BUTTONS SIZES
			if ($(".idx-buttons-search").length > 0) {
				var idxhh = 0;
				$(".idx-buttons-search").each(function(){
					
					var idxh = $(this).height();
					if (idxh > idxhh) {
						idxhh = idxh;
					}
					
				});
						
				$(".idx-buttons-search").each(function(){
					
					var idxh = $(this).height();
					if (idxh < idxhh) {
						$(this).height(idxhh);
						$(this).css("padding-top","15px");
						$(this).css("padding-bottom","0px");
					}
					
				});
				
			}
			

			
		} else {
			
			$(this).removeClass("m-header-search-o");
			$("div.m-search-arrow").removeClass("m-search-arrow2");
			$("div.m-search-overflow").removeClass("m-search-overflow2");
			$("div.m-header-logo").removeClass("m-header-logo2");
			//$(this).css({"height": "56px"  });
			
			var sheight = $(".search-options-col").height();
			$(".m-wrap").height(original_mwrap);
			
		}
		
	});
	
	
	$('.contact_form, #tellfriend a.close').click(function() {
		if ($(this).hasClass("close")) {
			$(this).parent().hide();
		} else {
			$(this).toggle();
		}
		$(".SUC1").show();
		$(".SUC2").hide();
	});
	
	
	
	// HANDLE THE HOME BUTTONS SIZES
	if ($(".idx-buttons-home").length > 0) {
		
		var idxhh = 0;
		$(".idx-buttons-home").each(function(){
			
			var idxh = $(this).height();
			if (idxh > idxhh) {
				idxhh = idxh;
			}
			
		});
				
		$(".idx-buttons-home").each(function(){
			
			var idxh = $(this).height();
			if (idxh < idxhh) {
				$(this).height(idxhh);
				$(this).css("padding-top","15px");
				$(this).css("padding-bottom","0px");
			}
			
		});
		
	}
	
	$(".sub-bottom-line").on("click",".bottom-sl-r",function(){
		if ($(".bottom-series li").length > 1) {
		
			$(".bottom-series").animate({ right: "-=181px" },400,function(){
					  $(".bottom-series").append($(".bottom-series li").eq(0));
					  $(".bottom-series").css("right","0");
			});
		
		}
	
	});
	$(".sub-bottom-line").on("click",".bottom-sl-l",function(){
		if ($(".bottom-series li").length > 1) {
			$(".bottom-series").animate({ right: "+=181px" },400,function(){
					  $(".bottom-series").append($(".bottom-series li").eq(0));
					  $(".bottom-series").css("right","0");
			});
		}
	
	});
	
	
});

$(document).bind( "pagechange", function( e, data ) {
	if ($(".m-wrap").length > 1) {
		$(".m-wrap").eq(0).html("");
	}
});
