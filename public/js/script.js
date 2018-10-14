$(function(){

    toastr.options = {
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

        $('.el-loading-mask').show()

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
                    $('.el-loading-mask').hide()
                    form.find('.form-group').addClass('has-error');
                    toastr.error(data.message);
                    return false;
                }
            },
            error: function (data) {
                $('.el-loading-mask').hide()
                let errors = data.responseJSON.errors;
                $.each(errors, function (key, value) {
                    $('#loginform input[name="'+key+'"]').parents('.form-group').addClass('has-error');
                });
            }
        });
    });

    $('#registrationform').on('submit', function (e) {

        e.preventDefault();

        $('.el-loading-mask').show()

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
                    $('.el-loading-mask').hide()

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
                            toastr[(data.success == true) ? 'info' : 'error'](data.msg);
                            break;
                    }
                }
            },
            error: function (data) {
                $('.el-loading-mask').hide()
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

    /**** PROFILE *****/
    $('.avatar-wrapper-large').on('click', function(){
        $('#uploadPhoto').toggle();
    });

    $('#inputFile').on('change', function(){
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('.avatar p').hide();
                $('.avatar-wrapper-large img, .avatar-wrapper-small img').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#uploadPhotoForm').on('submit', function(e){
        e.preventDefault();

        let form = new FormData(this);

        $.ajax({
            type: 'post',
            url: '/profile/uploadImage',
            data: form,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                $('#uploadPhoto').toggle();
                toastr[(data.success === true) ? 'info' : 'error'](data.msg);
            }
        })
    });

    $('#remindform').on('submit', function (e) {

        e.preventDefault();

        $('.el-loading-mask').show()

        let form = $(this)

        $.ajax({
            url: '/password/email',
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {
                toastr[(data.success === true) ? 'info' : 'error'](data.message);
                $.fancybox.close();
                $('.el-loading-mask').hide()
            },
            error: function(data){
                $('.el-loading-mask').hide()
                let errors = data.responseJSON.errors;
                $.each(errors, function (key, value) {
                    $('#remindform input[name="'+key+'"]').parents('.form-group').addClass('has-error');
                    $('#remindform input[name="'+key+'"]').siblings('.help-block').text(value)
                });

                $('#registrationform .form-group').not('.has-error').addClass('has-success')
            }
        })
    });
})
