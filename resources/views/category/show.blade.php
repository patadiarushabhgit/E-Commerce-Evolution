@extends('category.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow">
                <div class="card-header bg-light border-0">
                    <h2 class="text-center mb-0">Show Category</h2>
                </div>
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label class="font-weight-bold">Name:</label>
                        <p class="m-0">{{ $category->name }}</p>
                    </div>
                    <div class="form-group mb-4">
                        <label class="font-weight-bold">Status:</label>
                        <p class="m-0">{{ $category->status == 1 ? 'Active' : 'Inactive' }}</p>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Image:</label>
                        <div class="text-center">
                            <img src="../{{$category->image }}" width="100px" alt="Category Image">
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0">
                    <a class="btn btn-secondary" href="{{ route('category.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
