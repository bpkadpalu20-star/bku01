@extends('layouts.master')

@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>



<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Rekap</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Rekap BKU</li>
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-md-flex d-block align-items-center justify-content-between my-1 page-header-breadcrumb">
                    <div class="col-xl-6">
                        <label for="input-label" class="form-label">Bulan BKU</label>
                        <select name="cari_bulan" id="cari_bulan" class="form-control bulanfilter" >

                        </select>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center">
        <div class="pe-1 mb-xl-0">
            @can('create opd')
            <button type="button" class="btn btn-outline-primary waves-effect waves-light float-right caribaru">
                                <span class="btn-label"><i class="fas fa-search"></i></span>Tampil
                            </button>
            @endcan
        </div>
    </div>
</div>
<!-- Page Header Close -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive tampilmenua">



                </div> <!-- end .table-responsive-->
            </div>
        </div>
    </div>
</div>
<!-- end row-->
<div class="modal fade" id="ajaxModelcreatesaldo" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="bkuFormcreatesaldo" name="bkuFormcreatesaldo" class="form-horizontal">

                   @csrf
                   <div class="hasilcreatesaldo" id="hasilcreatesaldo"></div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-success mt-2" id="saveBtncreatesaldo" value="create"><i class="fa fa-save"></i> Submit
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModelcreaterincian" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="bkuFormcreaterincian" name="bkuFormcreaterincian" class="form-horizontal">

                   @csrf
                   <div class="hasilcreaterincian" id="hasilcreaterincian"></div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-success mt-2" id="saveBtncreaterincian" value="create"><i class="fa fa-save"></i> Submit
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModelcreaterinciansub" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="bkuFormcreaterinciansub" name="bkuFormcreaterinciansub" class="form-horizontal">

                   @csrf
                   <div class="hasilcreaterinciansub" id="hasilcreaterinciansub"></div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-success mt-2" id="saveBtncreaterinciansub" value="create"><i class="fa fa-save"></i> Submit
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
        $(document).ready(function () {
            var tampil = '0';
            $.ajax({
                url: "{{ route('rekap.index') }}" +'/' + '0' +'/tampil',
                type: "GET",
                data: 'tampil=' + tampil,
                success: function (data) {
                    $('.tampilmenua').html(data);//menampilkan data ke dalam modal
                }
            });
        });

    });
$(function () {
$('#bkuFormcreatesaldo').submit(function(e) {
    var cari_bulan = $("#cari_bulan").val();
    e.preventDefault();
    let formData = new FormData(this);
    $('#saveBtncreatesaldo').html('Sending...');
    $.ajax({
            type:'POST',
            url: "{{ route('rekap.storesaldo') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                  $('#saveBtncreatesaldo').html('Submit');
                  $('#bkuFormcreatesaldo').trigger("reset");
                  $('#ajaxModelcreatesaldo').modal('hide');
                  $.ajax({
                        url: "{{ route('rekap.index') }}" +'/' + '0' +'/tampil',
                        type: "GET",
                        data: 'cari_bulan=' + cari_bulan,
                        success: function (data) {
                            $('.tampilmenua').html(data);//menampilkan data ke dalam modal
                        }
                  });
            },
            error: function(error){
                $('#saveBtncreatesaldo').html('Submit');
                if (error.responseJSON.create_nilai_saldokoran) {
                    $("#alert-create_nilai_saldokoran").find("ul").html('');
                    $("#alert-create_nilai_saldokoran").css('display','block');
                    $('#alert-create_nilai_saldokoran').html(error.responseJSON.create_nilai_saldokoran);
                    $.each( error.responseJSON.create_nilai_saldokoran, function( key, value ) {
                        $("#alert-create_nilai_saldokoran").find("ul").append('<li>'+value+'</li>');
                    });
                } else {
                    $("#alert-create_nilai_saldokoran").find("ul").html('');
                    $("#alert-create_nilai_saldokoran").css('display','none');
                    $.each( error.responseJSON.create_nilai_saldokoran, function( key, value ) {
                        $("#alert-create_nilai_saldokoran").find("ul").append('<li>'+value+'</li>');
                    });
                }
            }
       });

});
$('#bkuFormcreaterincian').submit(function(e) {
    var cari_bulan = $("#cari_bulan").val();
    e.preventDefault();
    let formData = new FormData(this);
    $('#saveBtncreaterincian').html('Sending...');
    $.ajax({
            type:'POST',
            url: "{{ route('rekap.storerincian') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                  $('#saveBtncreaterincian').html('Submit');
                  $('#bkuFormcreaterincian').trigger("reset");
                  $('#ajaxModelcreaterincian').modal('hide');
                  $.ajax({
                        url: "{{ route('rekap.index') }}" +'/' + '0' +'/tampil',
                        type: "GET",
                        data: 'cari_bulan=' + cari_bulan,
                        success: function (data) {
                            $('.tampilmenua').html(data);//menampilkan data ke dalam modal
                        }
                  });
            },
            error: function(error){
                $('#saveBtncreaterincian').html('Submit');

                if (error.responseJSON.create_nilai_rincian) {
                    $("#alert-create_nilai_rincian").find("ul").html('');
                    $("#alert-create_nilai_rincian").css('display','block');
                    $('#alert-create_nilai_rincian').html(error.responseJSON.create_nilai_rincian);
                    $.each( error.responseJSON.create_nilai_rincian, function( key, value ) {
                        $("#alert-create_nilai_rincian").find("ul").append('<li>'+value+'</li>');
                    });
                } else {
                    $("#alert-create_nilai_rincian").find("ul").html('');
                    $("#alert-create_nilai_rincian").css('display','none');
                    $.each( error.responseJSON.create_nilai_rincian, function( key, value ) {
                        $("#alert-create_nilai_rincian").find("ul").append('<li>'+value+'</li>');
                    });
                }
                if (error.responseJSON.create_uraian_bkurincian) {
                    $("#alert-create_uraian_bkurincian").find("ul").html('');
                    $("#alert-create_uraian_bkurincian").css('display','block');
                    $('#alert-create_uraian_bkurincian').html(error.responseJSON.create_uraian_bkurincian);
                    $.each( error.responseJSON.create_uraian_bkurincian, function( key, value ) {
                        $("#alert-create_uraian_bkurincian").find("ul").append('<li>'+value+'</li>');
                    });
                } else {
                    $("#alert-create_uraian_bkurincian").find("ul").html('');
                    $("#alert-create_uraian_bkurincian").css('display','none');
                    $.each( error.responseJSON.create_uraian_bkurincian, function( key, value ) {
                        $("#alert-create_uraian_bkurincian").find("ul").append('<li>'+value+'</li>');
                    });
                }
            }
       });

});
    $('#bkuFormcreaterinciansub').submit(function(e) {
        var cari_bulan = $("#cari_bulan").val();
        e.preventDefault();
        let formData = new FormData(this);
        $('#saveBtncreaterinciansub').html('Sending...');
        $.ajax({
                type:'POST',
                url: "{{ route('rekap.storerinciansub') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    $('#saveBtncreaterinciansub').html('Submit');
                    $('#bkuFormcreaterinciansub').trigger("reset");
                    $('#ajaxModelcreaterinciansub').modal('hide');
                    $.ajax({
                            url: "{{ route('rekap.index') }}" +'/' + '0' +'/tampil',
                            type: "GET",
                            data: 'cari_bulan=' + cari_bulan,
                            success: function (data) {
                                $('.tampilmenua').html(data);//menampilkan data ke dalam modal
                            }
                    });
                },
                error: function(error){
                    $('#saveBtncreaterinciansub').html('Submit');
                    if (error.responseJSON.create_no_bkurinciansub) {
                        $("#alert-create_no_bkurinciansub").find("ul").html('');
                        $("#alert-create_no_bkurinciansub").css('display','block');
                        $('#alert-create_no_bkurinciansub').html(error.responseJSON.create_no_bkurinciansub);
                        $.each( error.responseJSON.create_no_bkurinciansub, function( key, value ) {
                            $("#alert-create_no_bkurinciansub").find("ul").append('<li>'+value+'</li>');
                        });
                    } else {
                        $("#alert-create_no_bkurinciansub").find("ul").html('');
                        $("#alert-create_no_bkurinciansub").css('display','none');
                        $.each( error.responseJSON.create_no_bkurinciansub, function( key, value ) {
                            $("#alert-create_no_bkurinciansub").find("ul").append('<li>'+value+'</li>');
                        });
                    }
                    if (error.responseJSON.create_nilai_sp2drincian) {
                        $("#alert-create_nilai_sp2drincian").find("ul").html('');
                        $("#alert-create_nilai_sp2drincian").css('display','block');
                        $('#alert-create_nilai_sp2drincian').html(error.responseJSON.create_nilai_sp2drincian);
                        $.each( error.responseJSON.create_nilai_sp2drincian, function( key, value ) {
                            $("#alert-create_nilai_sp2drincian").find("ul").append('<li>'+value+'</li>');
                        });
                    } else {
                        $("#alert-create_nilai_sp2drincian").find("ul").html('');
                        $("#alert-create_nilai_sp2drincian").css('display','none');
                        $.each( error.responseJSON.create_nilai_sp2drincian, function( key, value ) {
                            $("#alert-create_nilai_sp2drincian").find("ul").append('<li>'+value+'</li>');
                        });
                    }
                    if (error.responseJSON.create_uraian_bkurinciansub) {
                        $("#alert-create_uraian_bkurinciansub").find("ul").html('');
                        $("#alert-create_uraian_bkurinciansub").css('display','block');
                        $('#alert-create_uraian_bkurinciansub').html(error.responseJSON.create_uraian_bkurinciansub);
                        $.each( error.responseJSON.create_uraian_bkurinciansub, function( key, value ) {
                            $("#alert-create_uraian_bkurinciansub").find("ul").append('<li>'+value+'</li>');
                        });
                    } else {
                        $("#alert-create_uraian_bkurinciansub").find("ul").html('');
                        $("#alert-create_uraian_bkurinciansub").css('display','none');
                        $.each( error.responseJSON.create_uraian_bkurinciansub, function( key, value ) {
                            $("#alert-create_uraian_bkurinciansub").find("ul").append('<li>'+value+'</li>');
                        });
                    }
                    if (error.responseJSON.double_no_bkurincian) {
                        $("#alert-double_no_bkurincian").find("ul").html('');
                        $("#alert-double_no_bkurincian").css('display','block');
                        $('#alert-double_no_bkurincian').html(error.responseJSON.double_no_bkurincian);
                        $.each( error.responseJSON.double_no_bkurincian, function( key, value ) {
                            $("#alert-double_no_bkurincian").find("ul").append('<li>'+value+'</li>');
                        });
                    } else {
                        $("#alert-double_no_bkurincian").find("ul").html('');
                        $("#alert-double_no_bkurincian").css('display','none');
                        $.each( error.responseJSON.double_no_bkurincian, function( key, value ) {
                            $("#alert-double_no_bkurincian").find("ul").append('<li>'+value+'</li>');
                        });
                    }
                }
        });

    });
});

$(document).ready(function(){
            // var tampil1 = '0';
            // var cari_bulan = $("#cari_bulan").val();
            // $.ajax({
            //     url: "{{ route('rekap.index') }}" +'/' + tampil1 +'/tampil1',
            //     type: "GET",
            //     data: 'cari_bulan=' + cari_bulan,
            //     success: function (data) {
            //         $('.tampilmenua').html(data);//menampilkan data ke dalam modal
            //     }
            // });


$('body').on('click', '.caribaru', function (e) {
    var tampil = '0';
    var cari_bulan = $("#cari_bulan").val();
    $.ajax({
        url: "{{ route('rekap.index') }}" +'/' + tampil +'/tampil',
        type: "GET",
        data: 'cari_bulan=' + cari_bulan,
        success: function (data) {
            $('.tampilmenua').html(data);//menampilkan data ke dalam modal
        }
    });
});

});
$('body').on('click', '.buatsaldokoran', function () {
    var saldo_id = $(this).data('id');
    $.ajax({
        type : 'get',
        url: "{{ route('rekap.index') }}" +'/' + saldo_id +'/createsaldo',
        data: 'saldo_id=' + saldo_id,
        success : function(data){
            $('#hasilcreatesaldo').html(data);//menampilkan data ke dalam modal
            $('#ajaxModelcreatesaldo').modal('show');
                // $('#tb').append(data);
        }
    });
});
$('body').on('click', '.buatrincian', function () {
    var rincian_id = $(this).data('id');
    var cari_bulan = $("#cari_bulan").val();
    $.ajax({
        type : 'get',
        url: "{{ route('rekap.index') }}" +'/' + rincian_id +'/createrincian',
        data: 'rincian_id=' + rincian_id + '&cari_bulan=' + cari_bulan,
        success : function(data){
            $('#hasilcreaterincian').html(data);//menampilkan data ke dalam modal
            $('#ajaxModelcreaterincian').modal('show');
                // $('#tb').append(data);
        }
    });
});
$('body').on('click', '.buatrinciansub', function () {
    var rincian_id = $(this).data('id');
    var cari_bulan = $("#cari_bulan").val();
    $.ajax({
        type : 'get',
        url: "{{ route('rekap.index') }}" +'/' + rincian_id +'/createrinciansub',
        data: 'rincian_id=' + rincian_id + '&cari_bulan=' + cari_bulan,
        success : function(data){
            $('#hasilcreaterinciansub').html(data);//menampilkan data ke dalam modal
            $('#ajaxModelcreaterinciansub').modal('show');
                // $('#tb').append(data);
        }
    });
});
$('body').on('click', '.btn-deleterinciansub', function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var cari_bulan = $(this).data('bulan');
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
                            type : 'get',
                            url: "{{ route('rekap.index') }}" +'/' + id +'/deleterinciansub',
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

                                }
                                        $.ajax({
                                            url: "{{ route('rekap.index') }}" +'/' + '0' +'/tampil',
                                            type: "GET",
                                            data: 'cari_bulan=' + cari_bulan,
                                            success: function (response) {
                                                $('.tampilmenua').html(response);//menampilkan data ke dalam modal
                                            }
                                    });


                            }
                        });
                    }
                })
});
$('body').on('click', '.btn-deleterincian', function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var cari_bulan = $(this).data('bulan');
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
                            type : 'get',
                            url: "{{ route('rekap.index') }}" +'/' + id +'/deleterincian',
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

                                }
                                        $.ajax({
                                            url: "{{ route('rekap.index') }}" +'/' + '0' +'/tampil',
                                            type: "GET",
                                            data: 'cari_bulan=' + cari_bulan,
                                            success: function (response) {
                                                $('.tampilmenua').html(response);//menampilkan data ke dalam modal
                                            }
                                    });


                            }
                        });
                    }
                })
});
var getLastMonths = function(n) {
    var arr = new Array();

    arr.push(moment().format('MMMM'));

    for(var i=1; i< 12; i++){
        arr.push(moment().add(i*-1, 'Month').format('MMMM'));
    }

    return arr;
    }
    var appendOptions = function(arr) {
    var html = '';
    for(var i=0; i<arr.length; i++) {
        html += '<option value="' + arr[i] + '">' + arr[i] + '</option>'
    }

    document.getElementById('cari_bulan').innerHTML = html;

    }
    var months = getLastMonths(4);
    appendOptions(months);
</script>


@endsection
