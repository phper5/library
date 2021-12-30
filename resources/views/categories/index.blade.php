@extends('admin_template')
@section('page_title', __('category.book_categories'))
@section('content')
    <div class="container mt-2 box">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('categories.create') }}"> {{__('category.add_category')}}</a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th>{{__('category.category_id')}}</th>
            <th>{{__('category.category_name')}}</th>
            <th width="280px">{{__('category.action')}}</th>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <form action="{{ route('categories.destroy',$category->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">{{__('category.edit')}}</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{__('category.delete')}}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $categories->links() }}
@endsection
