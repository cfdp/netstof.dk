(function($) {
  Drupal.behaviors.DKmapRedirect = {
    attach: function (context, settings) {
      /* Only add the functionality on the relevant pages */
      $('.page-node-569', context).once('DKMapRedirect', function () {
        var path_params = $(location).attr('search');
        var path_hostname = $(location).attr('hostname');
        var path_name= $(location).attr('pathname');
        if (path_params.substring(9,12) == "318") {
          console.log(path_hostname+path_name+"/kommuner/slagelse");
          window.location.replace("/kommuner/slagelse"+path_params);
        }
      });
    }
  };
  
  Drupal.behaviors.QNA = {
    attach: function (context, settings) {
      /*This function makes sure no more than 1 checkbox can be chosen on a form (Used on the Questions and Answers form)*/
      $("input[type=checkbox][class=form-checkbox]").change(function() {
        var bol = $("input[type=checkbox][class=form-checkbox]:checked").length >= 1;
        $("input[type=checkbox][class=form-checkbox]").not(":checked").attr("disabled",bol);
      });
    }
  };

})(jQuery);
