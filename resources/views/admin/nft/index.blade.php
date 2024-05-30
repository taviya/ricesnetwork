@extends('admin.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Nft</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Nft
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
                            data-bs-target=".nft_add">Add Nft <i class="fas fa-plus"></i></button>
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
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 187.937px;">Category</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 187.937px;">Price</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 187.937px;">Image</th>
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
                                                    <th rowspan="1" colspan="1">Name</th>
                                                    <th rowspan="1" colspan="1">Category</th>
                                                    <th rowspan="1" colspan="1">Price</th>
                                                    <th rowspan="1" colspan="1">Image</th>
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

    <div class="modal fade nft_add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Nft</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="nft_form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" data-validation="required" name="name" class="form-control"
                                id="name">
                        </div>
                        <div class="form-group">
                            <label for="category" class="col-form-label">Select Category:</label>
                            <select name="category_id" data-validation="required"
                                class="form-select shadow-none select2-hidden-accessible"
                                style="width: 100%; height: 36px">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-form-label">Image:</label>
                            <input type="file" data-validation="required" name="image" class="form-control"
                                id="image">
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-form-label">Price:</label>
                            <input type="number" data-validation="required" name="price" class="form-control"
                                id="price">
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

    <div class="modal fade nft_edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Nft</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="nft_edit_form">
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
                ajax: "{{ route('nft.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#nft_form').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('nft.store') }}",
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
                        $('#nft_form').css("opacity", ".5");
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".nft_add").modal('hide');
                            message(response.message);
                            $('#nft_form')[0].reset();
                            table.ajax.reload();
                        }
                        $('#nft_form').css("opacity", "");
                        $(".submitBtn").removeAttr("disabled");
                    },
                    error: function(xhr) {
                        $('#nft_form').css("opacity", "");
                        $(".submitBtn").removeAttr("disabled");
                        var error = '';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            error += value + "<br>";
                        });
                        message(error, 'danger');
                    }
                });
            });

            $('body').on('click', '.show-nft', function() {
                var showId = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ url('admin/nft') }}/" + showId + "/edit",
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
                        $(".nft_edit").modal('show');
                        $("#nft_edit_form").html(response.data);
                    },
                    error: function(xhr) {

                    }
                });
            });

            $('body').on('click', '.delete-nft', function() {
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
                            url: "{{ url('admin/nft') }}/" + deleteId,
                            data: {},
                            dataType: 'json',
                            contentType: false,
                            cache: false,
                            processData: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                $('#nft_form').css("opacity", ".5");
                            },
                            success: function(response) {
                                if (response.status) {
                                    // message(response.message);
                                    table.ajax.reload();
                                    Swal.fire('Delete!', '', 'success');
                                }
                                $('#nft_form').css("opacity", "");
                            },
                            error: function(xhr) {

                            }
                        });
                    }
                });
            });

            $('#nft_edit_form').submit(function(event) {
                event.preventDefault();
                var editId = $(this).find('input[name="update_id"]').val();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/nft') }}/" + editId,
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
                        $('#nft_edit_form').css("opacity", ".5");
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".nft_edit").modal('hide');
                            message(response.message);
                            table.ajax.reload();
                        }
                        $('#nft_edit_form').css("opacity", "");
                        $(".submitBtn").removeAttr("disabled");
                    },
                    error: function(xhr) {
                        $('#nft_edit_form').css("opacity", "");
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
