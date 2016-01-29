(function($) {
  /* Redirects user to a custom municipality page */
  Drupal.behaviors.DKmapRedirect = {
    attach: function (context, settings) {
      /* Only add the functionality once on the relevant pages */
      $('.page-node-569', context).once('DKMapRedirect', function () {
        var path_params = $(location).attr('search');
        var path_hostname = $(location).attr('hostname');
        var path_name= $(location).attr('pathname');
        if (path_params.substring(9,12) == "318") {
          window.location.replace("/kommuner/slagelse"+path_params);
        }
      });
    }
  };

  /*This function makes sure no more than 1 checkbox can be chosen on a form (Used on the Questions and Answers form)*/
  Drupal.behaviors.QNA = {
    attach: function (context, settings) {
      $("input[type=checkbox][class=form-checkbox]").change(function() {
        var bol = $("input[type=checkbox][class=form-checkbox]:checked").length >= 1;
        $("input[type=checkbox][class=form-checkbox]").not(":checked").attr("disabled",bol);
      });
    }
  };

  /* Shows text tip in search box */
  Drupal.behaviors.searchTip = {
    attach: function (context, settings) {
      /* Only add the functionality once */
      $('.html', context).once('searchTip', function () {
        $( ".form-item-search-block-form input" ).val('Søg på netstof.dk');
        $( ".form-item-search-block-form input" ).focus(function() {
          if (this.value == 'Søg på netstof.dk') {this.value = '';}
        });
        $( ".form-item-search-block-form input" ).blur(function() {
          if (this.value == '') {this.value = 'Søg på netstof.dk';}
        });
      });
    }
  };
})(jQuery);
