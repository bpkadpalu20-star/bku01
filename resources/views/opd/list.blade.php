@extends('layouts.master')

@section('content')
<script src="{{ URL::asset('assets/js/jQuery v3.7.1.js')}}"></script>
<script src="{{ URL::asset('assets/js/sweetalert2.js')}}"></script>
<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Data OPD</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data OPD</li>
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
            @can('create opd')
            <a href="javascript:void(0)" class="btn btn-outline-primary waves-effect waves-light float-right" id="createNewOPD"><i class="mdi mdi-plus-box me-2 d-inline-block"></i>Create</a>
            @endcan
        </div>
    </div>
</div>
<!-- Page Header Close -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table  class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Name</th>
                            <th width="80px">Singkatan</th>
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
                <form id="opdFormcreate" name="opdFormcreate" class="form-horizontal">

                   @csrf

                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="form-group">
                        <label for="uraian_skpd" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="create_uraian_skpd" name="create_uraian_skpd" placeholder="Enter Name" value="" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">singkatans:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="create_singkatan" name="create_singkatan" placeholder="Enter Name" value="">
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
                <form id="opdFormupdate" name="opdFormupdate" class="form-horizontal">
                   <input type="hidden" name="edit_opd_id" id="edit_opd_id">
                   <input type="hidden" name="edit_kode" id="edit_kode">
                   @csrf

                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="form-group">
                        <label for="uraian_skpd" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit_uraian_skpd" name="edit_uraian_skpd" placeholder="Enter Name" value="" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">singkatans:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit_singkatan" name="edit_singkatan" placeholder="Enter Name" value="">
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
                <h4 class="modal-title" id="modelHeading"><i class="fa-regular fa-eye"></i> Show OPD</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="show-uraian_skpd" name="show-uraian_skpd" placeholder="Enter Name" value="" maxlength="50">
                <p><strong>Name:</strong> <span class="show-uraian_skpd"></span></p>
                <p><strong>singkatan:</strong> <span class="show-singkatan"></span></p>
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
            ajax: "{{ route('opd.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'uraian_skpd', name: 'uraian_skpd'},
                {data: 'singkatan', name: 'singkatan'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Button
        --------------------------------------------
        --------------------------------------------*/
        $('#createNewOPD').click(function () {
            $('#saveBtncreate').val("create-opd");
            $('#opd_id').val('');
            $('#opdFormcreate').trigger("reset");
            $('#modelHeading').html("<i class='fa fa-plus'></i> Create New OPD");
            $('#ajaxModelcreate').modal('show');
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.showOPD', function () {
          var opd_id = $(this).data('id');
          $.get("{{ route('opd.index') }}" +'/' + opd_id, function (data) {
              $('#showModel').modal('show');
              $('.show-uraian_skpd').text(data.uraian_skpd);
              $('#show-uraian_skpd').val(data.uraian_skpd);
              $('.show-singkatan').text(data.singkatan);
          })
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.editOPD', function () {
          var opd_id = $(this).data('id');
          $.get("{{ route('opd.index') }}" +'/' + opd_id +'/edit', function (data) {
              $('#modelHeading1').html("<i class='fa-regular fa-pen-to-square'></i> Edit OPD");
              $('#saveBtnupdate').val("edit_user");
              $('#ajaxModelupdate').modal('show');
              $('#edit_opd_id').val(data.id);
              $('#edit_uraian_skpd').val(data.uraian_skpd);
              $('#edit_kode').val(data.kode);
              $('#edit_singkatan').val(data.singkatan);
          })
        });

        /*------------------------------------------
        --------------------------------------------
        Create OPD Code
        --------------------------------------------
        --------------------------------------------*/
        $('#opdFormcreate').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#saveBtncreate').html('Sending...');

            $.ajax({
                    type:'POST',
                    url: "{{ route('opd.create') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                          $('#saveBtncreate').html('Submit');
                          $('#opdFormcreate').trigger("reset");
                          $('#ajaxModelcreate').modal('hide');
                          table.draw();
                    },
                    error: function(response){
                        $('#saveBtncreate').html('Submit');
                        $('#opdFormcreate').find(".print-error-msg").find("ul").html('');
                        $('#opdFormcreate').find(".print-error-msg").css('display','block');
                        $.each( response.responseJSON.errors, function( key, value ) {
                            $('#opdFormcreate').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        });
                    }
               });

        });

        /*------------------------------------------
        --------------------------------------------
        Edit OPD Code
        --------------------------------------------
        --------------------------------------------*/
        $('#opdFormupdate').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#saveBtnupdate').html('Sending...');

            $.ajax({
                    type:'POST',
                    url: "{{ route('opd.update') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                          $('#saveBtnupdate').html('Submit');
                          $('#opdFormupdate').trigger("reset");
                          $('#ajaxModelupdate').modal('hide');
                          table.draw();
                    },
                    error: function(response){
                        $('#saveBtnupdate').html('Submit');
                        $('#opdFormupdate').find(".print-error-msg").find("ul").html('');
                        $('#opdFormupdate').find(".print-error-msg").css('display','block');
                        $.each( response.responseJSON.errors, function( key, value ) {
                            $('#opdFormupdate').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        });
                    }
               });

        });

        /*------------------------------------------
        --------------------------------------------
        Delete OPD Code
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
                            url: "{{ route('opd.destroy') }}" +'/' + id,
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
