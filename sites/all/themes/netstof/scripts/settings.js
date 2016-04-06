var $ = jQuery.noConflict();

$(function () {

  /**
   * Fix for doubleclick issues on iPhone / iPad
   * http://stackoverflow.com/questions/3038898/ipad-iphone-hover-problem-causes-the-user-to-double-click-a-link
   */
  $('a.single-click-mobile').on('click touchend', function (e) {
    var el = $(this);
    var link = el.attr('href');
    window.location = link;
  });

  /**
   * ENCYCLOPEDIA TABS - Hash links
   */
  var hash = window.location.hash;
  if (hash != "") {
    hash = hash.replace("#", "");
    switch (hash) {
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
    function () {
      var right_space = 0;
      $(this).stop(true, true).animate({
        right: 179
      }, 200);

    },
    function () {
      $(this).stop(true, true).animate({
        right: "0"
      }, 200);
    }
  );

  /**
   * SCROLL TO FIXED
   */
  /*$(".region-tabs-right").scrollToFixed({
  	limit: $("#footer-container").offset().top - 620,
  	marginTop: 192,
  	zIndex: 0,
  });*/

  /**
   * VIEWS GRID - FILTER
   */
  $(".views-fluidgrid-item").live({
    mouseenter: function () {
      $(".plus-link", this).stop(true, true).fadeIn(100);
    },
    mouseleave: function () {
      $(".plus-link", this).stop(true, true).fadeOut(100);
    }
  });

  /**
   * MAIN MENU
   */

  $('.region-header .menu-block-wrapper > ul.menu > li.expanded').not(".active-trail")
    .hover(function () {

      $('.region-header .menu-block-wrapper > ul.menu > li.active-trail > ul').hide();
      $("ul", this).fadeIn();

    }, function () {

      $("ul", this).hide();
      $('.region-header .menu-block-wrapper > ul.menu > li.active-trail > ul').fadeIn();

    });

  /**
   * FORM STYLING
   */

  // Dropkick (Select boxes)
  /* @todo - since dropkick has been deactivated for some reason, we need to deactivate this as well */
  /*    if( !isMobile.any() ) {
  	    $(".node-form .form-select").dropkick();
  	    $("#edit-kommune").dropkick({theme:"dark"});
      	 $("#goto-maps-form select").dropkick({
  			change: function () {
  			$(this).change();
  			}
         });
      }*/
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
  if (!isMobile.any()) {
    attachTooltips();
  }
  /**
   * ATTACH WATERMARKS
   */
  attachWatermarks();

  // Ajax complete
  $(document).ajaxComplete(function () {
    if (!isMobile.any()) {
      attachTooltips();
    }
    attachWatermarks();
  });

  /**
   * WYSIWYG - remove on mobile devices
   */
  if (isMobile.any()) {
    tinyMCE.onAddEditor.add(function (mgr, ed) {
      id = ed.id;
      setTimeout("tinyMCE.execCommand('mceRemoveControl', false, id)", 100);
    });
  }

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
      adjust: {
        y: 0,
        x: 12
      }
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
  $(".view-faq #edit-body-value").watermark("Søg i FAQ'en", {
    useNative: false
  });
  $(".view-leksikon #edit-title").watermark("Søg i leksikon", {
    useNative: false
  });
  /* kort */
  $(".view-kort #edit-adresse").watermark("Adresse", {
    useNative: false
  });
  $(".view-kort #edit-by").watermark("By", {
    useNative: false
  });
  $(".view-kort #edit-kommuner").watermark("Kommune", {
    useNative: false
  });
  /* feedback tab form */
  $("#webform-client-form-564 #edit-submitted-dit-navn").watermark("Navn", {
    useNative: false
  });
  $("#webform-client-form-564 #edit-submitted-din-e-mail").watermark("Email", {
    useNative: false
  });
  $("#webform-client-form-564 #edit-submitted-indhold").watermark("Indhold", {
    useNative: false
  });
}

/**
 * isMobile - Detect mobile devices
 */
var isMobile = {
  Android: function () {
    return navigator.userAgent.match(/Android/i);
  },
  BlackBerry: function () {
    return navigator.userAgent.match(/BlackBerry/i);
  },
  iOS: function () {
    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
  },
  Opera: function () {
    return navigator.userAgent.match(/Opera Mini/i);
  },
  Windows: function () {
    return navigator.userAgent.match(/IEMobile/i);
  },
  any: function () {
    return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
  }
};
