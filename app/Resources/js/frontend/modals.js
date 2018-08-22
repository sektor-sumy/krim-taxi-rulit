$(document).ready(function () {
    $( '.open-close-modal-callback' ).click(function() {
        var overlay =  $('.nivo-lightbox-overlay1');

        if (overlay.hasClass("nivo-lightbox-close")) {
            overlay.removeClass('nivo-lightbox-close');
            overlay.addClass('nivo-lightbox-open');
        } else {
            overlay.removeClass('nivo-lightbox-open');
            overlay.addClass('nivo-lightbox-close');
        }
    });



    $( '.button-homepage-fastorder-click' ).click(function() {
        var overlay =  $('.nivo-lightbox-overlay2');

        $("#modal-order-text").val("ЗАКАЗ" + this.innerHTML);

        $("#modal-order-type-order").html(this.innerHTML);

        if (overlay.hasClass("nivo-lightbox-close")) {
            overlay.removeClass('nivo-lightbox-close');
            overlay.addClass('nivo-lightbox-open');
        } else {
            overlay.removeClass('nivo-lightbox-open');
            overlay.addClass('nivo-lightbox-close');
        }
    });


} );





