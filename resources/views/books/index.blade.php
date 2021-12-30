@extends('admin_template')
@section('page_title', __('book.books'))
@section('content')
    <div class="container mt-2 box">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            @if (!\Illuminate\Support\Facades\Auth::guest() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                <div class="pull-right mb-2 ml-2">
                    <a class="btn btn-success" href="{{ route('books.create') }}"> {{__('book.add_book')}} </a>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('export.books') }}"> {{__('book.export_excel')}} </a>
                </div>
            @endif

        </div>
    </div>
    <form method="get" action="{{ route('books.index') }}">
        <div class="form-group">
            <div class="col-xs">
                {{__('book.category')}} :

                <select name="category_id">
                    <option value="-1"{{ -1 == $category_id  ? 'selected="selected"':'' }}>{{__('book.all')}} </option>
                    <option value="0" {{ 0 == $category_id  ? 'selected="selected"':'' }} >{{__('book.uncategorized')}} </option>
                    @foreach ($categories as $category)
                        <option {{ $category->id == $category_id  ? 'selected="selected"':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                {{__('book.keyword')}}:

                <input type="text" name="keyword"  placeholder="{{__('book.keyword')}}" value="{{ $keyword }}">

                <button type="submit" class="btn btn-primary">{{__('book.search')}}</button>
            </div>
        </div>

    </form>
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th>{{__('book.book_id')}}</th>
            <th>{{__('book.book_title')}}</th>
            <th>{{__('book.book_edition')}}</th>
            <th>{{__('book.category')}}</th>
            <th width="280px">{{__('book.action')}}</th>
        </tr>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->edition }}</td>
                <td>{{ $book->getCategoryName() }}</td>
                <td>
                    @if (!\Illuminate\Support\Facades\Auth::guest() && \Illuminate\Support\Facades\Auth::user()->isAdmin())
                        <form action="{{ route('books.destroy',$book->id) }}" method="Post">
                            <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">{{__('book.edit')}}</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{__('book.delete')}}</button>
                        </form>
                    @endif
                    <form action="{{ route('orders.create',$book->id) }}" method="Post">
                        @csrf
                        <button type="submit" {{ $book->in_library != \App\Models\Book::STATUS_IN_LIB  ? 'disabled="disabled""':'' }} class="btn  {{ $book->in_library == \App\Models\Book::STATUS_IN_LIB  ? 'btn-primary':'btn-default' }}">{{__('book.borrow_book')}}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $books->links() }}
    @include('widgets.download',['download_route'=>route('export.books')])
@endsection
