

@extends('products.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left" style="margin-bottom: 20px;">
                <h2 style="font-size: 24px; margin-top: 20px; margin-bottom: 20px;">Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}" style="font-size: 16px; margin-top: 20px; margin-bottom: 20px; padding: 10px 20px;">Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger" style="font-size: 16px;">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h3><strong>Name:</strong></h3>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                        style="font-size: 16px;" placeholder="Name">
                </div>
                <div class="form-group">
                    <h3><strong>Brand:</strong></h3>
                    <input type="text" name="brand" value="{{ $product->brand }}" class="form-control"
                        style="font-size: 16px;" placeholder="Brand">
                </div>
                <div class="form-group">
                    <h3><strong>Code:</strong></h3>
                    <input type="text" name="code" value="{{ $product->code }}" class="form-control"
                        style="font-size: 16px;" placeholder="Code">
                </div>
                <div class="form-group">
                    <h3><strong>Thumbnail:</strong></h3>
                    <input type="text" name="thumbnail" value="{{ $product->thumbnail }}" class="form-control"
                        style="font-size: 16px;" placeholder="Thumbnail">
                </div>
                <div class="form-group">
                    <h3><strong>Price:</strong></h3>
                    <input type="text" name="price" value="{{ $product->price }}" class="form-control"
                        style="font-size: 16px;" placeholder="Price">
                </div>
                <div class="form-group">
                    <h3><strong>Description:</strong></h3>
                    <input type="text" name="description" value="{{ $product->description }}" class="form-control"
                        style="font-size: 16px;" placeholder="Description">
                </div>
                <div class="form-group">
                    <h3><strong>Quantity:</strong></h3>
                    <input type="text" name="quantity" value="{{ $product->quantity }}" class="form-control"
                        style="font-size: 16px;" placeholder="Quantity">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h3><strong>Status:</strong></h3>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="status1" name="status" value="1" class="custom-control-input">
                        <label class="custom-control-label" for="status1" style="color: #555; font-size: 16px;">Active</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="status0" name="status" value="0" class="custom-control-input">
                        <label class="custom-control-label" for="status0" style="color: #555; font-size: 16px;">Inactive</label>
                    </div>
                </div>
                <div class="form-group">
                    <h3><strong>Category ID:</strong></h3>
                    <input type="text" name="category_id" value="{{ $product->category_id }}" class="form-control"
                        style="font-size: 16px;" placeholder="Category ID">
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="font-size: 16px;">Submit</button>
        </div>
    </form>
@endsection

