// $(document).ready(function () {
//
//     $('.activated-partner').trigger('click',function () {
//         $.ajax({
//             url: "/admin/"+bages+"/count-new",
//             type: "GET",
//             data: {},
//             success: function(data) {
//                 if (0 != data.count) {
//                     $('#nav-badge-'+bages).text(data.count);
//                     $('#nav-badge-'+bages).removeClass('invisible');
//                 }
//             }
//         });
//     });
//
//
//
// });


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