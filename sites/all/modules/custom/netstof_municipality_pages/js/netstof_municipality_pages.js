(function($) {
  /* Redirects user to a custom municipality page */
  Drupal.behaviors.NetstofMunicipalityPages = {
    attach: function (context, settings) {
      /* Only add the functionality once on the relevant pages */
      $('.page-node-569', context).once('NetstofMunicipalityPages', function () {
        var path_params = $(location).attr('search');
        var path_hostname = $(location).attr('hostname');
        var path_name= $(location).attr('pathname');
        var current_term_id = path_params.substring(9,12);
        var featured_tids = Drupal.settings.netstof_municipality_pages.tids; // Municipality tids
        if ($.inArray(current_term_id,featured_tids) !== -1 ) {
          window.location.replace("/taxonomy/term/"+current_term_id+path_params);
        }
      });
    }
  };

})(jQuery);
