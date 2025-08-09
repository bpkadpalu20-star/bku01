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
     table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

    </style>
    <!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Laporan Rekap</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Rekap BKU</li>
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input-label" class="form-label">Bulan SP2D</label>
                            <select name="cari_bulan" id="cari_bulan" class="form-control bulanfilter" data-toggle="select2">

                            </select>
                        </div>


                    </div> <!-- end col -->

                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-md-6">

                            </div> <!-- end col -->
                            <div class="col-md-6">

                            </div> <!-- end col -->
                        </div> <!-- end col -->
                        <div class="button-list mt-3">

                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

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

            <button type="button" class="btn btn-outline-primary waves-effect waves-light caribaru">
                <span class="btn-label"><i class="fas fa-search"></i></span>Tampil
            </button>
            <button id="resetbaru" type="button" class="btn btn-outline-danger waves-effect waves-light resetbaru" disabled="disabled">
                <span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span>Reset
            </button>
            <button id="printbaru" type="button" class="btn btn-outline-info waves-effect waves-light printbaru" disabled="disabled">
                <span class="btn-label"><i class="fas fa-print"></i></span>Cetak
            </button>
            <button id="pdfbaru" type="button" class="btn btn-outline-info waves-effect waves-light pdfbaru" disabled="disabled">
                <span class="btn-label"><i class="far fa-file-pdf"></i></span>PDF
            </button>
            <button id="exportToExcel" type="button" class="btn btn-outline-info waves-effect waves-light " onClick="$('#countries').tableExport({type: 'excel', mso: {fileFormat: 'xlsx'}});" disabled="disabled">
                <span class="btn-label"><i class="far fa-file-excel"></i></span>Excel
            </button>
            @endcan
        </div>
    </div>
</div>
<!-- Page Header Close -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body tampilbku">
            </div> <!-- end card body-->

        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<div class="pdfpenerimaan"></div>
<div class="cetakbku"></div>
<script type="text/javascript">
$( '#single-select-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
} );
    $(document).ready(function(){
        $(document).ready(function () {
            var tampil = '0';
            $.ajax({
                url: "{{ route('laporan.rekappenerimaan.index') }}" +'/' + tampil +'/tampil',
                type: "GET",
                data: 'tampil=' + tampil,
                success: function (data) {
                    $('.tampilbku').html(data);//menampilkan data ke dalam modal
                }
            });
        });

    });
    $('body').on('click', '.caribaru', function (e) {
        e.preventDefault();
        var cari_bulan = $("#cari_bulan").val();
        var tampil = '1';
        $.ajax({
            url: "{{ route('laporan.rekappenerimaan.index') }}" +'/' + tampil +'/tampil',
            type: "GET",
            data: 'cari_bulan=' + cari_bulan,
            success: function (data) {
                $('.tampilbku').html(data);//menampilkan data ke dalam modal

                resetbaru.disabled = false;
                printbaru.disabled = false;
                pdfbaru.disabled = false;
                exportToExcel.disabled = false;
            }
         });

    });
    $('body').on('click', '.resetbaru', function () {
        $("#cari_bulan").val('year').trigger('change');
        var tampilawal = '0';
        $.ajax({
                url: "{{ route('laporan.rekappenerimaan.index') }}" +'/' + tampilawal +'/tampilawal',
                type: "GET",
                data: 'tampilawal=' + tampilawal,
                success: function (data) {
                    $('.tampilbku').html(data);//menampilkan data ke dalam modal
                    resetbaru.disabled = true;
                    printbaru.disabled = true;
                    pdfbaru.disabled = true;
                    exportToExcel.disabled = true;
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
    var html = '<option value="year">Satu Tahun</option>';
    for(var i=0; i<arr.length; i++) {
        html += '<option value="' + arr[i] + '">' + arr[i] + '</option>'
    }

    document.getElementById('cari_bulan').innerHTML = html;

    }
    var months = getLastMonths(4);
    appendOptions(months);
</script>
@endsection
