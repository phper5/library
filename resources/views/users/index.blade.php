@extends('admin_template')
@section('page_title', __('user.users'))
@section('content')
    <div class="container mt-2 box">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mb-2 ml-2">
                <a class="btn btn-success" href="{{ route('users.create') }}"> {{__('user.add_new_user')}} </a>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('export.users') }}"> {{__('user.export_excel')}} </a>
            </div>
        </div>
    </div>
    <form method="get" action="{{ route('users.index') }}">
        <div class="form-group">
            <div class="col-xs">
                {{__('user.role')}}:

                <select name="role">
                    <option value="-1"{{ -1 == $role  ? 'selected="selected"':'' }}>{{__('user.all')}}</option>
                    <option value="1" {{ 1 == $role  ? 'selected="selected"':'' }} >{{__('user.admin')}}</option>
                    <option value="0" {{ 0 == $role  ? 'selected="selected"':'' }} >{{__('user.member')}}</option>
                </select>

                Keyword:

                <input type="text" name="keyword"  placeholder="keyword" value="{{ $keyword }}">

                <button type="submit" class="btn btn-primary">{{__('user.search')}}</button>
            </div>
        </div>

    </form>
    <table class="table table-bordered table-hover dataTable">
        <tr>
            <th>{{__('user.user_id')}}</th>
            <th>{{__('user.name')}}</th>
            <th>{{__('user.email')}}</th>
            <th>{{__('user.role')}}</th>
            <th>{{__('user.created_at')}}</th>
            <th width="280px">{{__('user.action')}}</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role == \App\Models\User::ROLE_ADMIN?'admin':'member' }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <form action="{{ route('books.destroy',$user->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('orders.all',['user_id'=>$user->id,'status'=>0]) }}">{{__('user.borrowed_books')}}</a>
                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">{{__('user.edit')}}</a>
                        @csrf
{{--                        @method('DELETE')--}}
{{--                        <button type="submit" class="btn btn-danger">Delete</button>--}}
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $users->links() }}
    @include('widgets.download',['download_route'=>route('export.users')])
@endsection
