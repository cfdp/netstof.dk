(function($) {
Drupal.behaviors.myBehavior = {
  attach: function (context, settings) {
    /*This function makes sure no more than 1 checkbox can be chosen on a form (Used on the Questions and Answers form)*/
    $("input[type=checkbox][class=form-checkbox]").change(function() {
        var bol = $("input[type=checkbox][class=form-checkbox]:checked").length >= 1;     
        $("input[type=checkbox][class=form-checkbox]").not(":checked").attr("disabled",bol);
    });
  }
};
})(jQuery);