(function ($) {
    Drupal.behaviors.YourBehaviour = {
    attach: function() {  
        // Trigger radiobtn
        $('.poll.image_poll .choice').bind('touchstart mousedown', function(e){
            e.preventDefault();
            $(this).find('label').prop("checked", true).trigger("click");
        });

        // Reveal extra info field after casting the vote for first time users
        $('[id^=image_poll-form]').click(function(event){

            var mp_node = $(this).parents('.node-content');
            mp_node.children('.field-name-field-extra-info').slideDown();
        });
        
        // When changing votes, first the vote is canceled and then
        // submit the other choice programatically
        $('[id^=image_poll-form]').ajaxComplete(function(event, xhr, settings) {
            var formid = Drupal.settings.image_poll.formid;

            $(this).find('input[value^=' + formid + ']').mousedown();

        // Reveal extra info field after changing the vote
            var mp_node = $('input[value^=' + formid + ']').parents('.node-content');
            mp_node.children('.field-name-field-extra-info').slideDown();
        });
    }
 
    }
})(jQuery);