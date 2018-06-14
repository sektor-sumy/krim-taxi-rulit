$(document).ready(function () {
    function uploadBages(bages) {
        $.ajax({
            url: "/admin/"+bages+"/count-new",
            type: "GET",
            data: {},
            success: function(data) {
                if (0 != data.count) {
                    $('#nav-badge-'+bages).text(data.count);
                    $('#nav-badge-'+bages).removeClass('invisible');
                }
            }
        });
    }
    uploadBages('message');
    uploadBages('callback');
});