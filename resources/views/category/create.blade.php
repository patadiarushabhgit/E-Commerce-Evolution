@extends('category.layout')

@section('content')





    <div class="container">
        <div class="row justify-content-between align-items-center mb-4">
            <div class="col-md-6">
                <h2 style="color: #333; font-size: 24px;">Add New Category</h2>
            </div>
            <div class="col-md-6 text-md-right">
                <a class="btn btn-primary" href="{{ route('category.index') }}" style="font-size: 16px;">Back</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" style="font-size: 18px;">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="border rounded p-4"
            style="background-color: #f9f9f9;">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" style="color: #555; font-size: 18px;">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                            style="font-size: 16px;">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label style="color: #555; font-size: 18px;">Status:</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="status1" name="status" value="1" class="custom-control-input">
                            <label class="custom-control-label" for="status1"
                                style="color: #555; font-size: 16px;">Active</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="status0" name="status" value="0" class="custom-control-input">
                            <label class="custom-control-label" for="status0"
                                style="color: #555; font-size: 16px;">Inactive</label>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="image" style="color: #555; font-size: 18px;">Image:</label>
                        <input type="file" name="image" id="image" class="form-control-file"
                            style="font-size: 16px;">
                        <img id="preview-image" src="#" alt="Preview" width="100px" style="display: none;">
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary"
                        style="background-color: #337ab7; border-color: #337ab7; font-size: 16px;">Submit</button>
                </div>
            </div>
        </form>
    </div>


@endsection
