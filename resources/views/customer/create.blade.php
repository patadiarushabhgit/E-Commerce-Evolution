@extends('customer.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Customer</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('customer.index') }}">Back</a>
        </div>
    </div>
</div>

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

<form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" class="form-control" placeholder="First Name">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" class="form-control" placeholder="Last Name">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone_no">Phone No:</label>
                <input type="tel" name="phone_no" class="form-control" placeholder="Phone No">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" class="form-control" placeholder="Address">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="country">Country:</label>
                <select name="country" class="form-control" id="country">
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="state">State:</label>
                <select name="state" class="form-control" id="state"></select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="city">City:</label>
                <select name="city" class="form-control" id="city">
                    <option value="">Select City</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="postal_code">Postal Code:</label>
                <input type="number" name="postal_code" class="form-control" placeholder="Postal Code">
            </div>
        </div>

        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        // Fetch states based on the selected country
        $('#country').on('change', function() {
            var idCountry = this.value;
            $("#state").html('');
            $.ajax({
                url: "{{ route('getStatesByCountry') }}",
                type: "POST",
                data: {
                    cid: idCountry,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#state').html('<option value="">-- Select State --</option>');
                    $.each(result.states, function(key, value) {
                        $("#state").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $('#city').html('<option value="">-- Select City --</option>');
                }
            });
        });

        // Fetch cities based on the selected state
        $('#state').change(function () {
            var stateId = $(this).val();
            if (stateId) {
                $.ajax({
                    url: '{{ route('cities.getCitiesByState') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        state_id: stateId
                    },
                    success: function (data) {
                        $('#city').html('<option value="">Select City</option>');
                        $.each(data.cities, function (key, value) {
                            $('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#city').html('<option value="">Select City</option>');
            }
        });
    });
</script>
@endpush
