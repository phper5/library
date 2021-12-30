@extends('admin_template')
@section('page_title', 'Welcome')
@section('content')
    <div class="box">
    <div class="box-header">
        <h3 class="box-title">{{__('layout.dashboard')}}</h3>
    </div>
    <div class="box-body">

        <a class="btn btn-app"  href="{{ route('books.index') }}">
            <i class="fa fa-inbox"></i>
        </a>
        <a class="btn btn-app" href="{{ route('orders.index',['status'=>0]) }}">
            <i class="fa fa-recycle"></i> {{__('layout.borrow_book')}}
        </a>
    </div>
    <!-- /.box-body -->
</div>
@endsection
