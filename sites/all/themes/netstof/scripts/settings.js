var $ = jQuery.noConflict();

$(function() {

	/**
	 * ENCYCLOPEDIA TABS - Hash links
	 */
	var hash = window.location.hash;
	if(hash!="") {
		hash = hash.replace("#","");
		switch(hash) {
			case "stoffet":
				jQuery(".horizontal-tab-button-0 a").trigger("click");
			break;
			case "effekten":
				jQuery(".horizontal-tab-button-1 a").trigger("click");
			break;
			case "bivirkningen":
				jQuery(".horizontal-tab-button-2 a").trigger("click");
			break;
		}
	}
	
	/**
	 * WATERMARKS
	 */
	$(".view-faq #edit-body-value").watermark("Søg i FAQ'en", {useNative: false});
	$(".view-leksikon #edit-title").watermark("Søg i leksikon", {useNative: false});

	/**
	 * SCROLL TO TOP
	 */
	$('#scroll-top a').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	/**
	 * RIGHT SIDE TABS
	 */
	$("#right-side > div").hover(
		
		function() {
		
			$(this).stop(true,true).animate({ 
				
				right: "0"
			
			},200);
		
		},
		function() {
		
			$(this).stop(true,true).animate({ 
				
				right: "-=75"
			
			},200);
		
		}
	);

	/**
	 * VIEWS GRID - FILTER
	 */
	$(".views-fluidgrid-item").live({
        mouseenter:
           function()
           {
				$(".plus-link", this).stop(true,true).fadeIn(100);
           },
        mouseleave:
           function()
           {
				$(".plus-link", this).stop(true,true).fadeOut(100);
           }
       }
    );
    
    /**
     * TOOLTIPS
     */
	/*
	$('.plus-link').qtip({
	   content: 'Opret et nyt spørgsmål i brevkassen',
	   show: 'mouseover',
	   hide: 'mouseout',
	   position: { 
	   	corner: { 
	   		target: 'topMiddle', 
	   		tooltip: 'bottomMiddle'
	   	},
       adjust: { y: 0, x: 12 }
	   },
	  style: { 
      width: 200,
      padding: 10,
      background: '#3c3c3b',
      color: 'white',
      textAlign: 'left',
      border: {
         width: 0,
         radius: 0,
         color: '#3c3c3b'
      },
      tip: 'bottomMiddle',
   	}
	});
	*/
	
	/**
	 * MAIN MENU
	 */

    $('.region-header .menu-block-wrapper > ul.menu > li.expanded').not(".active-trail")
    .hover(function() {
    
		$('.region-header .menu-block-wrapper > ul.menu > li.active-trail > ul').hide();
        $("ul",this).fadeIn();
       
    }, function() {

        $("ul",this).hide();
		$('.region-header .menu-block-wrapper > ul.menu > li.active-trail > ul').fadeIn();
		
    });

});