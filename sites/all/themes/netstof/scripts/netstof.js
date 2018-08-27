(function ($) {
  /*This function makes sure no more than 1 checkbox can be chosen on a form (Used on the Questions and Answers form)*/
  Drupal.behaviors.QNA = {
    attach: function (context, settings) {
      $("input[type=checkbox][class=form-checkbox]").change(function () {
        var bol = $("input[type=checkbox][class=form-checkbox]:checked").length >= 1;
        $("input[type=checkbox][class=form-checkbox]").not(":checked").attr("disabled", bol);
      });
    }
  };

  /* Shows text tip in search box */
  Drupal.behaviors.searchTip = {
    attach: function (context, settings) {
      /* Only add the functionality once */
      $('.html', context).once('searchTip', function () {
        $(".form-item-search-block-form input").val('Søg på netstof.dk');
        $(".form-item-search-block-form input").focus(function () {
          if (this.value == 'Søg på netstof.dk') {
            this.value = '';
          }
        });
        $(".form-item-search-block-form input").blur(function () {
          if (this.value == '') {
            this.value = 'Søg på netstof.dk';
          }
        });
      });
    }
  };

  /* Hide the explaining text when viewing a municipality */
  Drupal.behaviors.dkMapHideText = {
    attach: function (context, settings) {
      var municipality_id;
      function GetURLParameter(sParam) {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) {
          var sParameterName = sURLVariables[i].split('=');
          if (sParameterName[0] == sParam) {
            return sParameterName[1];
          }
        }
      }
      municipality_id = GetURLParameter('kommune');
      if (municipality_id) {
        $('#node-569 .field-name-body ').hide();
      }
    }
  };
    
    
    
Drupal.behaviors.searchAimation = {
    attach: function (context, settings) {
        $('.html', context).once('searchAimation', function () {
            
         
            
            $(".search-icon").click(function(){
                $(".header-search").toggleClass("open");
            });
            
            $(".close-search").click(function(){
                $(".header-search").toggleClass("open");
            });
            


            $(document).mouseup(function (e){  
                var container = $(".header-search");
                if (!container.is(e.target) && container.has(e.target).length === 0 && $( ".header-search" ).hasClass( "open" )){
                    $( ".header-search" ).toggleClass( "open" );	
                }
            });  
        
        });
    }
};     
    
    
})(jQuery);