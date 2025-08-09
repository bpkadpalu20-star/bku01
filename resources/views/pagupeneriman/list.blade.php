@extends('layouts.master')

@section('content')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- select2 css  -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<style>
.form-control {
    border-radius: 0;
    box-shadow: none;
    border-color: #d2d6de
}

.select2-hidden-accessible {
    border: 0 !important;
    clip: rect(0 0 0 0) !important;
    height: 1px !important;
    margin: -1px !important;
    overflow: hidden !important;
    padding: 0 !important;
    position: absolute !important;
    width: 1px !important
}

.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s
}

.select2-container--default .select2-selection--single,
.select2-selection .select2-selection--single {
    border: 1px solid #d2d6de;
    border-radius: 0;
    padding: 6px 12px;
    height: 34px
}

.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px
}

.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 28px;
    user-select: none;
    -webkit-user-select: none
}

.select2-container .select2-selection--single .select2-selection__rendered {
    padding-right: 10px
}

.select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 0;
    padding-right: 0;
    height: auto;
    margin-top: -3px
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px
}

.select2-container--default .select2-selection--single,
.select2-selection .select2-selection--single {
    border: 1px solid #d2d6de;
    border-radius: 0 !important;
    padding: 6px 12px;
    height: 40px !important
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 6px !important;
    right: 1px;
    width: 20px
}
</style>

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Pagu Penerimaan</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Input Pagu Penerimaan</li>
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
<div class="modal fade" id="ajaxModelcreaterinciansub" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel1">Input Pagu Penerimaan</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                url: "{{ route('pagupeneriman.index') }}" +'/' + '0' +'/tampil',
                type: "GET",
                data: 'tampil=' + tampil,
                success: function (data) {
                    $('.tampilmenua').html(data);//menampilkan data ke dalam modal
                }
            });
        });

    });
$(function () {
    $('#bkuFormcreaterinciansub').submit(function(e) {
        var cari_bulan = $("#cari_bulan").val();
        e.preventDefault();
        let formData = new FormData(this);
        $('#saveBtncreaterinciansub').html('Sending...');
        $.ajax({
                type:'POST',
                url: "{{ route('pagupeneriman.storerinciansub') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    $('#saveBtncreaterinciansub').html('Submit');
                    $('#bkuFormcreaterinciansub').trigger("reset");
                    $('#ajaxModelcreaterinciansub').modal('hide');
                    $.ajax({
                            url: "{{ route('pagupeneriman.index') }}" +'/' + '0' +'/tampil',
                            type: "GET",
                            data: 'cari_bulan=' + cari_bulan,
                            success: function (data) {
                                $('.tampilmenua').html(data);//menampilkan data ke dalam modal
                            }
                    });
                },
                error: function(error){
                    $('#saveBtncreaterinciansub').html('Submit');
                    if (error.responseJSON.create_nilapagu) {
                        $("#alert-create_nilapagu").find("ul").html('');
                        $("#alert-create_nilapagu").css('display','block');
                        $('#alert-create_nilapagu').html(error.responseJSON.create_nilapagu);
                        $.each( error.responseJSON.create_no_bkurinciansub, function( key, value ) {
                            $("#alert-create_nilapagu").find("ul").append('<li>'+value+'</li>');
                        });
                    } else {
                        $("#alert-create_nilapagu").find("ul").html('');
                        $("#alert-create_nilapagu").css('display','none');
                        $.each( error.responseJSON.create_no_bkurinciansub, function( key, value ) {
                            $("#alert-create_nilapagu").find("ul").append('<li>'+value+'</li>');
                        });
                    }
                }
        });

    });
});

$(document).ready(function(){

    $('body').on('click', '.caribaru', function (e) {
        var tampil = '0';
        var cari_bulan = $("#cari_bulan").val();
        $.ajax({
            url: "{{ route('pagupeneriman.index') }}" +'/' + tampil +'/tampil',
            type: "GET",
            data: 'cari_bulan=' + cari_bulan,
            success: function (data) {
                $('.tampilmenua').html(data);//menampilkan data ke dalam modal
            }
        });
    });

});
$('body').on('click', '.buatrinciansub', function () {
    var rincian_id = $(this).data('id');
    var cari_bulan = $("#cari_bulan").val();
    $.ajax({
        type : 'get',
        url: "{{ route('pagupeneriman.index') }}" +'/' + rincian_id +'/createrinciansub',
        data: 'rincian_id=' + rincian_id + '&cari_bulan=' + cari_bulan,
        success : function(data){
            $('#hasilcreaterinciansub').html(data);//menampilkan data ke dalam modal
            $('#ajaxModelcreaterinciansub').modal('show');
                // $('#tb').append(data);
        }
    });
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
