<!DOCTYPE html>
<html>
<head>

    <style type="text/css">
        #print .table1 {
            width: 100%;
            border-collapse: collapse;
            text-align: center
        }
        #print table {
            width: 100%;
            border-collapse: collapse;
        }

        #print th,
        #print td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        #print th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }


        #print tr:hover {
            background-color: #ddd;
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
    <title>Laporan BKU Penerimaan</title>
    {{-- <div id="print"> --}}
<table id='table1'>
    <tr>
        <td><img src='{{ URL::asset('assets/images/logo palu.png')}}' height="100" width="100"></td>
        <td style="text-align: center"><h2>PEMERINTAH KOTA PALU</h2><h2>BUKU KAS PENERIMAAN TAHUN ANGGARAN 2025</h2></td>
        <td></td>
    </tr>
</table>
<table id="print">
    <thead>
        <tr>
            <th width="60px">NO Bukti</th>
            <th width="30px">Nomer STS</th>
            <th width="30px">Tanggal</th>
            <th width="260px">Uraian</th>
            <th width="80px">OPD</th>
            <th width="80px">Bank</th>
            <th width="80px">Nilai</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total = 0;
        @endphp
         @if ($BkuPenerimaan->isNotEmpty())
         @foreach ($BkuPenerimaan as $Penerimaan)
        @php
        // $total = $total + $Penerimaan->sum('nilai_sp2d');
        @endphp
        <tr>
            <td>{{ $Penerimaan->id_kas }}</td>
            <td>{{ $Penerimaan->no_sts }}</td>
            <td>{{ $Penerimaan->tanggal_kas }}</td>
            <td>{{ $Penerimaan->uraian_kas }}</td>
            <td>{{ $Penerimaan->singkatan }}</td>
            <td>{{ $Penerimaan->kode_bank }}</td>
            <td style="text-align: right">{{ number_format($Penerimaan->nilai_sts, 0, '.', ',') }}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th colspan="6" style="text-align: right">Total</th>

            <td style="text-align: right"> {{ number_format($total = $count->sum('nilai_sp2d'), 0) }}</td>
        </tr>
    </tfoot>
</table>
{{-- </div> --}}
</body>
</html>
