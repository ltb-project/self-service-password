$(document).ready(function(){
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
