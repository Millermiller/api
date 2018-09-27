$(function(){

    const TOASTR_OPTIONS = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "10",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "linear",
        "hideEasing": "linear",
        "showMethod": "slideDown",
        "hideMethod": "fadeOut"
    }

    $(".fancybox").fancybox({
        padding: 0,
        showNavArrows: false,
        autoDimensions: true,
        centerOnScroll: true,
        hideOnOverlayClick: true,
        overlayOpacity: 1,
        helpers: {
            overlay: {
                locked: false
            }
        },
    });

    $('.closeModal').on('click', function () {
        $.fancybox.close();
        $('#loginform').show();
        $('#remindform').hide();
    });

    $('#left-menu').sidr({
        name: 'sidr-left',
        side: 'left' // By default
    });

    $('a[href="/#langauges"]').on('click', function (e) {
        $('html,body').stop().animate({
            scrollTop: $('#langauges').offset().top
        }, 800);
        e.preventDefault();
    });

    $.material.init();


    $('input.form-control').on('input', function(){
        let input = $(this)

        if(input.val().length > 0)
            input.parents('.form-group').addClass('is-filled')
        else
            input.parents('.form-group').removeClass('is-filled')
    })

    $('#loginform').on('submit', function (e) {
        e.preventDefault();

        let form = $(this)

        $.ajax({
            url: '/login',
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.success){
                    location.reload()
                }
                else{
                    form.find('.form-group').addClass('has-error');
                    toastr.error(data.message);
                    toastr.options = TOASTR_OPTIONS
                    return false;
                }
            },
            error: function (data) {
                let errors = data.responseJSON.errors;
                $.each(errors, function (key, value) {
                    $('#loginform input[name="'+key+'"]').parents('.form-group').addClass('has-error');
                });
            }
        });
    });

    $('#registrationform').on('submit', function (e) {

        e.preventDefault();

        let form = $(this)

        $.ajax({
            url: '/signup',
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            beforeSend: function(){
                $('#registrationform .form-group').removeClass('has-error').removeClass('has-success')
            },
            success: function (data) {
                if (data.success === true) {
                    location.reload()
                }
                else {
                    switch (data.code) {
                        case 1:
                            $('#badLoginMess p').text(data.msg);
                            $('#badLoginMess').removeClass('hidden');
                            break;
                        case 2:
                            $('#badEmailMess p').text(data.msg);
                            $('#badEmailMess').removeClass('hidden');
                            break;
                        case 3:
                            $.fancybox.close();
                            toastr[(data.success == true) ? 'success' : 'error'](data.msg);
                            toastr.options = TOASTR_OPTIONS
                            break;
                    }
                }
            },
            error: function (data) {
                let errors = data.responseJSON.errors;
                $.each(errors, function (key, value) {
                    $('#registrationform input[name="'+key+'"]').parents('.form-group').addClass('has-error');
                    $('#registrationform input[name="'+key+'"]').siblings('.help-block').text(value)

                    if(key === 'password') {
                        $('[name="password_confirmation"]').parents('.form-group').addClass('has-error');
                        $('[name="password_confirmation"]').siblings('.help-block').text(value)
                    }
                });

                $('#registrationform .form-group').not('.has-error').addClass('has-success')
            }
        })
    });

    $('#restore').on('click', function (e) {
        e.preventDefault()
        $('#loginform').hide();
        $('#remindform').show();
    });
})
