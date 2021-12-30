@extends('admin_template')
@section('page_title', __('book.view_book'))
@section('content')
    <div class="container mt-2 box">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('books.index') }}" enctype="multipart/form-data"> {{__('book.back')}}</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{__('book.book_title')}}:</strong>
                    {{ $book->title }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{__('book.book_edition')}}:</strong>
                    {{ $book->edition }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{__('book.book_category')}}:</strong>
                    {{ $book->getCategoryName() }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <form action="{{ route('books.destroy',$book->id) }}" method="Post">
                    <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">{{__('book.edit')}}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{__('book.delete')}}</button>
                </form>
                <form action="{{ route('orders.create',$book->id) }}" method="Post">
                @csrf
                <button type="submit" {{ $book->in_library != \App\Models\Book::STATUS_IN_LIB  ? 'disabled="disabled""':'' }} class="btn  {{ $book->in_library == \App\Models\Book::STATUS_IN_LIB  ? 'btn-primary':'btn-default' }}">{{__('book.borrow_book')}}</button>
                </form>
            </div>

        </div>

    </div>
@endsection
