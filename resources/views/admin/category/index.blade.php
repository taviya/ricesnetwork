@extends('admin.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Category</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Category
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" id="add_user" class="float-end btn btn-primary" data-bs-toggle="modal"
                            data-bs-target=".category_add">Add Category <i class="fas fa-plus"></i></button>
                    </div>
                    <div class="card-body">
                        {{-- <h5 class="card-title">Basic Datatable</h5> --}}
                        <div class="table-responsive">
                            <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="zero_config"
                                            class="table table-striped table-bordered dataTable data-table" role="grid"
                                            aria-describedby="zero_config_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 112.421px;">Sr No.</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 187.937px;">Title</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending"
                                                        style="width: 82.7381px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">Sr No.</th>
                                                    <th rowspan="1" colspan="1">Title</th>
                                                    <th rowspan="1" colspan="1">Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade category_add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="category_form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title:</label>
                            <input type="text" data-validation="required" name="title" class="form-control"
                                id="title">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submitBtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade category_edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="category_edit_form">
                    <!-- Ajax Response -->
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('public/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ asset('public/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
@endpush

@push('custon-scripts')
    <script>
        $.validate({
            modules: 'date, security, file',
        });

        $(document).ready(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('category.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#category_form').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('category.store') }}",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('.submitBtn').attr("disabled", "disabled");
                        $('#category_form').css("opacity", ".5");
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".category_add").modal('hide');
                            message(response.message);
                            $('#category_form')[0].reset();
                            table.ajax.reload();
                        }
                        $('#category_form').css("opacity", "");
                        $(".submitBtn").removeAttr("disabled");
                    },
                    error: function(xhr) {
                        $('#category_form').css("opacity", "");
                        $(".submitBtn").removeAttr("disabled");
                        var error = '';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            error += value + "<br>";
                        });
                        message(error, 'danger');
                    }
                });
            });

            $('body').on('click', '.show-category', function() {
                var showId = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ url('admin/category') }}/" + showId + "/edit",
                    data: {},
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {

                    },
                    success: function(response) {
                        $(".category_edit").modal('show');
                        $("#category_edit_form").html(response.data);
                    },
                    error: function(xhr) {

                    }
                });
            });

            $('body').on('click', '.delete-category', function() {
                var deleteId = $(this).data('id');
                Swal.fire({
                    title: 'Do you want to delete this record?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: "{{ url('admin/category') }}/" + deleteId,
                            data: {},
                            dataType: 'json',
                            contentType: false,
                            cache: false,
                            processData: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                $('#category_form').css("opacity", ".5");
                            },
                            success: function(response) {
                                if (response.status) {
                                    // message(response.message);
                                    table.ajax.reload();
                                    Swal.fire('Delete!', '', 'success');
                                }
                                $('#category_form').css("opacity", "");
                            },
                            error: function(xhr) {

                            }
                        });
                    }
                });
            });

            $('#category_edit_form').submit(function(event) {
                event.preventDefault();
                var editId = $(this).find('input[name="update_id"]').val();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/category') }}/" + editId,
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('.submitBtn').attr("disabled", "disabled");
                        $('#category_edit_form').css("opacity", ".5");
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".category_edit").modal('hide');
                            message(response.message);
                            table.ajax.reload();
                        }
                        $('#category_edit_form').css("opacity", "");
                        $(".submitBtn").removeAttr("disabled");
                    },
                    error: function(xhr) {
                        $('#category_edit_form').css("opacity", "");
                        $(".submitBtn").removeAttr("disabled");
                        var error = '';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            error += value + "<br>";
                        });
                        message(error, 'danger');
                    }
                });
            });
        });
    </script>
@endpush
