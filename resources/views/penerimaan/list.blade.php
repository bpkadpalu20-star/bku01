@extends('layouts.master')
@section('content')
<script src="{{ URL::asset('assets/js/jquery-3.7.1.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!-- Plugins css -->
<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ URL::asset('assets/js/select2.js')}}"></script>

<link rel="stylesheet" href="../assets/libs/prismjs/themes/prism-coy.min.css">
    <!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Penerimaan</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">>Data BKU Penerimaan</li>
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
                <div class="row gy-6">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                        <label for="input-label" class="form-label">No. sts</label>
                        <input type="text" id="cari_no_bku" name="cari_no_bku" class="form-control penfilter" placeholder="Enter Kode">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                        <label for="input-label" class="form-label">No. Rekening</label>
                        <input type="text" id="cari_no_rekening" name="cari_no_rekening" class="form-control rekeningfilter" placeholder="Enter Kode">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                        <label for="input-label" class="form-label">OPD</label>
                        <select name="cari_id_opd" id="cari_id_opd" class="form-control opdfilter" data-toggle="select2" data-trigger name="choices-single-default">
                            <option value="">Select Country</option>
                            @foreach($opd as $skpd)

                            <option value="{{ $skpd->id }}">{{ $skpd->uraian_skpd }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                        <label for="input-label" class="form-label">Bank</label>
                        <select name="cari_id_bank" id="cari_id_bank" class="form-control bankfilter" data-toggle="select2" data-trigger name="choices-single-default">
                            <option value="">Select Bank</option>
                            @foreach($bank as $row)

                            <option value="{{ $row->id }}">{{ $row->kode_bank }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                        <label for="input-label" class="form-label">Nilai sts</label>
                        <input type="text" action="harusHuruf()" class="form-control nilaifilter" id="cari_nilai_sts" name="cari_nilai_sts" placeholder="Enter Kode" value="" style="text-align: right;">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                        <label for="input-label" class="form-label">Bulan sts</label>
                        <select name="cari_bulan" id="cari_bulan" class="form-control bulanfilter" data-toggle="select2" data-trigger name="choices-single-default">

                        </select>
                    </div>
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
            <a href="javascript:void(0)" class="btn btn-outline-primary waves-effect waves-light float-right Createpenerimaan" id="createNewBkupenerimaan"><i class="mdi mdi-plus-box me-2 d-inline-block"></i>Create</a>
            @endcan
        </div>
    </div>
</div>
<!-- Page Header Close -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table id="data-table" class="table table-bordered dt-responsive nowrap data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th width="60px">No Kas</th>
                            <th width="60px">Tgl Kas</th>
                            <th>Uraian Kas</th>
                            <th width="80px">No STS</th>
                            <th width="80px">Rekening</th>
                            <th>Uraian Rekening</th>
                            <th width="80px">OPD</th>
                            <th width="80px">Nilai</th>
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

<div class="modal fade modal-dialog-scrollable" id="ajaxModelcreate" tabindex="-1" aria-labelledby="ajaxModelcreate" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modelHeadingcreate"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form id="BkuPnnFormcreate" name="BkuPnnFormcreate" class="form-horizontal">
                @csrf
                {{ csrf_field() }}

                <div class="hasilcreate" id="hasilcreate"></div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success mt-2" id="saveBtncreate" value="create"><i class="fa fa-save"></i> Submit
                    </button>
                </div>
            </form>

        </div>
      </div>
    </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->

<div class="modal fade modal-dialog-scrollable" id="ajaxModelupdate" tabindex="-1" aria-labelledby="ajaxModelupdate" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modelHeading"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form id="BkuPnnFormupdate" name="BkuPnnFormupdate" class="form-horizontal">

                @csrf
                {{ csrf_field() }}
                <div class="hasilupdate" id="hasilupdate"></div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success mt-2" id="saveBtnupdate" value="update"><i class="fa fa-save"></i> Submit
                    </button>
                </div>
             </form>

        </div>
      </div>
    </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->

<div class="modal fade" id="ajaxModelban" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="penerimaanbanForm" name="penerimaanbanForm" class="form-horizontal">
                    @csrf
                    <div class="batal" id="batal"></div>
                    <div class="col-sm-offset-2 col-sm-10">

                        <button type="submit" class="btn btn-success mt-2" id="saveBtnban" value="create"><i class="fa fa-save"></i> Submit
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModelunban" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">

                <form id="penerimaanunbanForm" name="penerimaanunbanForm" class="form-horizontal">
                    @csrf

                    <div class="unbatal" id="unbatal"></div>
                    <div class="col-sm-offset-2 col-sm-10">

                        <button type="submit" class="btn btn-success mt-2" id="saveBtnunban" value="create"><i class="fa fa-save"></i> Submit
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModelshow" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="hasil-show" ></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // $('.data-table').dataTable({searching: false});
    } );

    $.fn.modal.Constructor.prototype.enforceFocus = function() {};

$(document).ready(function() {
// function pagufetch(){
//     var id_dana = $("#id_dana").val();
//         $.ajax({
//                 type : 'post',
//                 url : 'modul/mod_pagubelanja/nilai.php',
//                 data :  'id_dana='+ id_dana,
//                 success : function(data){
//                     $('#pagu').html(data);//menampilkan data ke dalam modal
//             }
//             });
// };
});
</script>
<script>

    var rupiah2 = document.getElementById('cari_nilai_sts');
            rupiah2.addEventListener('keyup', function(e){
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah2.value = formatRupiah(this.value, '');
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }

    function harusHuruf(evt){
             var charCode = (evt.which) ? evt.which : event.keyCode
             if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
                 return false;
             return true;
    }
</script>
<script type="text/javascript">

    $(document).on('click', '.pilihsts', function (e) {
                document.getElementById("username_pengoreksi").value = $(this).attr('data-username');


				//var modal = document.getElementById('staticBackdrop');
				$("#carists").modal('hide');
				//modal.element.classList.remove("show");
				//modal.
				myModal.hide()

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
            searching: false,
            // ajax: "{{ route('bku-penerimaan.index') }}",
            ajax: {
                url: "{{ route('bku-penerimaan.index') }}",
                data: function (d) {
                    d.cari_id_opd = $('.opdfilter').val(),
                    d.cari_id_bank = $('.bankfilter').val(),
                    d.cari_no_bku = $('.stsfilter').val(),
                    d.cari_no_rekening = $('.rekeningfilter').val(),
                    d.cari_nilai_sts = $('.nilaifilter').val(),
                    d.cari_bulan = $('.bulanfilter').val(),
                    d.search = $('input[type="search"]').val()
                    }
            },
            columns: [
                {data: 'id_bku', name: 'id_bku'},
                {data: 'tanggal_bku', name: 'tanggal_bku'},
                {data: 'uraian_bku', name: 'uraian_bku'},
                {data: 'no_bku', name: 'no_bku'},
                {data: 'no_rekening', name: 'no_rekening'},
                {data: 'uraian_subrincianobjek', name: 'uraian_subrincianobjek'},
                {data: 'uraian_skpd', name: 'uraian_skpd'},
                {data: 'nilai_sts',  render: $.fn.dataTable.render.number( '.', ',', 0, '' )},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        $(".opdfilter").keyup(function(){
            table.draw();
        });
        $(".stsfilter").keyup(function(){
            table.draw();
        });
        $(".rekeningfilter").keyup(function(){
            table.draw();
        });
        $(".bankfilter").keyup(function(){
            table.draw();
        });
        $(".nilaifilter").keyup(function(){
            table.draw();
        });
        $(".bulanfilter").keyup(function(){
            table.draw();
        });
        $('body').on('change', '.opdfilter', function () {
            table.draw();
        });
        $('body').on('change', '.bankfilter', function () {
            table.draw();

        });
        $('body').on('change', '.bulanfilter', function () {
            table.draw();

        });
        /*------------------------------------------
        --------------------------------------------
        Click to Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.Createpenerimaan', function () {
            $('#saveBtncreate').val("create-penerimaan");
            $('#penerimaan_id').val('');
            $('#BkuPnnFormcreate').trigger("reset");
            $('#modelHeadingcreate').html("<i class='fa fa-plus'></i> Create New Penerimaan");
            // $('#create_id_bank').select2({
            //         dropdownParent: $('#ajaxModelcreate')
            // });
            // $('#create_id_opd').select2({
            //         dropdownParent: $('#ajaxModelcreate')
            // });
                    $.ajax({
                        type : 'get',
                        url: "{{ route('bku-penerimaan.create') }}",
                        // data :  'id='+ id,
                        success : function(data){
                        $('#hasilcreate').html(data);//menampilkan data ke dalam modal
                        $('#ajaxModelcreate').modal('show');

                        }
                    });
            // })
        });
        $('#BkuPnnFormcreate').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#saveBtncreate').html('Sending...');

            $.ajax({
                    type:'POST',
                    url: "{{ route('bku-penerimaan.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        $('.hasil-show').html(response);//menampilkan data ke dalam modal
                        $('#saveBtncreate').html('Submit');
                        $('#BkuPnnFormcreate').trigger("reset");
                        $('#ajaxModelcreate').modal('hide');
                        $('#ajaxModelshow').modal('show');
                        table.draw();
                    },
                    error: function(error){
                        $('#saveBtncreate').html('Submit');
                        // $("#alert-create_no_bku").find("ul").html('');
                        // $("#alert-create_no_bku").css('display','block');
                        // $.each( error.responseJSON.create_no_bku, function( key, value ) {
                        //     $("#alert-create_no_bku").find("ul").append('<li>'+value+'</li>');
                        // });
                        if (error.responseJSON.create_tanggal_bku) {
                            $("#alert-create_tanggal_bku").find("ul").html('');
                            $("#alert-create_tanggal_bku").css('display','block');
                            $('#alert-create_tanggal_bku').html(error.responseJSON.create_tanggal_bku);
                            $.each( error.responseJSON.create_tanggal_bku, function( key, value ) {
                                $("#alert-create_tanggal_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_tanggal_bku").find("ul").html('');
                            $("#alert-create_tanggal_bku").css('display','none');
                            $.each( error.responseJSON.create_tanggal_bku, function( key, value ) {
                                $("#alert-create_tanggal_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_no_bku) {
                            $("#alert-create_no_bku").find("ul").html('');
                            $("#alert-create_no_bku").css('display','block');
                            $('#alert-create_no_bku').html(error.responseJSON.create_no_bku);
                            $.each( error.responseJSON.create_no_bku, function( key, value ) {
                                $("#alert-create_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_no_bku").find("ul").html('');
                            $("#alert-create_no_bku").css('display','none');
                            $.each( error.responseJSON.create_no_bku, function( key, value ) {
                                $("#alert-create_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_tgl_sts) {
                            $("#alert-create_tgl_sts").find("ul").html('');
                            $("#alert-create_tgl_sts").css('display','block');
                            $('#alert-create_tgl_sts').html(error.responseJSON.create_tgl_sts);
                            $.each( error.responseJSON.create_tgl_sts, function( key, value ) {
                                $("#alert-create_tgl_sts").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_tgl_sts").find("ul").html('');
                            $("#alert-create_tgl_sts").css('display','none');
                            $.each( error.responseJSON.create_tgl_sts, function( key, value ) {
                                $("#alert-create_tgl_sts").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        // if (error.responseJSON.create_no_rekening) {
                        //     $("#alert-create_no_rekening").find("ul").html('');
                        //     $("#alert-create_no_rekening").css('display','block');
                        //     $('#alert-create_no_rekening').html(error.responseJSON.create_no_rekening);
                        //     $.each( error.responseJSON.create_no_rekening, function( key, value ) {
                        //         $("#alert-create_no_rekening").find("ul").append('<li>'+value+'</li>');
                        //     });
                        // } else {
                        //     $("#alert-create_no_rekening").find("ul").html('');
                        //     $("#alert-create_no_rekening").css('display','none');
                        //     $.each( error.responseJSON.create_no_rekening, function( key, value ) {
                        //         $("#alert-create_no_rekening").find("ul").append('<li>'+value+'</li>');
                        //     });
                        // }
                        if (error.responseJSON.create_uraian_bku) {
                            $("#alert-create_uraian_bku").find("ul").html('');
                            $("#alert-create_uraian_bku").css('display','block');
                            $('#alert-create_uraian_bku').html(error.responseJSON.create_uraian_bku);
                            $.each( error.responseJSON.create_uraian_bku, function( key, value ) {
                                $("#alert-create_uraian_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_uraian_bku").find("ul").html('');
                            $("#alert-create_uraian_bku").css('display','none');
                            $.each( error.responseJSON.create_uraian_bku, function( key, value ) {
                                $("#alert-create_uraian_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_id_opd) {
                            $("#alert-create_id_opd").find("ul").html('');
                            $("#alert-create_id_opd").css('display','block');
                            $('#alert-create_id_opd').html(error.responseJSON.create_id_opd);
                            $.each( error.responseJSON.create_id_opd, function( key, value ) {
                                $("#alert-create_id_opd").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_id_opd").find("ul").html('');
                            $("#alert-create_id_opd").css('display','none');
                            $.each( error.responseJSON.create_id_opd, function( key, value ) {
                                $("#alert-create_id_opd").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_id_bank) {
                            $("#alert-create_id_bank").find("ul").html('');
                            $("#alert-create_id_bank").css('display','block');
                            $('#alert-create_id_bank').html(error.responseJSON.create_id_bank);
                            $.each( error.responseJSON.create_id_bank, function( key, value ) {
                                $("#alert-create_id_bank").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_id_bank").find("ul").html('');
                            $("#alert-create_id_bank").css('display','none');
                            $.each( error.responseJSON.create_id_bank, function( key, value ) {
                                $("#alert-create_id_bank").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_subrincianObjek) {
                            $("#alert-create_subrincianObjek").find("ul").html('');
                            $("#alert-create_subrincianObjek").css('display','block');
                            $('#alert-create_subrincianObjek').html(error.responseJSON.create_subrincianObjek);
                            $.each( error.responseJSON.create_subrincianObjek, function( key, value ) {
                                $("#alert-create_subrincianObjek").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_subrincianObjek").find("ul").html('');
                            $("#alert-create_subrincianObjek").css('display','none');
                            $.each( error.responseJSON.create_subrincianObjek, function( key, value ) {
                                $("#alert-create_subrincianObjek").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.create_nilai_sts) {
                            $("#alert-create_nilai_sts").find("ul").html('');
                            $("#alert-create_nilai_sts").css('display','block');
                            $('#alert-create_nilai_sts').html(error.responseJSON.create_nilai_sts);
                            $.each( error.responseJSON.create_nilai_sts, function( key, value ) {
                                $("#alert-create_nilai_sts").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-create_nilai_sts").find("ul").html('');
                            $("#alert-create_nilai_sts").css('display','none');
                            $.each( error.responseJSON.create_nilai_sts, function( key, value ) {
                                $("#alert-create_nilai_sts").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.double_no_bku) {
                            $("#alert-double_no_bku").find("ul").html('');
                            $("#alert-double_no_bku").css('display','block');
                            $('#alert-double_no_bku').html(error.responseJSON.double_no_bku);
                            $.each( error.responseJSON.double_no_bku, function( key, value ) {
                                $("#alert-double_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-double_no_bku").find("ul").html('');
                            $("#alert-double_no_bku").css('display','none');
                            $.each( error.responseJSON.double_no_bku, function( key, value ) {
                                $("#alert-double_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }


                    }
               });

        });

        $('body').on('click', '.editbaru', function () {
            var penerimaan_id = $(this).data('id');
            $('#modelHeading').html("<i class='fa-regular fa-pen-to-square'></i> Edit BKU Penerimaan");
            $('#saveBtnupdate').val("edit_penerimaan");
            $.ajax({
                        type : 'get',
                        url: "{{ route('bku-penerimaan.index') }}" +'/' + penerimaan_id +'/edit',
                        data :  'penerimaan_id='+ penerimaan_id,
                        success : function(data){
                        $('#hasilupdate').html(data);//menampilkan data ke dalam modal
                        $('#ajaxModelupdate').modal('show');

                        }
                    });

        });
        $('#BkuPnnFormupdate').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#saveBtnupdate').html('Sending...');
            $.ajax({
                    type:'POST',
                    url: "{{ route('bku-penerimaan.update') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        $('.hasil-show').html(response);//menampilkan data ke dalam modal
                        $('#saveBtnupdate').html('Submit');
                        $('#BkuPnnFormupdate').trigger("reset");
                        $('#ajaxModelupdate').modal('hide');
                        $('#ajaxModelshow').modal('show');
                        table.draw();
                    },
                    error: function(error){
                        $('#saveBtnupdate').html('Submit');
                        // $("#alert-edit_no_bku").find("ul").html('');
                        // $("#alert-edit_no_bku").css('display','block');
                        // $.each( error.responseJSON.edit_no_bku, function( key, value ) {
                        //     $("#alert-edit_no_bku").find("ul").append('<li>'+value+'</li>');
                        // });
                        if (error.responseJSON.edit_tanggal_bku) {
                            $("#alert-edit_tanggal_bku").find("ul").html('');
                            $("#alert-edit_tanggal_bku").css('display','block');
                            $('#alert-edit_tanggal_bku').html(error.responseJSON.edit_tanggal_bku);
                            $.each( error.responseJSON.edit_tanggal_bku, function( key, value ) {
                                $("#alert-edit_tanggal_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_tanggal_bku").find("ul").html('');
                            $("#alert-edit_tanggal_bku").css('display','none');
                            $.each( error.responseJSON.edit_tanggal_bku, function( key, value ) {
                                $("#alert-edit_tanggal_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_no_bku) {
                            $("#alert-edit_no_bku").find("ul").html('');
                            $("#alert-edit_no_bku").css('display','block');
                            $('#alert-edit_no_bku').html(error.responseJSON.edit_no_bku);
                            $.each( error.responseJSON.edit_no_bku, function( key, value ) {
                                $("#alert-edit_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_no_bku").find("ul").html('');
                            $("#alert-edit_no_bku").css('display','none');
                            $.each( error.responseJSON.edit_no_bku, function( key, value ) {
                                $("#alert-edit_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_tgl_sts) {
                            $("#alert-edit_tgl_sts").find("ul").html('');
                            $("#alert-edit_tgl_sts").css('display','block');
                            $('#alert-edit_tgl_sts').html(error.responseJSON.edit_tgl_sts);
                            $.each( error.responseJSON.edit_tgl_sts, function( key, value ) {
                                $("#alert-edit_tgl_sts").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_tgl_sts").find("ul").html('');
                            $("#alert-edit_tgl_sts").css('display','none');
                            $.each( error.responseJSON.edit_tgl_sts, function( key, value ) {
                                $("#alert-edit_tgl_sts").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        // if (error.responseJSON.edit_no_rekening) {
                        //     $("#alert-edit_no_rekening").find("ul").html('');
                        //     $("#alert-edit_no_rekening").css('display','block');
                        //     $('#alert-edit_no_rekening').html(error.responseJSON.edit_no_rekening);
                        //     $.each( error.responseJSON.edit_no_rekening, function( key, value ) {
                        //         $("#alert-edit_no_rekening").find("ul").append('<li>'+value+'</li>');
                        //     });
                        // } else {
                        //     $("#alert-edit_no_rekening").find("ul").html('');
                        //     $("#alert-edit_no_rekening").css('display','none');
                        //     $.each( error.responseJSON.edit_no_rekening, function( key, value ) {
                        //         $("#alert-edit_no_rekening").find("ul").append('<li>'+value+'</li>');
                        //     });
                        // }
                        if (error.responseJSON.edit_uraian_bku) {
                            $("#alert-edit_uraian_bku").find("ul").html('');
                            $("#alert-edit_uraian_bku").css('display','block');
                            $('#alert-edit_uraian_bku').html(error.responseJSON.edit_uraian_bku);
                            $.each( error.responseJSON.edit_uraian_bku, function( key, value ) {
                                $("#alert-edit_uraian_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_uraian_bku").find("ul").html('');
                            $("#alert-edit_uraian_bku").css('display','none');
                            $.each( error.responseJSON.edit_uraian_bku, function( key, value ) {
                                $("#alert-edit_uraian_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_id_opd) {
                            $("#alert-edit_id_opd").find("ul").html('');
                            $("#alert-edit_id_opd").css('display','block');
                            $('#alert-edit_id_opd').html(error.responseJSON.edit_id_opd);
                            $.each( error.responseJSON.edit_id_opd, function( key, value ) {
                                $("#alert-edit_id_opd").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_id_opd").find("ul").html('');
                            $("#alert-edit_id_opd").css('display','none');
                            $.each( error.responseJSON.edit_id_opd, function( key, value ) {
                                $("#alert-edit_id_opd").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_id_bank) {
                            $("#alert-edit_id_bank").find("ul").html('');
                            $("#alert-edit_id_bank").css('display','block');
                            $('#alert-edit_id_bank').html(error.responseJSON.edit_id_bank);
                            $.each( error.responseJSON.edit_id_bank, function( key, value ) {
                                $("#alert-edit_id_bank").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_id_bank").find("ul").html('');
                            $("#alert-edit_id_bank").css('display','none');
                            $.each( error.responseJSON.edit_id_bank, function( key, value ) {
                                $("#alert-edit_id_bank").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_subrincianObjek) {
                            $("#alert-edit_subrincianObjek").find("ul").html('');
                            $("#alert-edit_subrincianObjek").css('display','block');
                            $('#alert-edit_subrincianObjek').html(error.responseJSON.edit_subrincianObjek);
                            $.each( error.responseJSON.edit_subrincianObjek, function( key, value ) {
                                $("#alert-edit_subrincianObjek").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_subrincianObjek").find("ul").html('');
                            $("#alert-edit_subrincianObjek").css('display','none');
                            $.each( error.responseJSON.edit_subrincianObjek, function( key, value ) {
                                $("#alert-edit_subrincianObjek").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.edit_nilai_sts) {
                            $("#alert-edit_nilai_sts").find("ul").html('');
                            $("#alert-edit_nilai_sts").css('display','block');
                            $('#alert-edit_nilai_sts').html(error.responseJSON.edit_nilai_sts);
                            $.each( error.responseJSON.edit_nilai_sts, function( key, value ) {
                                $("#alert-edit_nilai_sts").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-edit_nilai_sts").find("ul").html('');
                            $("#alert-edit_nilai_sts").css('display','none');
                            $.each( error.responseJSON.edit_nilai_sts, function( key, value ) {
                                $("#alert-edit_nilai_sts").find("ul").append('<li>'+value+'</li>');
                            });
                        }
                        if (error.responseJSON.double_no_bku) {
                            $("#alert-double_no_bku").find("ul").html('');
                            $("#alert-double_no_bku").css('display','block');
                            $('#alert-double_no_bku').html(error.responseJSON.double_no_bku);
                            $.each( error.responseJSON.double_no_bku, function( key, value ) {
                                $("#alert-double_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        } else {
                            $("#alert-double_no_bku").find("ul").html('');
                            $("#alert-double_no_bku").css('display','none');
                            $.each( error.responseJSON.double_no_bku, function( key, value ) {
                                $("#alert-double_no_bku").find("ul").append('<li>'+value+'</li>');
                            });
                        }


                    }
            });

        });
    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.banrecord', function () {
      var penerimaan_idban = $(this).data('id');
      $.ajax({
            type : 'get',
            url: "{{ route('bku-penerimaan.index') }}" +'/' + penerimaan_idban +'/batal',
            data :  'penerimaan_idban='+ penerimaan_idban,
            success : function(data){
                $('#batal').html(data);//menampilkan data ke dalam modal
                $('#ajaxModelban').modal('show');
                $('#saveBtnban').val("edit-user");
            }
        });
    });
    $('#penerimaanbanForm').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        $('#saveBtnban').html('Sending...');

        $.ajax({
                type:'POST',
                url: "{{ route('bku-penerimaan.update1') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                      $('#saveBtnban').html('Submit');
                      $('#penerimaanbanForm').trigger("reset");
                      $('#ajaxModelban').modal('hide');
                      table.draw();
                },
                error: function(response){
                    $('#saveBtnban').html('Submit');
                    $('#penerimaanbanForm').find(".print-error-msg").find("ul").html('');
                    $('#penerimaanbanForm').find(".print-error-msg").css('display','block');
                    $.each( response.responseJSON.errors, function( key, value ) {
                        $('#penerimaanbanForm').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
           });

    });
/*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.unbanrecord', function () {
      var penerimaan_idunban = $(this).data('id');
        $.ajax({
            type : 'get',
            url: "{{ route('bku-penerimaan.index') }}" +'/' + penerimaan_idunban +'/unbatal',
            data :  'penerimaan_idunban='+ penerimaan_idunban,
            success : function(data){
                $('#unbatal').html(data);//menampilkan data ke dalam modal
                $('#ajaxModelunban').modal('show');
                $('#saveBtnunban').val("edit-user");
            }
        });
    //   $.get("{{ route('bku-penerimaan.index') }}" +'/' + penerimaan_idunban, function (data) {

    //       $('#saveBtnunban').val("edit-user");
    //       $('#ajaxModelunban').modal('show');
    //       $('#penerimaan_idunban').val(data.id);
    //       $('.penerimaan_id_sp2dunban').text(data.id_sp2d);
    //       $('.penerimaan_no_sp2dunban').text(data.no_sp2d);
    //   })
    });
    $('#penerimaanunbanForm').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        $('#saveBtnunban').html('Sending...');

        $.ajax({
                type:'POST',
                url: "{{ route('bku-penerimaan.update2') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                      $('#saveBtnunban').html('Submit');
                      $('#penerimaanunbanForm').trigger("reset");
                      $('#ajaxModelunban').modal('hide');
                      table.draw();
                },
                error: function(response){
                    $('#saveBtnunban').html('Submit');
                    $('#penerimaanunbanForm').find(".print-error-msg").find("ul").html('');
                    $('#penerimaanunbanForm').find(".print-error-msg").css('display','block');
                    $.each( response.responseJSON.errors, function( key, value ) {
                        $('#penerimaanunbanForm').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
           });

    });


});
    </script>
@endsection
