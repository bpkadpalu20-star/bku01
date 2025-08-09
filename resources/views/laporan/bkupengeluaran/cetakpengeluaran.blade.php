<!DOCTYPE html>
<html>
<head>

    <style type="text/css">
        #print {
            margin:auto;
            text-align:center;
            font-family:"Calibri", Courier, monospace;
            width:1200px;
            font-size:14px;
        }
        #print .title {
            margin:20px;
            text-align:right;
            font-family:"Calibri", Courier, monospace;
            font-size:12px;
        }
        #print span {
            text-align:center;
            font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size:18px;
        }
        #print table {
            border-collapse:collapse;
            width:100%;
            margin:10px;
        }
        #print .table1 {
            border-collapse:collapse;
            width:90%;
            text-align:center;
            margin:10px;
        }
        #print table hr {
            border:3px double #000;
        }
        #print .ttd {
            float:right;
            width:250px;
            background-position:center;
            background-size:contain;
        }
        #print table th {
            color:#000;
            font-family:Verdana, Geneva, sans-serif;
            font-size:12px;
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
        </style>

</head>
<body>
    <title>Laporan BKU Pengeluaran</title>
    <div id="print">
    <table class='table1'>
<tr>
    <td><img src='{{ URL::asset('assets/images/logo palu.png')}}' height="100" width="100"></td>
    <td><h2>PEMERINTAH KOTA PALU</h2><h2>BUKU KAS PENGELUARAN TAHUN ANGGARAN 2025</h2></td>
</tr>
<table class='table table-bordered dt-responsive nowrap' style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th width="60px">No</th>
            <th width="80px">Nomer SP2D</th>
            <th>Uraian SP2D</th>
            <th width="80px">Sumber Dana</th>
            <th width="80px">OPD</th>
            <th width="80px">Pihak Ketiga</th>
            <th width="80px">Bank</th>
            <th width="80px">Nilai</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total = 0;
        @endphp
        @if ($BkuPengeluaran->isNotEmpty())
        @foreach ($BkuPengeluaran as $Pengeluaran)
        @php
        // $total = $total + $Pengeluaran->sum('nilai_sp2d');
        @endphp
        <tr>
            <td>{{ $Pengeluaran->id_sp2d }}</td>
            <td>{{ $Pengeluaran->no_sp2d }}</td>
            <td>{{ $Pengeluaran->uraian_sp2d }}</td>
            <td>{{ $Pengeluaran->kode_dana }}</td>
            <td>{{ $Pengeluaran->singkatan }}</td>
            <td>{{ $Pengeluaran->nama_rekanan }}</td>
            <td>{{ $Pengeluaran->kode_bank }}</td>
            <td style="text-align: right">{{ number_format($Pengeluaran->nilai_sp2d, 0) }}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th colspan="7" style="text-align: right">Total</th>

            <td style="text-align: right"> {{ number_format($total = $count->sum('nilai_sp2d'), 0) }}</td>
        </tr>
    </tfoot>
</table>

</body>
</html>
