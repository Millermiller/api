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
                    $.fancybox.close();
                    toastr.error(data.message);
                    toastr.options = TOASTR_OPTIONS
                    return false;
                }

            },
            error: function (data) {
                $.fancybox.close();
                toastr.error('Ошибка');
                toastr.options = TOASTR_OPTIONS
                return false;
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
                $('.avatar').css('background-image', 'url('+e.target.result+')');
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
                toastr[(data.success === true) ? 'success' : 'error'](data.msg);
                toastr.options = TOASTR_OPTIONS
            }
        })
    });
})
