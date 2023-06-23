@extends('products.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow">
                    <div class="card-header bg-light border-0">
                        <h2 class="text-center mb-0" style="font-size: 24px; color: #333; margin-top:20px; margin-bottom:20px">Show product</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold"
                                style="font-size: 18px; color: #555;">Name:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" style="font-size: 16px; color: #777;">{{ $product->name }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold"
                                style="font-size: 18px; color: #555;">Brand:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" style="font-size: 16px; color: #777;">{{ $product->brand }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold"
                                style="font-size: 18px; color: #555;">Code:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" style="font-size: 16px; color: #777;">{{ $product->code }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold"
                                style="font-size: 18px; color: #555;">Description:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" style="font-size: 16px; color: #777;">
                                    {{ $product->description }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold"
                                style="font-size: 18px; color: #555;">Price:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" style="font-size: 16px; color: #777;">{{ $product->price }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold"
                                style="font-size: 18px; color: #555;">Quantity:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" style="font-size: 16px; color: #777;">
                                    {{ $product->quantity }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold"
                                style="font-size: 18px; color: #555;">Cat ID:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" style="font-size: 16px; color: #777;">{{ $product->cat_id }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold"
                                style="font-size: 18px; color: #555;">Status:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static" style="font-size: 16px; color: #777;">
                                    {{ $product->status == 1 ? 'Active' : 'Inactive' }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold"
                                style="font-size: 18px; color: #555;">Thumbnail:</label>
                            <div class="col-sm-9">
                                <div class="text-center">
                                    <img src="../{{ $product->thumbmail }}" width="200px" alt="product Image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0">
                        <a class="btn btn-secondary" href="{{ route('products.index') }}"
                            style="font-size: 16px; background-color: #337ab7; border-color: #337ab7; color: #fff;">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
