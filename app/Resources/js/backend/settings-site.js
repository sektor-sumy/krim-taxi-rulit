
$( document ).ready(function (e) {

    var inmenu = $('.activated-settings');
    inmenu.click(function (e) {

        var settingsId = $(this).data('id');

        $.ajax({
            type: "GET",
            data: { 'id': settingsId },
            url: "/admin/settings/activated",
            success: function(data){
            }
        });

    })
});
