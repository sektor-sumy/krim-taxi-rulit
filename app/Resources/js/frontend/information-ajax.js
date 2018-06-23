$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/information",
        success: function(data){
            var info = data;

            $('.api-information-phone').html(info.phone);
            $('.api-information-mail').html(info.mail);
            $('.api-information-location').html(info.location);

            $('.api-information-instagram').attr("href", "https://vk.com/"+info.instagram);
            $('.api-information-vk').attr("href", "https://vk.com/"+info.vk);
            $('.api-information-facebook').attr("href", "https://www.facebook.com/"+info.facebook);
        }
    });
} );


