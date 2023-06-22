@extends('category.layout')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card bg-light">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="btn btn-primary btn-sm" href="{{ route('category.index') }}">Back</a>
                        <h2 class="text-primary">Edit Category</h2>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('category.update', $category->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name" class="text-primary">Name:</label>
                            <input type="text" name="name" value="{{ $category->name }}"
                                class="form-control bg-light" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label class="text-primary">Status:</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="active" name="status" value="1"
                                    {{$category->status == 1 ? 'checked' : '' }} required>
                                <label for="status1" class="form-check-label">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="status0" name="status" value="0"
                                    {{$category->status == 0 ? 'checked ' : ''}} required>
                                <label for="status0" class="form-check-label">Inactive</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="text-primary">Image:</label>
                            <div class="d-flex align-items-center">
                                <input type="file" name="image" class="form-control-file bg-light" id="image">
                                <img src="/{{ $category->image }}" width="150px" class="ml-4"
                                    style="border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-danger" id="deleteImageBtn">Delete Image</button>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card bg-light">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="btn btn-primary btn-sm" href="{{ route('category.index') }}" style="font-size: 14px;">Back</a>
                        <h2 class="text-primary" style="font-size: 24px;">Edit Category</h2>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('category.update', $category->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name" class="text-primary" style="font-size: 18px;">Name:</label>
                            <input type="text" name="name" value="{{ $category->name }}"
                                class="form-control bg-light" style="font-size: 16px;" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label class="text-primary" style="font-size: 18px;">Status:</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="active" name="status" value="1"
                                    {{$category->status == 1 ? 'checked' : '' }} required>
                                <label for="status1" class="form-check-label" style="font-size: 16px;">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="status0" name="status" value="0"
                                    {{$category->status == 0 ? 'checked ' : ''}} required>
                                <label for="status0" class="form-check-label" style="font-size: 16px;">Inactive</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="text-primary" style="font-size: 18px;">Image:</label>
                            <div class="d-flex align-items-center">
                                <input type="file" name="image" class="form-control-file bg-light" id="image">
                                <img src="/{{ $category->image }}" width="150px" class="ml-4"
                                    style="border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-danger" id="deleteImageBtn" style="font-size: 14px;">Delete Image</button>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary" style="font-size: 16px;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
