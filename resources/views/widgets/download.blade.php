<div class="pull-right mb-2">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
        {{__('layout.download_data')}}
    </button>
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{__('layout.choose_data_columns')}}</h4>
            </div>
            <div class="modal-body">
{{--                <div class="alert alert-danger mt-1 mb-1" id="export-error"></div>--}}
                <form method="get" action="{{ $download_route }}">
                    @csrf
                    @foreach ($columns as $column)
                        <div>
                            <input type="checkbox" name="download_fields[]" value="{{ $column }}"> {{ __('export.'.$column) }}
                        </div>

                    @endforeach
                    <div>
                        <input id="export-format" type="hidden" name="format" value="excel">
                        <button type="submit" class="btn btn-primary btn-export" data-format="pdf">{{__('layout.pdf')}}</button>
                        <button type="submit" class="btn btn-primary btn-export"  data-format="excel">{{__('layout.excel')}}</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{__('layout.close')}}</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@section('footer-scripts')
    @parent
    <script type="text/javascript">
        // To make Pace works on Ajax calls
        $(document).ready(function () {
            // $('#modal-default').on('show.bs.modal',
            //     function() {
            //         $("#export-error").html('');
            //         $("#export-error").hide();
            //     })
            $('.btn-export').click(function () {
                if($('input:checkbox[name="download_fields[]"]:checked').length<1){
                    // $("#export-error").html('Please select the data you want');
                    toastr.error('{{__('layout.no_col_hint')}}');
                    // $("#export-error").show();
                    return false;
                }
                $("#export-format").val($(this).attr("data-format"));
                $('#modal-default').modal('hide');
                return true;
            })

        })

    </script>
@endsection
