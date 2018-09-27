@extends('main.frontend.layouts.index')
@section('content')
    <section class="container panel" style="margin-top: 50px;margin-bottom: 50px;">
        <div class="row">
            @include('main.frontend.profile.left_col')
            @yield('profile')
        </div>
</section>
<script>
    $(function(){
        $('.avatar-wrapper-large').on('click', function(){
            $('#uploadPhoto').toggle();
        });

        $('#inputFile').on('change', function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.avatar p').hide();
                    $('.avatar').css('background-image', 'url('+e.target.result+')');
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('#uploadPhotoForm').on('submit', function(e){
            e.preventDefault();
            var formdata = new FormData();
            formdata.append('img', $('#inputFile')[0].files[0]);
            console.log(formdata);

            $.ajax({
                type: 'post',
                url: '/profile/uploadImage',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data){
                    toastr[(data.success == true)? 'success' : 'error'](data.msg);
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
                        "timeOut": "30000",
                        "extendedTimeOut": "300000",
                        "showEasing": "linear",
                        "hideEasing": "linear",
                        "showMethod": "slideDown",
                        "hideMethod": "fadeOut"
                    };
                }
            })
        });
        $('#lk-update').on('click', function(e){

            var pass1 = $('#lk-pass').val();
            var pass2 = $('#lk-pass-repeat').val();

            if((pass1 != '' || pass2 !='') && pass1 != pass2){
                toastr['error']('Пароли не совпадают!');
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
                    "timeOut": "3000",
                    "extendedTimeOut": "3000",
                    "showEasing": "linear",
                    "hideEasing": "linear",
                    "showMethod": "slideDown",
                    "hideMethod": "fadeOut"
                };
                $('#lk-pass').parents('.form-group').addClass('has-error');
                $('#lk-pass-repeat').parents('.form-group').addClass('has-error');
                return false;
            }
            else{
                return true;
            }
        })
    });
</script>
@stop