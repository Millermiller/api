@if(Session::has('message'))
    <script>
        $(function(){
            toastr['{!! Session::get('alert-class', 'alert-info') !!}']('{!! Session::get('message') !!}');
        })
    </script>
@endif