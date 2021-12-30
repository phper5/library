@extends('admin_template')
@section('page_title', __("user.view_user"))
@section('content')
    <div class="container mt-2 box">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('users.index') }}" enctype="multipart/form-data"> {{__('user.back')}}</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{__("user.user_id")}}:</strong>
                    {{ $user->id }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{__("user.role")}}:</strong>
                    {{ $user->role == \App\Models\User::ROLE_ADMIN?__('user.admin'):__('user.member')}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{__('user.username')}}:</strong>
                    {{ $user->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{__("user.email")}}:</strong>
                    {{ $user->email }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{__('user.created_at')}}:</strong>
                    {{ $user->created_at }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <form action="{{ route('users.destroy',$user->id) }}" method="Post">
                    <a class="btn btn-primary" href="{{ route('orders.all',['user_id'=>$user->id,'status'=>0]) }}">{{__("user.borrowed_books")}}</a>
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    @csrf
{{--                    @method('DELETE')--}}
{{--                    <button type="submit" class="btn btn-danger">Delete</button>--}}
                </form>
            </div>

        </div>

    </div>
@endsection
