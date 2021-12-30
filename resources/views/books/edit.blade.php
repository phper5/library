@extends('admin_template')
@section('page_title', __('book.edit_book'))
@section('content')
<div class="container mt-2 box">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}" enctype="multipart/form-data"> {{__('book.back')}}</a>
            </div>
        </div>
    </div>
    @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('books.update',$book->id) }}" id="myform" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                    <strong>{{__('book.book_category')}}:</strong>
                    <select name="category_id">
                        <option value="0" {{ 0 == $book->category_id  ? 'selected="selected"':'' }} >{{__('book.uncategorized')}}</option>
                        @foreach ($categories as $category)
                            <option {{ $category->id == $book->category_id  ? 'selected="selected"':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="help-block">
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <strong>{{__('book.book_title')}}:</strong>
                    <input type="text" name="title" value="{{ $book->title }}" class="form-control" placeholder="{{__('book.book_title')}}">
                    @error('title')
                    <span class="help-block">
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group{{ $errors->has('edition') ? ' has-error' : '' }}">
                    <strong>{{__('book.book_edition')}}:</strong>
                    <input type="text" name="edition" value="{{ $book->edition }}" class="form-control" placeholder="{{__('book.book_edition')}}">
                    @error('edition')
                    <span class="help-block">
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary ml-3">{{__('book.submit')}}</button>
            </div>
        </div>
    </form>
    @include('widgets.formValidator')
</div>
@endsection
