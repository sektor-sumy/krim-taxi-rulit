$(document).ready(function () {
    $( '.open-close-modal-callback' ).click(function() {
        var overlay =  $('.nivo-lightbox-overlay');

        if (overlay.hasClass("nivo-lightbox-close")) {
            overlay.removeClass('nivo-lightbox-close');
            overlay.addClass('nivo-lightbox-open');
        } else {
            overlay.removeClass('nivo-lightbox-open');
            overlay.addClass('nivo-lightbox-close');
        }
    });
} );
