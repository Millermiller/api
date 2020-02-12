$(function(){

    'use strict'

    class SideNav{
        constructor(){
            this.showButtonEl=document.querySelector('.js-menu-show');
            this.hideButtonEl=document.querySelector('.js-menu-hide');
            this.sideNavEl=document.querySelector('.js-side-nav');
            this.sideNavContainerEl=document.querySelector('.js-side-nav__container');

            this.showSideNav=this.showSideNav.bind(this);
            this.hideSideNav=this.hideSideNav.bind(this);
            this.blockClicks=this.blockClicks.bind(this);
            this.onTouchStart=this.onTouchStart.bind(this);
            this.onTouchMove=this.onTouchMove.bind(this);
            this.onTouchEnd=this.onTouchEnd.bind(this);
            this.onTransitionEnd=this.onTransitionEnd.bind(this);
            this.startX=0;
            this.currentX=0;
            this.addEventListeners();
        }

        addEventListeners(){
            this.showButtonEl.addEventListener('click',this.showSideNav);
            this.hideButtonEl.addEventListener('click',this.hideSideNav);
            this.sideNavEl.addEventListener('click',this.hideSideNav);
            this.sideNavContainerEl.addEventListener('click', this.blockClicks);

            document.addEventListener('touchstart', this.onTouchStart);
            // document.addEventListener('touchmove', this.onTouchMove);
            document.addEventListener('touchend', this.onTouchEnd);
        }

        onTouchStart(evt){
            if (!this.sideNavEl.classList.contains('side-nav--visible'))
                return;

            this.startX=evt.touches[0].pageX;
            this.currentX=this.startX;
        }
        onTouchMove(evt){
            this.currentX=evt.touches[0].pageX;
            const translatex= Math.min(0,this.currentX - this.startX);
            if (translatex < 0) {
                evt.preventDefault();
            }
            this.sideNavContainerEl.style.transform=`translateX(${translatex}px)`;
        }

        onTouchEnd(evt){
            const translatex= Math.min(0,this.currentX - this.startX);
            if(translatex < 0){
                this.sideNavContainerEl.style.transform='';
                this.hideSideNav();
            }

        }
        blockClicks(evt){
            //evt.stopPropagation();
        }
        onTransitionEnd(evt){
            this.sideNavEl.classList.remove('side-nav--animatable');
            this.sideNavEl.removeEventListener('transitionend', this.onTransitionEnd);
        }
        showSideNav(){
            this.sideNavEl.classList.add('side-nav--animatable');
            this.sideNavEl.classList.add('side-nav--visible');
            this.sideNavEl.addEventListener('transitionend', this.onTransitionEnd);
        }
        hideSideNav(){
            this.sideNavEl.classList.add('side-nav--animatable');
            this.sideNavEl.classList.remove('side-nav--visible');
            this.sideNavEl.addEventListener('transitionend', this.onTransitionEnd);
        }
    }

    window.sidenav = new SideNav();

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

    $('[data-toggle="tooltip"]').tooltip()

    $('.closeModal').on('click', function () {
        $.fancybox.close();
        $('#loginform').show();
        $('#remindform').hide();
    });

    $('#left-menu').sidr({
        name: 'sidr-left',
        side: 'left' // By default
    });

    $('a[href="/#prices"]').on('click', function (e) {
        $('html,body').stop().animate({
            scrollTop: $('#prices').offset().top
        }, 800);
        e.preventDefault();
    });

    $('a[href="/#langauges"]').on('click', function (e) {
        $('html,body').stop().animate({
            scrollTop: $('#langauges').offset().top
        }, 800);
        e.preventDefault();
    });

    $.material.init();

    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            $('#scroller').fadeIn();
        } else {
            $('#scroller').fadeOut();
        }
    });

    $('#scroller').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });

    $('input.form-control, textarea.form-control').on('input', function(){
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
        $('#uploadPhoto').toggle('slow');
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

        if(!$('#inputFile').val()){
            toastr['error']('Выберите изображение');
            return false
        }


        let label = $(this).find('label')
        let button = $(this).find('button')

        $('.el-loading-mask').show()

        label.attr('disabled', true)
        button.attr('disabled', true)

        let form = new FormData(this);

        $.ajax({
            type: 'post',
            url: '/profile/uploadImage',
            data: form,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                $('#uploadPhoto').toggle('slow');
                toastr[(data.success === true) ? 'info' : 'error'](data.msg);
            },
            error: function (data) {
                let errors = data.responseJSON.errors.photo;
                $.each(errors, function (key, value) {
                    toastr['error'](value);
                });
            },
            complete: function(){
                $('.el-loading-mask').hide()
                label.attr('disabled', false)
                button.attr('disabled', false)
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

    $('#feedbackform').on('submit', function(e){

        e.preventDefault();

        $('.el-loading-mask').show()

        let form = $(this)

        $.ajax({
            url: '/feedback',
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            success: function(data){
                $('.el-loading-mask').hide()
                toastr['success']("Сообщение отправлено");
                $.fancybox.close();
                document.getElementById("feedbackform").reset()
            },
            error: function(data){
                $('.el-loading-mask').hide()
                let errors = data.responseJSON.errors;
                $.each(errors, function (key, value) {
                    $('#feedbackform [name="'+key+'"]').parents('.form-group').addClass('has-error');
                    $('#feedbackform [name="'+key+'"]').siblings('.help-block').text(value)
                });
            }
        })
    })

    $('.hidesidebar').on('click', function(){
        window.sidenav.showSideNav()
    })
})