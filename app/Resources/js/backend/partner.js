
$( document ).ready(function (e) {

    var inmenu = $('.activated-partner');
    inmenu.click(function (e) {

        var partnerId = $(this).data('id');

        $.ajax({
            type: "GET",
            data: { 'id': partnerId },
            url: "/admin/partner/activated",
            success: function(data){
            }
        });

    })
});
