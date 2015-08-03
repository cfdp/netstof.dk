(function($) {
  Drupal.behaviors.DKmapRedirect = {
    attach: function (context, settings) {
      /* Only add the functionality on the relevant pages */
      $('.page-node-569', context).once('DKMapRedirect', function () {
        var path_params = $(location).attr('search'); 
        console.log(path_params.substring(9,12));
        if (path_params.substring(9,12) == "318") {
          window.location.replace("http://dev.netstof/kommuner/slagelse");
        }
      });
    }
  };
})(jQuery);