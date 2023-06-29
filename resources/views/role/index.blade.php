@extends('role.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div style="margin:20px;" class="pull-left">
                <h2>Roles</h2>
            </div>
            <div  style="margin:20px;"    class="pull-right">
                <a class="btn btn-success" href="{{ route('role.create') }}"> Create New role</a>
            </div>
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

                    <table id="zero_configuration_table" class="table table-hover" style=width:100%>
                        <thead>
                            <tr>
                                <th>id</th>
                                {{-- <th>image</th> --}}
                                <th>Name</th>
                                <th>Action</th>
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
                    "url": "{{ route('getRoles') }}",
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
