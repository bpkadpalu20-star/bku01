@extends('layouts.master')
@section('css')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!-- Plugins css -->
<link href="{{ URL::asset('assets/libs/jquery-nice-select/nice-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/switchery/switchery.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets/js/pages/form-advanced.init.js')}}"></script>
<script src="{{ URL::asset('assets/libs/jquery-nice-select/jquery.nice-select.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/switchery/switchery.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">BKU</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                    <li class="breadcrumb-item active">Penerimaan</li>
                </ol>
            </div>
            <h4 class="page-title">Laporan Penerimaan</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="simpleinput">OPD</label>
                            <select name="cari_id_opd" id="cari_id_opd" class="form-control opdfilter" data-toggle="select2">
                                <option value="">Select Country</option>
                                @foreach($opd as $skpd)

                                <option value="{{ $skpd->id }}">{{ $skpd->uraian_skpd }}</option>

                                @endforeach
                            </select>
                        </div>

                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="simpleinput">Bank</label>
                                    <select name="cari_id_bank" id="cari_id_bank" class="form-control" data-toggle="select2">
                                        <option value="">Select Bank</option>
                                        @foreach($bank as $row)

                                        <option value="{{ $row->id }}">{{ $row->kode_bank }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="simpleinput">Bulan sts</label>
                                    <select name="cari_bulan" id="cari_bulan" class="form-control bulanfilter" data-toggle="select2">

                                    </select>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end col -->

                        <div class="button-list mt-3">
                            <button type="button" class="btn btn-primary waves-effect waves-light caribaru">
                                <span class="btn-label"><i class="fas fa-search"></i></span>Tampil
                            </button>
                            <button id="resetbaru" type="button" class="btn btn-danger waves-effect waves-light resetbaru" disabled="disabled">
                                <span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span>Reset
                            </button>
                            <button id="printbaru" type="button" class="btn btn-info waves-effect waves-light printbaru" disabled="disabled">
                                <span class="btn-label"><i class="fas fa-print"></i></span>Cetak
                            </button>
                            <button id="pdfbaru" type="button" class="btn btn-info waves-effect waves-light pdfbaru" disabled="disabled">
                                <span class="btn-label"><i class="far fa-file-pdf"></i></span>PDF
                            </button>
                            <button id="exportToExcel" type="button" class="btn btn-info waves-effect waves-light " onClick="$('#countries').tableExport({type: 'excel', mso: {fileFormat: 'xlsx'}});" disabled="disabled">
                                <span class="btn-label"><i class="far fa-file-excel"></i></span>Excel
                            </button>

                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body tampilpenerimaan">
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<div class="pdfpenerimaan"></div>
<div class="excelpenerimaan"></div>
<script type="text/javascript">

    $(document).ready(function(){
        $(document).ready(function () {
            var tampilawal = '1';
            $.ajax({
                url: "{{ route('laporan.bkupenerimaan.index') }}" +'/' + tampilawal +'/tampilawal',
                type: "GET",
                data: 'tampilawal=' + tampilawal,
                success: function (data) {
                    $('.tampilpenerimaan').html(data);//menampilkan data ke dalam modal
                }
            });
        });

    });
    $('body').on('click', '.caribaru', function (e) {
        e.preventDefault();
        var cari_id_opd = $("#cari_id_opd").val();
        var cari_id_bank = $("#cari_id_bank").val();
        var cari_bulan = $("#cari_bulan").val();
        var tampil = '1';
        $.ajax({
            url: "{{ route('laporan.bkupenerimaan.index') }}" +'/' + tampil +'/tampil',
            type: "GET",
            data: 'cari_bulan=' + cari_bulan + '&cari_id_opd=' + cari_id_opd + '&cari_id_bank=' + cari_id_bank,
            success: function (data) {
                $('.tampilpenerimaan').html(data);//menampilkan data ke dalam modal
                resetbaru.disabled = false;
                printbaru.disabled = false;
                pdfbaru.disabled = false;
                exportToExcel.disabled = false;
            }
         });

    });
    $('body').on('click', '.resetbaru', function () {
        $("#cari_id_opd").val('').trigger('change');
        $("#cari_id_bank").val('').trigger('change');
        $("#cari_bulan").val('year').trigger('change');
        var tampilawal = '1';
        $.ajax({
                url: "{{ route('laporan.bkupenerimaan.index') }}" +'/' + tampilawal +'/tampilawal',
                type: "GET",
                data: 'tampilawal=' + tampilawal,
                success: function (data) {
                    $('.tampilpenerimaan').html(data);//menampilkan data ke dalam modal
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

    for(var i=1; i< 2; i++){
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
