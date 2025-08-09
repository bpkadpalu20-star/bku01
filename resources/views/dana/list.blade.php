@extends('layouts.master')

@section('content')
<script src="{{ URL::asset('assets/js/jQuery v3.7.1.js')}}"></script>
<script src="{{ URL::asset('assets/js/sweetalert2.js')}}"></script>
<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Sumber Dana</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sumber Dana</li>
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
            @can('create dana')
            <a href="javascript:void(0)" class="btn btn-outline-primary waves-effect waves-light float-right" id="createNewdana"><i class="mdi mdi-plus-box me-2 d-inline-block"></i>Create</a>
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
                            <th width="80px">Kode</th>
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
                <form id="danaFormcreate" name="danaFormcreate" class="form-horizontal">

                   @csrf

                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="form-group">
                        <label for="uraian_dana" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="create_uraian_dana" name="create_uraian_dana" placeholder="Enter Name" value="" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kode:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="create_kode_dana" name="create_kode_dana" placeholder="Enter Kode" value="">
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
                <form id="danaFormupdate" name="danaFormupdate" class="form-horizontal">
                   <input type="hidden" name="edit_dana_id" id="edit_dana_id">
                   @csrf

                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="form-group">
                        <label for="uraian_dana" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit_uraian_dana" name="edit_uraian_dana" placeholder="Enter Name" value="" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kode:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit_kode_dana" name="edit_kode_dana" placeholder="Enter Kode" value="">
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
            ajax: "{{ route('dana.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'uraian_dana', name: 'uraian_dana'},
                {data: 'kode_dana', name: 'kode_dana'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Button
        --------------------------------------------
        --------------------------------------------*/
        $('#createNewdana').click(function () {
            $('#saveBtncreate').val("create-dana");
            $('#dana_id').val('');
            $('#danaFormcreate').trigger("reset");
            $('#modelHeading').html("<i class='fa fa-plus'></i> Create New Dana");
            $('#ajaxModelcreate').modal('show');a
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.editDana', function () {
          var dana_id = $(this).data('id');
          $.get("{{ route('dana.index') }}" +'/' + dana_id +'/edit', function (data) {
              $('#modelHeading1').html("<i class='fa-regular fa-pen-to-square'></i> Edit Sumber Dana");
              $('#saveBtnupdate').val("edit_user");
              $('#ajaxModelupdate').modal('show');
              $('#edit_dana_id').val(data.id);
              $('#edit_uraian_dana').val(data.uraian_dana);
              $('#edit_kode_dana').val(data.kode_dana);
          })
        });

        /*------------------------------------------
        --------------------------------------------
        Create bank Code
        --------------------------------------------
        --------------------------------------------*/
        $('#danaFormcreate').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#saveBtncreate').html('Sending...');

            $.ajax({
                    type:'POST',
                    url: "{{ route('dana.create') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                          $('#saveBtncreate').html('Submit');
                          $('#danaFormcreate').trigger("reset");
                          $('#ajaxModelcreate').modal('hide');
                          table.draw();
                    },
                    error: function(response){
                        $('#saveBtncreate').html('Submit');
                        $('#danaFormcreate').find(".print-error-msg").find("ul").html('');
                        $('#danaFormcreate').find(".print-error-msg").css('display','block');
                        $.each( response.responseJSON.errors, function( key, value ) {
                            $('#danaFormcreate').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        });
                    }
               });

        });

        /*------------------------------------------
        --------------------------------------------
        Edit bank Code
        --------------------------------------------
        --------------------------------------------*/
        $('#danaFormupdate').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#saveBtnupdate').html('Sending...');

            $.ajax({
                    type:'POST',
                    url: "{{ route('dana.update') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                          $('#saveBtnupdate').html('Submit');
                          $('#danaFormupdate').trigger("reset");
                          $('#ajaxModelupdate').modal('hide');
                          table.draw();
                    },
                    error: function(response){
                        $('#saveBtnupdate').html('Submit');
                        $('#danaFormupdate').find(".print-error-msg").find("ul").html('');
                        $('#danaFormupdate').find(".print-error-msg").css('display','block');
                        $.each( response.responseJSON.errors, function( key, value ) {
                            $('#danaFormupdate').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        });
                    }
               });

        });

        /*------------------------------------------
        --------------------------------------------
        Delete bank Code
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
                            url: "{{ route('dana.destroy') }}" +'/' + id,
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
