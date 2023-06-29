@extends('role.layout')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card" style="border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0,0,0,.1); margin:50px">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 style="font-size: 24px; margin-bottom: 30px; margin-top: 30px; padding-bottom: 10px;">Create New Role</h2>
                        </div>
                        <div class="col-lg-4 text-right">
                            <a class="btn btn-primary" href="{{ route('role.index') }}" style="font-size: 16px;">Back</a>
                        </div>
                    </div>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger" style="font-size: 16px; margin-bottom: 30px; padding: 10px;">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group" style="margin-bottom: 30px;">
                            <label style="font-size: 16px; margin-bottom:10px"><strong>Name:</strong></label>
                            <input type="text" name="role" placeholder="Name" class="form-control" style="font-size: 16px; padding: 5px; border: 1px solid #ddd;">
                        </div>

                        <div class="form-group" style="margin-bottom: 30px;">
                            <label style="font-size: 16px; margin-bottom:10px"><strong>Permission:</strong></label>
                            <br />
                            @foreach ($permissions as $value)
                                <label style="font-size: 16px;"><input type="checkbox" name="permissions[]" value="{{ $value->id }}" class="name" style="transform: scale(1.5);">
                                    {{ $value->name }}
                                </label>
                                <br />
                            @endforeach
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" style="font-size: 16px;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
