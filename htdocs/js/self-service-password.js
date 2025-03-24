$(document).ready(function(){

    // set background image
    background_url = $("#background_url").data('backgroundurl');
    if (typeof background_url !== 'undefined' && background_url != "")
    {
         $("body").css("background", "transparent");
         $("html").css("background", "url(" + background_url + ")");
         $("html").css("background-size", "cover");
    }

    // Menu links popovers
    $('[data-toggle="menu-popover"]').popover({
        trigger: 'hover',
        placement: 'bottom',
        container: 'body' // Allows the popover to be larger than the menu button
    });

    $("form").on('submit', function (event) {

        var $form = $(this);

        if ($form.data('data-submitted') === true) {
            // Previously submitted - don't submit again
            event.preventDefault();
        } else {
            // Mark it so that the next submit can be ignored
            $form.data('data-submitted', true);
        }

    });

});
