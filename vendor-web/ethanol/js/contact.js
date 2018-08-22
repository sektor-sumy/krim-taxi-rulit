$(function() {
    $("button#btn-send-message").click(function() {


        $("#contact-form input,textarea").jqBootstrapValidation({
            preventSubmit: true,
            submitError: function ($form, event, errors) {
                // additional error messages or events
            },
            submitSuccess: function ($form, event) {
                event.preventDefault(); // prevent default submit behaviour
                // get values from FORM
                var name = $("input#contact-form-name").val();
                var email = $("input#contact-form-email").val();
                var phone = $("input#contact-form-phone").val();
                var message = $("textarea#contact-form-text").val();
                var firstName = name;

                if (firstName.indexOf(' ') >= 0) {
                    firstName = name.split(' ').slice(0, -1).join(' ');
                }
                $.ajax({
                    url: "/api/message/new",
                    type: "GET",
                    data: {
                        name: name,
                        phone: phone,
                        email: email,
                        text: message
                    },
                    cache: false,
                    success: function () {
                        // Success message
                        $('#success').html("<div class='alert alert-success'>");
                        $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                        $('#success > .alert-success')
                            .append("<strong>Ваше сообщение было отправлено. </strong>");
                        $('#success > .alert-success')
                            .append('</div>');

                        //clear all fields
                        $('#contact-form').trigger("reset");
                    },
                    error: function () {
                        // Fail message
                        $('#success').html("<div class='alert alert-danger'>");
                        $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                        $('#success > .alert-danger').append("<strong>Ивините " + firstName + ", возникла ошибка. Пожалуйста попробуйте позже!");
                        $('#success > .alert-danger').append('</div>');
                        //clear all fields
                        $('#contact-form').trigger("reset");
                    }
                });
            },
            filter: function () {
                return $(this).is(":visible");
            }
        });
    });

    $("button#btn-send-callback").click(function() {

        $("#modal-callback input,textarea").jqBootstrapValidation({
            preventSubmit: true,
            submitError: function ($form, event, errors) {
                // additional error messages or events
            },
            submitSuccess: function ($form, event) {
                event.preventDefault(); // prevent default submit behaviour
                // get values from FORM
                var name = $("input#modal-callback-name").val();
                var phone = $("input#modal-callback-phone").val();
                var firstName = name;

                if (firstName.indexOf(' ') >= 0) {
                    firstName = name.split(' ').slice(0, -1).join(' ');
                }
                $.ajax({
                    url: "/api/callback/new",
                    type: "GET",
                    data: {
                        name: name,
                        phone: phone
                    },
                    cache: false,
                    success: function () {
                        $('#modal-callback').trigger("reset");
                        var overlay = $('.nivo-lightbox-overlay');
                        overlay.removeClass('nivo-lightbox-open');
                        overlay.addClass('nivo-lightbox-close');
                    },
                    error: function () {
                        $('#modal-callback').html("<div class='alert alert-danger'>");
                        $('#modal-callback > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                        $('#modal-callback > .alert-danger').append("<strong>Ивините " + firstName + ", возникла ошибка. Пожалуйста попробуйте позже!");
                        $('#modal-callback > .alert-danger').append('</div>');
                        //clear all fields
                        $('#modal-callback').trigger("reset");
                    }
                })
            },
            filter: function () {
                return $(this).is(":visible");
            }
        });
    });


    $("button#btn-send-order").click(function() {

        $("#modal-order input,textarea").jqBootstrapValidation({
            preventSubmit: true,
            submitError: function ($form, event, errors) {
                // additional error messages or events
            },
            submitSuccess: function ($form, event) {
                event.preventDefault(); // prevent default submit behaviour
                // get values from FORM
                var name = $("input#modal-order-name").val();
                var phone = $("input#modal-order-phone").val();
                var message = $("input#modal-order-text").val();

                var firstName = name;

                if (firstName.indexOf(' ') >= 0) {
                    firstName = name.split(' ').slice(0, -1).join(' ');
                }
                $.ajax({
                    url: "/api/message/new",
                    type: "GET",
                    data: {
                        name: name,
                        phone: phone,
                        email: '-',
                        text: message
                    },
                    cache: false,
                    success: function () {
                        $('#modal-order').trigger("reset");
                        var overlay = $('.nivo-lightbox-overlay2');
                        overlay.removeClass('nivo-lightbox-open');
                        overlay.addClass('nivo-lightbox-close');
                    },
                    error: function () {
                        $('#modal-callback').html("<div class='alert alert-danger'>");
                        $('#modal-callback > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                        $('#modal-callback > .alert-danger').append("<strong>Ивините " + firstName + ", возникла ошибка. Пожалуйста попробуйте позже!");
                        $('#modal-callback > .alert-danger').append('</div>');
                        //clear all fields
                        $('#modal-callback').trigger("reset");
                    }
                });
            },
            filter: function () {
                return $(this).is(":visible");
            }
        });
    });




    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});


/*When clicking on Full hide fail/success boxes */
$('#name').focus(function() {
    $('#success').html('');
});
