@extends('category.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Category Data</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('category.create') }}"> Create New Category</a>
            </div>
        </div>
    </div>
    <form action="{{ route('category.index') }}" method="GET">

        <div class="form-group">
            <input type="text" name="search" id="" class="form-control" placeholder="Search by name" value="{{$search}}">
            <button class="btn btn-primary">Search</button>
        <a href="{{url('/category')}}">
            <button class="btn btn-primary">Reset</button>
        </a>
        </div>

    </form>
    <table class="table" id="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($categories as $category)
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
            @foreach ($categories as $category)
                <tr class="category{{ $category->id }}">
                    <td>{{ ++$i }}</td>
                    {{-- <td>{{ $category->no }}</td> --}}
                    {{-- {{dd($category->image )}} --}}
                    <td><img src="{{ $category->image }}" width="100px"></td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status==1?'Active':'Inactive'}}</td>
                    {{-- <td>{{ $category->action }}</td> --}}
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
            @endforeach
        </tbody>
    </table>

    <script src="{{ asset('datatables/datatables.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#categoryTable').DataTable();
        });
    </script>


    {!! $categories->links() !!}
@endsection
