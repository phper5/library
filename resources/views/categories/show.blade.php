@extends('admin_template')
@section('page_title', __('category.view_category'))
@section('content')
    <div class="container mt-2 box">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('categories.index') }}" enctype="multipart/form-data"> {{__('category.back')}}</a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{__('category.category_name')}}:</strong>
                    {{ $category->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <form action="{{ route('categories.destroy',$category->id) }}" method="Post">
                    <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">{{__('category.edit')}}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{__('category.delete')}}</button>
                </form>
            </div>

        </div>

    </div>
@endsection
