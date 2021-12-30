@extends('admin_template')
@section('page_title', __('user.add_user'))
@section('content')
    <div class="container mt-2 box">
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> {{__('user.back')}}</a>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('users.store') }}" method="POST" id="myform" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                    <strong>{{__('user.role')}}:</strong>
                    <select name="role">
                        <option value="0" {{ 0 == old('role')  ? 'selected="selected"':'' }}>{{__('user.member')}}</option>
                        <option value="1" {{ 1 == old('role')  ? 'selected="selected"':'' }}>{{__('user.admin')}}</option>
                    </select>
                    @error('role')
                    <span class="help-block">
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <strong>{{__('user.username')}}:</strong>
                    <input type="text" name="name" class="form-control" placeholder="{{__('user.username')}}"  value="{{ old('name') }}">
                    @error('name')
                    <span class="help-block">
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <strong>{{__('user.email')}}:</strong>
                    <input type="text" name="email" class="form-control" placeholder="{{__('user.email')}}"  value="{{ old('email') }}">
                    @error('email')
                    <span class="help-block">
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <strong>{{__('user.password')}}:</strong>
                    <input type="password" name="password" class="form-control" placeholder="{{__('user.password')}}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @error('password')
                    <span class="help-block">
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <strong>{{__('user.re_password')}}:</strong>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{__('user.re_password')}}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @error('password_confirmation')
                    <span class="help-block">
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary ml-3">{{__('user.submit')}}</button>
            </div>
        </div>
    </form>
    @include('widgets.formValidator')
@endsection
