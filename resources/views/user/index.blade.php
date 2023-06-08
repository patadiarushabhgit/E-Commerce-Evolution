@extends('user.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>User Data</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('user.create') }}"> Create New User</a>
            </div>
        </div>
    </div>
    <form action="{{ route('category.index') }}" method="GET">

        <div class="form-group">
            <input type="text" name="search" id="" class="form-control" placeholder="Search by name" value="{{$search}}">
            <button class="btn btn-primary">Search</button>
        <a href="{{url('/user')}}">
            <button class="btn btn-primary">Reset</button>
        </a>
        </div>

    </form>
    <table class="table" id="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Email</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($categories as $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td><img src="/images/{{ $category->image }}" width="100px"></td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('category.show', $category->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('category.edit', $category->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach --}}
            @foreach ($users as $user)
                <tr class="{{ $user->id }}">
                    <td>{{ ++$i }}</td>
                    {{-- <td>{{ $category->no }}</td> --}}

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email}}</td>
                    {{-- <td>{{ $category->action }}</td> --}}
                    <td>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('user.show', $user->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('user.edit', $user->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>




    {!! $users->links() !!}
@endsection
