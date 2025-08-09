@extends('layouts.master')

@section('content')
<script src="{{ URL::asset('assets/js/jQuery v3.7.1.js')}}"></script>
<script src="{{ URL::asset('assets/js/sweetalert2.js')}}"></script>
<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Data Rekanan</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Rekanan</li>
            </ol>
        </nav>
    </div>

    <div class="d-flex my-xl-auto right-content align-items-center">
        <div class="pe-1 mb-xl-0">
            <button type="button" class="btn btn-info btn-icon me-2 btn-b"><i class="mdi mdi-filter-variant"></i></button>
        </div>
        <div class="pe-1 mb-xl-0">
            <button type="button" class="btn btn-danger btn-icon me-2"><i class="mdi mdi-star"></i></button>
        </div>
        <div class="pe-1 mb-xl-0">
            <button type="button" class="btn btn-warning  btn-icon me-2"><i class="mdi mdi-refresh"></i></button>
        </div>
    </div>
</div>
<!-- Page Header Close -->
<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center">
        <div class="pe-1 mb-xl-0">
            @can('create rekanan')
            <a href="javascript:void(0)" class="btn btn-outline-primary waves-effect waves-light float-right" id="createNewrekanan"><i class="mdi mdi-plus-box me-2 d-inline-block"></i>Create</a>
            @endcan
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table  class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Name</th>
                            <th width="80px">Rekening</th>
                            <th width="180px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
<div class="modal fade" id="ajaxModelcreate" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="rekananFormcreate" name="rekananFormcreate" class="form-horizontal">

                   @csrf

                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="form-group">
                        <label for="uraian_rekanan" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="create_uraian_rekanan" name="create_uraian_rekanan" placeholder="Enter Name" value="" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rekening:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="create_rekening_rekanan" name="create_rekening_rekanan" placeholder="Enter Name" value="">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-success mt-2" id="saveBtncreate" value="create"><i class="fa fa-save"></i> Submit
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ajaxModelupdate" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading1"></h4>
            </div>
            <div class="modal-body">
                <form id="rekananFormupdate" name="rekananFormupdate" class="form-horizontal">
                   <input type="hidden" name="edit_rekanan_id" id="edit_rekanan_id">
                   <input type="hidden" name="edit_alamat_rekanan" id="edit_alamat_rekanan">
                   @csrf

                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="form-group">
                        <label for="uraian_rekanan" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit_uraian_rekanan" name="edit_uraian_rekanan" placeholder="Enter Name" value="" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rekening:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit_rekening_rekanan" name="edit_rekening_rekanan" placeholder="Enter Name" value="">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-success mt-2" id="saveBtnupdate" value="create"><i class="fa fa-save"></i> Submit
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"><i class="fa-regular fa-eye"></i> Show rekanan</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="show-uraian_rekanan" name="show-uraian_rekanan" placeholder="Enter Name" value="" maxlength="50">
                <p><strong>Name:</strong> <span class="show-uraian_rekanan"></span></p>
                <p><strong>rekening_rekanan:</strong> <span class="show-rekening_rekanan"></span></p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

      $(function () {

        /*------------------------------------------
         --------------------------------------------
         Pass Header Token
         --------------------------------------------
         --------------------------------------------*/
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });

        /*------------------------------------------
        --------------------------------------------
        Render DataTable
        --------------------------------------------
        --------------------------------------------*/
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('rekanan.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'uraian_rekanan', name: 'uraian_rekanan'},
                {data: 'rekening_rekanan', name: 'rekening_rekanan'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Button
        --------------------------------------------
        --------------------------------------------*/
        $('#createNewrekanan').click(function () {
            $('#saveBtncreate').val("create-rekanan");
            $('#rekanan_id').val('');
            $('#rekananFormcreate').trigger("reset");
            $('#modelHeading').html("<i class='fa fa-plus'></i> Create New Rekanan");
            $('#ajaxModelcreate').modal('show');
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.showrekanan', function () {
          var rekanan_id = $(this).data('id');
          $.get("{{ route('rekanan.index') }}" +'/' + rekanan_id, function (data) {
              $('#showModel').modal('show');
              $('.show-uraian_rekanan').text(data.uraian_rekanan);
              $('#show-uraian_rekanan').val(data.uraian_rekanan);
              $('.show-rekening_rekanan').text(data.rekening_rekanan);
          })
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.editRekanan', function () {
          var rekanan_id = $(this).data('id');
          $.get("{{ route('rekanan.index') }}" +'/' + rekanan_id +'/edit', function (data) {
              $('#modelHeading1').html("<i class='fa-regular fa-pen-to-square'></i> Edit Rekanan");
              $('#saveBtnupdate').val("edit_user");
              $('#ajaxModelupdate').modal('show');
              $('#edit_rekanan_id').val(data.id);
              $('#edit_uraian_rekanan').val(data.uraian_rekanan);
              $('#edit_alamat_rekanan').val(data.alamat_rekanan);
              $('#edit_rekening_rekanan').val(data.rekening_rekanan);
          })
        });

        /*------------------------------------------
        --------------------------------------------
        Create rekanan Code
        --------------------------------------------
        --------------------------------------------*/
        $('#rekananFormcreate').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#saveBtncreate').html('Sending...');

            $.ajax({
                    type:'POST',
                    url: "{{ route('rekanan.create') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                          $('#saveBtncreate').html('Submit');
                          $('#rekananFormcreate').trigger("reset");
                          $('#ajaxModelcreate').modal('hide');
                          table.draw();
                    },
                    error: function(response){
                        $('#saveBtncreate').html('Submit');
                        $('#rekananFormcreate').find(".print-error-msg").find("ul").html('');
                        $('#rekananFormcreate').find(".print-error-msg").css('display','block');
                        $.each( response.responseJSON.errors, function( key, value ) {
                            $('#rekananFormcreate').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        });
                    }
               });

        });

        /*------------------------------------------
        --------------------------------------------
        Edit rekanan Code
        --------------------------------------------
        --------------------------------------------*/
        $('#rekananFormupdate').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#saveBtnupdate').html('Sending...');

            $.ajax({
                    type:'POST',
                    url: "{{ route('rekanan.update') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                          $('#saveBtnupdate').html('Submit');
                          $('#rekananFormupdate').trigger("reset");
                          $('#ajaxModelupdate').modal('hide');
                          table.draw();
                    },
                    error: function(response){
                        $('#saveBtnupdate').html('Submit');
                        $('#rekananFormupdate').find(".print-error-msg").find("ul").html('');
                        $('#rekananFormupdate').find(".print-error-msg").css('display','block');
                        $.each( response.responseJSON.errors, function( key, value ) {
                            $('#rekananFormupdate').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        });
                    }
               });

        });

        /*------------------------------------------
        --------------------------------------------
        Delete rekanan Code
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.btn-delete', function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                Swal.fire({
                    title: 'Apa kamu yakin?',
                    text: "Anda tidak akan dapat mengembalikan Data " + name,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ route('rekanan.destroy') }}" +'/' + id,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                if (data.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        data.success,
                                        'success'
                                    );
                                    table.draw();
                                }
                            }
                        });
                    }
                })
        });
});
    </script>
@endsection
