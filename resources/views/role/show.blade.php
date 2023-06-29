@extends('role.layout')

@section('content')

<div class="card" style="margin:20px">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Show Role</h3>
            <a class="btn btn-primary" href="{{ route('role.index') }}">Back</a>
        </div>
        <hr>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <span class="text-lg">{{ $role->name }}</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permissions:</strong>
                    <ul>
                        @if (!empty($rolePermissions))
                            @foreach ($rolePermissions as $v)
                                <li>{{ $v->name }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
