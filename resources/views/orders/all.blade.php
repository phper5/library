@extends('admin_template')
@section('page_title', __('order.borrow_list'))
@section('content')
    <div class="container mt-2 box">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('books.index') }}"> {{__('order.view_books')}} </a>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('users.index') }}"> {{__('order.view_users')}} </a>
            </div>
        </div>
    </div>
    <form method="get" action="{{ route('orders.all') }}" id="search_form">
        <div class="form-group">
            <div class="col-xs">
                {{__('order.category')}}:

                <select name="status">
                    <option value="0"{{ 0 == $status  ? 'selected="selected"':'' }}>{{__('order.un_returned')}}</option>
                    <option value="1" {{ 1 == $status  ? 'selected="selected"':'' }} >{{__('order.all')}}</option>
                </select>

                {{__('order.keyword')}}:
                <input type="hidden" id="search_user_id" name="user_id" value="{{ $user?$user->id:'' }}">
                <input type="text" name="keyword"  placeholder="{{__('order.keyword')}}" value="{{ $keyword }}">
                @if ($user)
                    <a href="#" class="dropdown-toggle" data-id="{{ $user->id }}" id="cancel_user_id">
                        {{ $user->name }}
                        <span class="label label-danger">X</span>
                    </a>
                @endif
                <button type="submit" class="btn btn-primary">{{__('order.search')}}</button>
            </div>
        </div>

    </form>
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th>{{__('order.book_id')}}</th>
            <th>{{__('order.book_title')}}</th>
            <th>{{__('order.borrowed_by')}}</th>
            <th>{{__('order.borrowed_at')}}</th>
            <th>{{__('order.returned_at')}}</th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->book?$order->book->id:'-' }}</td>
                <td>{{ $order->book?$order->book->title:'unknown' }}</td>
                @if ($user && $user->id == $order->user_id)
                    <td>{{ $order->user?$order->user->name:'unknown' }}</td>
                @else
                    <td><a href="#" data-user-id="{{ $order->user_id }}" class="borrowed_by">{{ $order->user?$order->user->name:'unknown' }}</a></td>
                @endif

                <td>{{ $order->borrowed_at }}</td>
                <td>{{ $order->returned_at }}</td>
            </tr>
        @endforeach
    </table>
    {{ $orders->links() }}
    @include('widgets.download',['download_route'=>route('export.orders')])
@endsection
@section('footer-scripts')
@parent
            <script type="text/javascript">
                // To make Pace works on Ajax calls
                $(document).ready(function () {
                    $('#cancel_user_id').click(function () {
                        $("#search_user_id").val(0);
                        $('#search_form').submit();
                        return false;
                    })
                    $('.borrowed_by').click(function () {
                        $("#search_user_id").val($(this).attr('data-user-id'));
                        $('#search_form').submit();
                        return false;
                    })
                })
            </script>
@endsection
