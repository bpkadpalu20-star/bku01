<!DOCTYPE html>
<html>
<head>
    <title>SIBKU</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
            page-break-inside:auto
        }
        tr    {
            page-break-inside:avoid;
            page-break-after:auto
        }
        thead {
            display:table-header-group
        }
        th, td {
            border: black 1px solid;
            padding-left: 5px;
            padding-right: 5px;
            min-width: 100px;
        }
        @page {
            size: legal landscape;
            margin: 1cm;

        }
        #logo{
            width:111px;
            height:90px;
            padding-top:10px;
            margin-left:10px;
        }

        h2,h3{
            margin: 0px 0px 0px 0px;
        }
        .row{ clear: both; }
        .col-lg-1 {width:8%;  float:left;}
        .col-lg-2 {width:16%; float:left;}
        .col-lg-3 {width:25%; float:left;}
        .col-lg-4 {width:33%; float:left;}
        .col-lg-5 {width:42%; float:left;}
        .col-lg-6 {width:50%; float:left;}
        .col-lg-7 {width:58%; float:left;}
        .col-lg-8 {width:66%; float:left;}
        .col-lg-9 {width:75%; float:left;}
        .col-lg-10{width:83%; float:left;}
        .col-lg-11{width:92%; float:left;}
        .col-lg-12{width:100%; float:left;}
        </style>

</head>
<body>
    <title>Laporan BKU Pengeluaran</title>
<div id="print">
<div class="row" >
    <div class="col-lg-2" style="left: 20px">
   <img src='{{ URL::asset('assets/images/logo palu.png')}}' height="100" width="100">
</div> <!-- end card -->
   <div class="col-lg-8" style="text-align: center">
   <h2>PEMERINTAH KOTA PALU</h2><h2>BUKU KAS TAHUN ANGGARAN 2025</h2>
</div> <!-- end card -->
</div> <!-- end card -->
<table class='table table-bordered dt-responsive nowrap data-table' style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th width="60px">No</th>
            <th width="30px">Nomer SP2D/STS</th>
            <th width="30px">Tanggal</th>
            <th width="260px">Uraian</th>
            <th width="80px">Sumber Dana</th>
            <th width="80px">OPD</th>
            <th width="80px">Pihak Ketiga</th>
            <th width="80px">Bank</th>
            <th width="80px">Nilai Penerimaan</th>
            <th width="80px">Nilai Pengeluaran</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total = 0;
        @endphp
        @if ($Bku->isNotEmpty())
        @foreach ($Bku as $bkusatu)
        @php
        // $total = $total + $Pengeluaran->sum('nilai_sp2d');
        @endphp
        <tr>
            <td width="60px">{{ $bkusatu->id_bku }}</td>
                <td width="30px">{{ $bkusatu->no_bku }}</td>
                <td width="30px">{{ $bkusatu->tanggal_bku }}</td>
                <td width="260px">{{ $bkusatu->uraian_bku }}</td>
                <td width="60px">{{ $bkusatu->uraian_dana }}</td>
                <td width="60px">{{ $bkusatu->uraian_skpd }}</td>
                <td width="60px">{{ $bkusatu->nama_rekanan }}</td>
                <td width="60px">{{ $bkusatu->kode_bank }}</td>
                @if ($bkusatu->aktif == "Y")
                <td width="60px" style="text-align: right"></td>
                <td width="60px" style="text-align: right"></td>
                @else
                <td width="60px" style="text-align: right">{{ number_format($bkusatu->nilai_sts, 0, '.', ',') }}</td>
                <td width="60px" style="text-align: right">{{ number_format($bkusatu->nilai_sp2d, 0, '.', ',') }}</td>
                @endif

        </tr>
        @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th colspan="8" style="text-align: right">Total</th>
            <td style="text-align: right"> {{ number_format($total = $countsts->sum('nilai_sts'), 0, '.', ',') }}</td>
            <td style="text-align: right"> {{ number_format($total = $countsp2d->sum('nilai_sp2d'), 0, '.', ',') }}</td>
        </tr>
    </tfoot>
</table>
</div> <!-- end card -->
</body>
</html>
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
        paging:   false,
      ordering: false,
          info:     false,
          searching: false,
        ajax: "{{ route('laporan.bku.index') }}",
        columns: [
            {data: 'id_bku', name: 'id_bku'},
            {data: 'no_bku', name: 'no_bku'},
            {data: 'tanggal_bku', name: 'tanggal_bku'},
            {data: 'uraian_bku', name: 'uraian_bku'},
            {data: 'uraian_dana', name: 'uraian_dana'},
            {data: 'singkatan', name: 'singkatan'},
            {data: 'nama_rekanan', name: 'nama_rekanan'},
            {data: 'kode_bank', name: 'kode_bank'},
            {data: 'nilai_sts',  render: $.fn.dataTable.render.number( ',', '.', 0, '' ), className: 'text-right'},
            {data: 'nilai_sp2d',  render: $.fn.dataTable.render.number( ',', '.', 0, '' ), className: 'text-right'},
        ]
    });
});
  </script>
