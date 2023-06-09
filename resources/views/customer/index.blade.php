@extends('customer.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>customer Data</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('customer.create') }}"> Create New customer</a>
            </div>
        </div>
    </div>
    @if ($message=Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
        </div>

    @endif
    <form action="{{ route('customer.index') }}" method="GET">

        <div class="form-group">
            <input type="text" name="search" id="" class="form-control" placeholder="Search by name" value="{{$search}}">
            <button class="btn btn-primary">Search</button>
        <a href="{{url('/customer')}}">
            <button class="btn btn-primary">Reset</button>
        </a>
        </div>

    </form>
    <table class="table" id="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>phone</th>
                <th>email</th>
                <th>address</th>
                <th>city</th>
                <th>state</th>
                <th>country</th>
                <th>postalCode</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($categories as $customer)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td><img src="/images/{{ $customer->image }}" width="100px"></td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <form action="{{ route('customer.destroy', $customer->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('customer.show', $customer->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('customer.edit', $customer->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach --}}
            @foreach ($customers as $customer)
                <tr class="customer{{ $customer->id }}">
                    <td>{{ ++$i }}</td>
                    {{-- <td>{{ $customer->no }}</td> --}}
                    {{-- {{dd($customer->image )}} --}}
                    <td>{{ $customer->firstname }}</td>
                    <td>{{ $customer->lastname }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->city }}</td>
                    <td>{{ $customer->state }}</td>
                    <td>{{ $customer->country    }}</td>
                    <td>{{ $customer->postalCode }}</td>



                    {{-- <td>{{ $customer->action }}</td> --}}
                    <td>
                        <form action="{{ route('customer.destroy', $customer->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('customer.show', $customer->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('customer.edit', $customer->id) }}">Edit</a>
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
            $('#customerTable').DataTable();
        });
    </script>


    {!! $customers->links() !!}
@endsection
