@extends('products.layout')

@section('content')
    {{-- <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 style="font-size: 24px;">Add New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}" style="font-size: 16px;"> Back</a>
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

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h3><strong>Name:</strong></h3>
                    <input type="text" name="name" class="form-control" style="font-size: 16px;" placeholder="Name">
                </div>
                <div class="form-group">
                    <h3><strong>Brand:</strong></h3>
                    <input type="text" class="form-control" name="brand" style="font-size: 16px;"
                        placeholder="Enter brand name">
                </div>
                <div class="form-group">
                    <h3><strong>Code:</strong></h3>
                    <input type="text" class="form-control" name="code" style="font-size: 16px;"
                        placeholder="Enter Code">
                </div>
                <div class="form-group">
                    <h3><strong>Thumbnail:</strong></h3>
                    <input type="file" class="form-control" name="thumbnail" style="font-size: 16px;"
                        placeholder="Thumbnail" accept="image">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h3><strong>Price:</strong></h3>
                    <input type="text" class="form-control" name="price" style="font-size: 16px;" placeholder="Price">
                </div>
                <div class="form-group">
                    <h3><strong>Description:</strong></h3>
                    <input type="text" class="form-control" name="description" style="font-size: 16px;"
                        placeholder="Description">
                </div>
                <div class="form-group">
                    <h3><strong>Quantity:</strong></h3>
                    <input type="text" class="form-control" name="quantity" style="font-size: 16px;"
                        placeholder="Quantity">
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <h3><strong>Status:</strong></h3>
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
                <div class="form-group">
                    <h3><strong>Category ID:</strong></h3>
                    <input type="text" class="form-control" name="cat_id" style="font-size: 16px;"
                        placeholder="Category ID">
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="font-size: 16px;">Submit</button>
        </div>
    </form> --}}

    <!DOCTYPE html>
<html>

<head>
    <title>Add New Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-title {
            font-size: 24px;
            color: #333;
            margin-top: 30px;
            margin-bottom: 30px;
            text-align: center;
        }

        .btn-back {
            font-size: 16px;
            margin-top: 25px;
            margin-right: 10px;
        }

        .error-message {
            font-size: 16px;
        }

        .form-label {
            font-size: 18px;
        }

        .form-control {
            font-size: 16px;
        }

        .radio-label {
            color: #555;
            font-size: 16px;
        }

        .submit-btn {
            font-size: 16px;
        }

        .status-div {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <h2 class="form-title">Add New Product</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary btn-back" href="{{ route('products.index') }}">Back</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger error-message">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label"><strong>Name:</strong></label>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><strong>Brand:</strong></label>
                        <input type="text" class="form-control" name="brand" placeholder="Enter brand name">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><strong>Code:</strong></label>
                        <input type="text" class="form-control" name="code" placeholder="Enter Code">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><strong>Thumbnail:</strong></label>
                        <input type="file" class="form-control" name="thumbnail" placeholder="Thumbnail"
                            accept="image">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label"><strong>Price:</strong></label>
                        <input type="text" class="form-control" name="price" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><strong>Description:</strong></label>
                        <input type="text" class="form-control" name="description" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><strong>Quantity:</strong></label>
                        <input type="text" class="form-control" name="quantity" placeholder="Quantity">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><strong>Category ID:</strong></label>
                        <input type="text" class="form-control" name="cat_id" placeholder="Category ID">
                    </div>
                    <div class="status-div">
                        <label class="form-label"><strong>Status:</strong></label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="status1" name="status" value="1" class="custom-control-input">
                            <label class="custom-control-label radio-label" for="status1">Active</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="status0" name="status" value="0" class="custom-control-input">
                            <label class="custom-control-label radio-label" for="status0">Inactive</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>


@endsection

