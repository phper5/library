@extends('admin_template')
@section('page_title', __('category.add_category'))
@section('content')
<div class="container mt-2 box">
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> {{__('category.back')}}</a>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('categories.store') }}" id="myform" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <strong>{{__('category.category_name')}}:</strong>
                    <input type="text" name="name" class="form-control" placeholder="{{__('category.category_name')}}">
                    @error('name')
                    <span class="help-block">
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary ml-3">{{__('category.submit')}}</button>
            </div>
        </div>
    </form>
    @include('widgets.formValidator')
@endsection
