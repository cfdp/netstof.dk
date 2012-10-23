var $ = jQuery.noConflict();

$(function() {

	/*
    var customStyle = [
  	{
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      { "hue": "#ff0022" }
    ]
  	}
	];

	console.log(google.maps);

	Drupal.gmap.setOptions({ 'styles': customStyle });
	*/

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
	$(".region-tabs-right .slideout").hover(
		
		function() {
		
			var right_space = 0;
		
			if($(this).hasClass("block-netstof-social")) {
				right_space = -40;
			}
		
			$(this).stop(true,true).animate({ 
				
				right: right_space
			
			},200);
		
		},
		function() {
		
			$(this).stop(true,true).animate({ 
				
				right: "-179"
			
			},200);
		
		}
	);
	
	console.log($("#footer-container").offset().top);

	/**
	 * SCROLL TO FIXED
	 */
	$(".region-tabs-right").scrollToFixed({
		limit: $("#footer-container").offset().top - 620,
		marginTop: 10,
		zIndex: 10,
	});

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
    
    /**
     * FORM STYLING
     */
     
    // Dropkick (Select boxes)
    $(".node-form .form-select").dropkick();    
    $("#edit-kommune").dropkick({theme:"dark"});    
    
    // Checkboxes
	/*
    $('.node-form .form-checkbox').screwDefaultButtons({ 
		checked: "url(/sites/all/themes/netstof/images/checkbox-checked.png)",
		unchecked: "url(/sites/all/themes/netstof/images/checkbox-unchecked.png)",
		width:	 21,
		height:	 21
	 });
	*/
    
    /**
     * ATTACH TOOLTIPS
     */
    attachTooltips();
    
    /**
     * ATTACH WATERMARKS
     */
    attachWatermarks();
    
    // Ajax complete
    $(document).ajaxComplete(function() {
    	attachTooltips();
    	attachWatermarks();
    });
    
});

/**
 * TOOLTIPS
 */
function attachTooltips() {
	$('.tooltip').qtip({
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
	  padding: 15,
	  color: 'white',
	  textAlign: 'left',
	  border: {
	     width: 0,
	     radius: 0,
	     color: '#3c3c3b'
	  },
	  classes: {
	  	tooltip: "tool",
	  },
	  tip: 'bottomMiddle',
		}
	});
}

/**
 * WATERMARKS
 */
function attachWatermarks() {
	$(".view-faq #edit-body-value").watermark("Søg i FAQ'en", {useNative: false});
	$(".view-leksikon #edit-title").watermark("Søg i leksikon", {useNative: false});
	$(".view-kort #edit-adresse").watermark("Adresse", {useNative: false});
	$(".view-kort #edit-by").watermark("By", {useNative: false});
	/* feedback tab form */
	$("#webform-client-form-564 #edit-submitted-dit-navn").watermark("Navn", {useNative: false});
	$("#webform-client-form-564 #edit-submitted-din-e-mail").watermark("Email", {useNative: false});
	$("#webform-client-form-564 #edit-submitted-indhold").watermark("Indhold", {useNative: false});
}