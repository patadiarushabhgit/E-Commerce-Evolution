@extends('category.layout')

@section('content')

    <div class="col-lg-12 margin-tb" style="margin-bottom: 20px; padding: 10px; align-items=center;" >
        <div class="pull-left">
            <h1>Category</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-success btn-lg" href="{{ route('category.create') }}" style="margin-left: 10px; padding: 10px;">Create New Category</a>
        </div>
    </div>


    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="zero_configuration_table" class="table table-hover" style="width: 100%">
                        <thead>
                            <tr>
                                <th><h3>id</h3></th>
                                <th><h3>Category Name</h3></th>
                                <th><h3>Category Status</h3></th>
                                <th><h3>Image</h3></th>
                                <th><h3>Action</h3></th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
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
