@extends('admin_template')
@section('page_title', 'Welcome')
@section('content')
    <div class="box">
    <div class="box-header">
        <h3 class="box-title">dashboard</h3>
    </div>
    <div class="box-body">

        <a class="btn btn-app" href="{{ route('books.index') }}">
            <i class="fa fa-book"></i>{{__('layout.manage_books')}}
        </a>
        <a class="btn btn-app"  href="{{ route('users.index') }}">
            <i class="fa fa-user"></i>{{__('layout.manage_users')}}
        </a>
        <a class="btn btn-app"  href="{{ route('categories.index') }}">
            <i class="fa fa-tag"></i>{{__('layout.manage_categories')}}
        </a>
        <a class="btn btn-app"  href="{{ route('orders.all') }}">
            <i class="fa fa-list"></i>{{__('layout.borrowing_logs')}}
        </a>
        <a class="btn btn-app"  href="/log-viewer" target="_blank">
            <i class="fa fa-list"></i>{{__('layout.system_log')}}
        </a>
        <a class="btn btn-app"  href="{{ route('books.index') }}">
            <i class="fa fa-inbox"></i> {{__('layout.borrow_book')}}
        </a>
        <a class="btn btn-app" href="{{ route('orders.index',['status'=>0]) }}">
            <i class="fa fa-recycle"></i> {{__('layout.return_book')}}
        </a>
    </div>
    <!-- /.box-body -->
</div>
@endsection
