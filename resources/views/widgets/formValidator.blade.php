@section('footer-scripts')
    @parent
    <script  type =" text/javascript " src =" {{ asset('vendor/jsvalidation/js/jsvalidation.js')}} "> </script >
    {!! $validator->selector("#myform") !!}
@endsection
