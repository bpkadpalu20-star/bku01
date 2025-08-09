@extends('layouts.master')

@section('content')
<script src="{{ URL::asset('assets/js/jQuery v3.7.1.js')}}"></script>
<script src="{{ URL::asset('assets/js/sweetalert2.js')}}"></script>
<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Data Bank</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Bank</li>
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
            @can('create bank')
            <a href="javascript:void(0)" class="btn btn-outline-primary waves-effect waves-light float-right" id="createNewbank"><i class="mdi mdi-plus-box me-2 d-inline-block"></i>Create</a>
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
                            <th width="80px">Alamat</th>
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
                <form id="bankFormcreate" name="bankFormcreate" class="form-horizontal">

                   @csrf

                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="form-group">
                        <label for="uraian_bank" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="create_uraian_bank" name="create_uraian_bank" placeholder="Enter Name" value="" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kode:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="create_kode_bank" name="create_kode_bank" placeholder="Enter Kode" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="create_alamat_bank" name="create_alamat_bank" placeholder="Enter Alamat" value="">
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
                <form id="bankFormupdate" name="bankFormupdate" class="form-horizontal">
                   <input type="hidden" name="edit_bank_id" id="edit_bank_id">
                   @csrf

                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="form-group">
                        <label for="uraian_bank" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit_uraian_bank" name="edit_uraian_bank" placeholder="Enter Name" value="" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kode:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit_kode_bank" name="edit_kode_bank" placeholder="Enter Kode" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edit_alamat_bank" name="edit_alamat_bank" placeholder="Enter Alamat" value="">
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
                <h4 class="modal-title" id="modelHeading"><i class="fa-regular fa-eye"></i> Show bank</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="show-uraian_bank" name="show-uraian_bank" placeholder="Enter Name" value="" maxlength="50">
                <p><strong>Name:</strong> <span class="show-uraian_bank"></span></p>
                <p><strong>kode_bank:</strong> <span class="show-kode_bank"></span></p>
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
            ajax: "{{ route('bank.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'uraian_bank', name: 'uraian_bank'},
                {data: 'kode_bank', name: 'kode_bank'},
                {data: 'alamat_bank', name: 'alamat_bank'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Button
        --------------------------------------------
        --------------------------------------------*/
        $('#createNewbank').click(function () {
            $('#saveBtncreate').val("create-bank");
            $('#bank_id').val('');
            $('#bankFormcreate').trigger("reset");
            $('#modelHeading').html("<i class='fa fa-plus'></i> Create New Bank");
            $('#ajaxModelcreate').modal('show');
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.showbank', function () {
          var bank_id = $(this).data('id');
          $.get("{{ route('bank.index') }}" +'/' + bank_id, function (data) {
              $('#showModel').modal('show');
              $('.show-uraian_bank').text(data.uraian_bank);
              $('#show-uraian_bank').val(data.uraian_bank);
              $('.show-kode_bank').text(data.kode_bank);
          })
        });

        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.editBank', function () {
          var bank_id = $(this).data('id');
          $.get("{{ route('bank.index') }}" +'/' + bank_id +'/edit', function (data) {
              $('#modelHeading1').html("<i class='fa-regular fa-pen-to-square'></i> Edit Bank");
              $('#saveBtnupdate').val("edit_user");
              $('#ajaxModelupdate').modal('show');
              $('#edit_bank_id').val(data.id);
              $('#edit_uraian_bank').val(data.uraian_bank);
              $('#edit_alamat_bank').val(data.alamat_bank);
              $('#edit_kode_bank').val(data.kode_bank);
          })
        });

        /*------------------------------------------
        --------------------------------------------
        Create bank Code
        --------------------------------------------
        --------------------------------------------*/
        $('#bankFormcreate').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#saveBtncreate').html('Sending...');

            $.ajax({
                    type:'POST',
                    url: "{{ route('bank.create') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                          $('#saveBtncreate').html('Submit');
                          $('#bankFormcreate').trigger("reset");
                          $('#ajaxModelcreate').modal('hide');
                          table.draw();
                    },
                    error: function(response){
                        $('#saveBtncreate').html('Submit');
                        $('#bankFormcreate').find(".print-error-msg").find("ul").html('');
                        $('#bankFormcreate').find(".print-error-msg").css('display','block');
                        $.each( response.responseJSON.errors, function( key, value ) {
                            $('#bankFormcreate').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        });
                    }
               });

        });

        /*------------------------------------------
        --------------------------------------------
        Edit bank Code
        --------------------------------------------
        --------------------------------------------*/
        $('#bankFormupdate').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#saveBtnupdate').html('Sending...');

            $.ajax({
                    type:'POST',
                    url: "{{ route('bank.update') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                          $('#saveBtnupdate').html('Submit');
                          $('#bankFormupdate').trigger("reset");
                          $('#ajaxModelupdate').modal('hide');
                          table.draw();
                    },
                    error: function(response){
                        $('#saveBtnupdate').html('Submit');
                        $('#bankFormupdate').find(".print-error-msg").find("ul").html('');
                        $('#bankFormupdate').find(".print-error-msg").css('display','block');
                        $.each( response.responseJSON.errors, function( key, value ) {
                            $('#bankFormupdate').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
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
                            url: "{{ route('bank.destroy') }}" +'/' + id,
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
