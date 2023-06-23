
@extends('products.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-bottom: 20px; margin-top:20px; padding: 10px;">
            <div class="pull-left">
                <h2 style="font-size: 24px;">Products</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}" style="font-size: 16px;">Create New Product</a>
            </div>
        </div>

    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" style="font-size: 16px;">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Code</th>
            <th>Thumbnail</th>
            <th>Price</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Category ID</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ ++$i }}</td>
                <td style="font-size: 16px;">{{ $product->name }}</td>
                <td style="font-size: 16px;">{{ $product->brand }}</td>
                <td style="font-size: 16px;">{{ $product->code }}</td>
                <td style="font-size: 16px;">{{ $product->thumbnail }}</td>
                <td style="font-size: 16px;">{{ $product->price }}</td>
                <td style="font-size: 16px;">{{ $product->description }}</td>
                <td style="font-size: 16px;">{{ $product->quantity }}</td>
                <td style="font-size: 16px;">{{ $product->status }}</td>
                <td style="font-size: 16px;">{{ $product->cat_id }}</td>
                <td>
                    <form action="{{ route('products.destroy',$product->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('products.show',$product->id) }}" style="font-size: 16px;">Show</a>

                        <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}" style="font-size: 16px;">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger" style="font-size: 16px;">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $products->links() !!}
    <script type="text/javascript">
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $(document).ready(function() {
                dtable = $('#zero_configuration_table').DataTable({
                    "language": {
                        "lengthMenu": "_MENU_"
                    },
                    "columnDefs": [{
                        "targets": "_all",
                        "orderable": false
                    }],
                    responsive: true,
                    'serverSide': true,
                    "ajax": {
                        "url": "{{ route('category.getCategory') }}",
                        "type": "POST",
                        "data": function(data) {
                            data._token = $('meta[name="csrf-token"]').attr('content');

                        },

                    }
                });

                $('.panel-ctrls').append("<i class='separator'></i>");

                $('.panel-footer').append($(".dataTable+.row"));
                $('.dataTables_paginate>ul.pagination').addClass("pull-right");

                $("#apply_filter_btn").click(function() {
                    dtable.ajax.reload(null, false);
                });
            });

    </script>


@endsection
