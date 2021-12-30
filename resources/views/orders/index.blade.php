@extends('admin_template')
@section('page_title', __('order.borrow_order'))
@section('content')
    <div class="container mt-2 box">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('books.index') }}"> {{__('order.borrow_books')}} </a>
            </div>
        </div>
    </div>
    <form method="get" action="{{ route('orders.index') }}">
        <div class="form-group">
            <div class="col-xs">
                {{__('order.category')}}:

                <select name="status">
                    <option value="0"{{ 0 == $status  ? 'selected="selected"':'' }}>{{__('order.un_returned')}}</option>
                    <option value="1" {{ 1 == $status  ? 'selected="selected"':'' }} >{{__('order.all')}}</option>
                </select>

                {{__('order.keyword')}}:

                <input type="text" name="keyword"  placeholder="{{__('order.keyword')}}" value="{{ $keyword }}">

                <button type="submit" class="btn btn-primary">{{__('order.search')}}</button>
            </div>
        </div>

    </form>
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th>{{__('order.book_id')}}</th>
            <th>{{__('order.book_title')}}</th>
            <th>{{__('order.borrowed_at')}}</th>
            <th>{{__('order.returned_at')}}</th>
            <th width="280px">{{__('order.action')}}</th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->book?$order->book->id:'-' }}</td>
                <td>{{ $order->book?$order->book->title:'unknown' }}</td>
                <td>{{ $order->borrowed_at }}</td>
                <td>{{ $order->returned_at }}</td>
                <td>
                    <form action="{{ route('orders.return',$order->id) }}" method="Post">
                        @csrf
                        <button type="submit" {{ !$order->returned_at  ? '':'disabled="disabled""'}} class="btn  {{ !$order->returned_at ? 'btn-primary':'btn-default' }}">{{__('order.return_book')}}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $orders->links() }}
@endsection
