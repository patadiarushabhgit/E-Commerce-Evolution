@extends('customer.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow">
                    <div class="card-header bg-light border-0">
                        <h2 class="text-center mb-0">Show customer</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-4">
                            <label class="font-weight-bold">First Name:</label>
                            <p class="m-0">{{ $customer->firstname }}</p>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Last Name:</label>
                            <p class="m-0">{{ $customer->lastname }}</p>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Phone:</label>
                            <p class="m-0">{{ $customer->phone }}</p>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Email:</label>
                            <p class="m-0">{{ $customer->email }}</p>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Address:</label>
                            <p class="m-0">{{ $customer->address }}</p>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">City:</label>
                            <p class="m-0">{{ $customer->city }}</p>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">State:</label>
                            <p class="m-0">{{ $customer->state }}</p>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Country:</label>
                            <p class="m-0">{{ $customer->country }}</p>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Postal Code:</label>
                            <p class="m-0">{{ $customer->postalCode }}</p>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0">
                        <a class="btn btn-secondary" href="{{ route('customer.index') }}">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
