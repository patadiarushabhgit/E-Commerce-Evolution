@extends('category.layout')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow">
                <div class="card-header bg-light border-0">
                    <h2 class="text-center mb-0" style="font-size: 24px; color: #333;">Show Category</h2>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold" style="font-size: 18px; color: #555;">Name:</label>
                        <div class="col-sm-9">
                            <p class="form-control-static" style="font-size: 16px; color: #777;">{{ $category->name }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold" style="font-size: 18px; color: #555;">Status:</label>
                        <div class="col-sm-9">
                            <p class="form-control-static" style="font-size: 16px; color: #777;">{{ $category->status == 1 ? 'Active' : 'Inactive' }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label font-weight-bold" style="font-size: 18px; color: #555;">Image:</label>
                        <div class="col-sm-9">
                            <div class="text-center">
                                <img src="../{{$category->image }}" width="200px" alt="Category Image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0">
                    <a class="btn btn-secondary" href="{{ route('category.index') }}" style="font-size: 16px; background-color: #337ab7; border-color: #337ab7; color: #fff;">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
