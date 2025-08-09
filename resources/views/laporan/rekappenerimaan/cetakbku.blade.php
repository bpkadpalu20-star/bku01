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
    <div class="col-lg-2" style="left: 50px">
   <img src='{{ URL::asset('assets/images/logo palu.png')}}' style="left: 50px" height="100" width="100">
</div> <!-- end card -->
   <div class="col-lg-8" style="text-align: center">
   <h2>PEMERINTAH KOTA PALU</h2><h2>BUKU KAS TAHUN ANGGARAN 2025</h2>
</div> <!-- end card -->
</div> <!-- end card -->
<table class='table'>
    <thead>
        <tr >
            <th style="width: 10px">No</th>
            <th>KODE REKENING</th>
            <th>URAIAN</th>
            <th>PAGU ANGGARAN</th>
            <th>REASLIASI</th>
        </tr>
    </thead>
    @php

    @endphp
    @if ($BulanPenerimaan->isNotEmpty())
        @foreach ($BulanPenerimaan as $key => $Opd1)
        <tbody>
            <tr>
                <td style="width: 10px">{{ $Opd1->id_opd }}</td>
                <td style="width: 10px"></td>
                <td style="width: 400px">{{ $Opd1->uraian_skpd }}</td>
                <td style="width: 100px; text-align: right">{{ number_format($Opd1->nilai_pagubulan, 0, '.', ',') }}</td>
                <td style="width: 100px; text-align: right">{{ number_format($Opd1->nilai_realisasibulan, 0, '.', ',') }}</td>
            </tr>
        </tbody>
            @foreach($KelompokPenerimaan as $key => $Kelompok)
            @if ($Opd1->id_opd == $Kelompok->id_opd )
            @if ($Opd1->bulan_id == $Kelompok->bulan_id )
                @if ($Kelompok->id_kelompok == '1')
                <tr >
                    <td style="width: 10px"></td>
                    <td style="width: 10px">4.1</td>
                    <td style="width: 400px">PENDAPATAN ASLI DAERAH (PAD)</td>
                    <td style="width: 100px; text-align: right">{{ number_format($Kelompok->nilai_pagukelompok, 0, '.', ',') }}</td>
                    <td style="width: 100px; text-align: right">{{ number_format($Kelompok->nilai_realisasikelompok, 0, '.', ',') }}</td>
                </tr>
                    @foreach($JenisPenerimaan as $key => $Jenis1)
                        @if ($Jenis1->id_opd == $Opd1->id_opd)
                        @if ($Jenis1->bulan_id == $Opd1->bulan_id)
                        @if ($Jenis1->id_kelompok == '1')
                            @php
                                $Jenis01 = $Jenis1->id_jenis;
                            @endphp
                            <tr >
                                <td style="width: 10px"></td>
                                <td style="width: 10px">{{ $Jenis1->kode_jenis }}</td>
                                <td style="width: 400px">{{ $Jenis1->uraian_jenis }}</td>
                                <td style="width: 100px; text-align: right">{{ number_format($Jenis1->nilai_pagujenis, 0, '.', ',') }}</td>
                                <td style="width: 100px; text-align: right">{{ number_format($Jenis1->nilai_realisasijenis, 0, '.', ',') }}</td>
                            </tr>

                            @foreach($ObjekPenerimaan as $key => $Objek1)
                                @if ($Objek1->id_opd == $Opd1->id_opd)
                                @if ($Objek1->bulan_id == $Opd1->bulan_id)
                                @if ($Objek1->id_kelompok == '1')
                                @if ($Objek1->id_jenis == $Jenis01)
                                @php
                                    $Objek01 = $Objek1->id_objek;
                                @endphp
                                <tr style="background: rgb(159, 154, 154); color: #000000;">
                                    <td style="width: 10px"></td>
                                    <td style="width: 10px">{{ $Objek1->kode_objek }}</td>
                                    <td style="width: 400px">{{ $Objek1->uraian_objek }}</td>
                                    <td style="width: 100px; text-align: right">{{ number_format($Objek1->nilai_paguobjek, 0, '.', ',') }}</td>
                                    <td style="width: 100px; text-align: right">{{ number_format($Objek1->nilai_realisasiobjek, 0, '.', ',') }}</td>
                                </tr>

                                @foreach($RincianObjekPenerimaan as $key => $Rincian1)
                                    @if ($Rincian1->id_opd == $Opd1->id_opd)
                                    @if ($Rincian1->bulan_id == $Opd1->bulan_id)
                                    @if ($Rincian1->id_kelompok == '1')
                                    @if ($Rincian1->id_jenis == $Jenis01)
                                    @if ($Rincian1->id_objek == $Objek01)
                                    @php
                                        $Rincian01 = $Rincian1->id_rincianobjek;
                                    @endphp
                                    <tr style="background: rgb(231, 228, 228); color: #000000;">
                                        <td style="width: 10px"></td>
                                        <td style="width: 10px">{{ $Rincian1->kode_rincianobjek }}</td>
                                        <td style="width: 400px">{{ $Rincian1->uraian_rincianobjek }}</td>
                                        <td style="width: 100px; text-align: right">{{ number_format($Rincian1->nilai_pagurincian, 0, '.', ',') }}</td>
                                        <td style="width: 100px; text-align: right">{{ number_format($Rincian1->nilai_realisasirincian, 0, '.', ',') }}</td>
                                    </tr>

                                    @foreach($OPDPenerimaan as $key => $SubPenerimaan1)
                                        @if ($SubPenerimaan1->id_opd == $Opd1->id_opd)
                                        @if ($SubPenerimaan1->bulan_id == $Opd1->bulan_id)
                                        @if ($SubPenerimaan1->id_kelompok == '1')
                                        @if ($SubPenerimaan1->id_jenis == $Jenis01)
                                        @if ($SubPenerimaan1->id_objek == $Objek01)
                                        @if ($SubPenerimaan1->id_rincianobjek == $Rincian01)
                                        <tr style="background: rgb(253, 251, 251); color: #000000;">
                                            <td style="width: 10px"></td>
                                            <td style="width: 10px">{{ $SubPenerimaan1->no_rekening }}</td>
                                            <td style="width: 400px">{{ $SubPenerimaan1->uraian_subrincianobjek }}</td>
                                            <td style="width: 100px; text-align: right">{{ number_format($SubPenerimaan1->nilai_paguopd, 0, '.', ',') }}</td>
                                            <td style="width: 100px; text-align: right">{{ number_format($SubPenerimaan1->nilai_realisasiopd, 0, '.', ',') }}</td>
                                        </tr>
                                        @endif
                                        @endif
                                        @endif
                                        @endif
                                        @endif
                                        @endif
                                    @endforeach

                                    @endif
                                    @endif
                                    @endif
                                    @endif
                                    @endif
                                @endforeach

                                @endif
                                @endif
                                @endif
                                @endif
                            @endforeach
                        @endif
                        @endif
                        @endif
                    @endforeach
                @endif

                @if ($Kelompok->id_kelompok == '2')
                <tr >
                    <td style="width: 10px"></td>
                    <td style="width: 10px">4.2</td>
                    <td style="width: 400px">PENDAPATAN TRANSFER</td>
                    <td style="width: 100px; text-align: right">{{ number_format($Kelompok->nilai_pagukelompok, 0, '.', ',') }}</td>
                    <td style="width: 100px; text-align: right">{{ number_format($Kelompok->nilai_realisasikelompok, 0, '.', ',') }}</td>
                </tr>
                    @foreach($JenisPenerimaan as $key => $Jenis2)
                        @if ($Jenis2->id_opd == $Opd1->id_opd)
                        @if ($Jenis2->bulan_id == $Opd1->bulan_id)
                        @if ($Jenis2->id_kelompok == '2')
                            @php
                                $Jenis02 = $Jenis2->id_jenis;
                            @endphp
                            <tr >
                                <td style="width: 10px"></td>
                                <td style="width: 10px">{{ $Jenis2->kode_jenis }}</td>
                                <td style="width: 400px">{{ $Jenis2->uraian_jenis }}</td>
                                <td style="width: 100px; text-align: right">{{ number_format($Jenis2->nilai_pagujenis, 0, '.', ',') }}</td>
                                <td style="width: 100px; text-align: right">{{ number_format($Jenis2->nilai_realisasijenis, 0, '.', ',') }}</td>
                            </tr>

                            @foreach($ObjekPenerimaan as $key => $Objek2)
                                @if ($Objek2->id_opd == $Opd1->id_opd)
                                @if ($Objek2->bulan_id == $Opd1->bulan_id)
                                @if ($Objek2->id_kelompok == '2')
                                @if ($Objek2->id_jenis == $Jenis02)
                                @php
                                    $Objek02 = $Objek2->id_objek;
                                @endphp
                                <tr style="background: rgb(159, 154, 154); color: #000000;">
                                    <td style="width: 10px"></td>
                                    <td style="width: 10px">{{ $Objek2->kode_objek }}</td>
                                    <td style="width: 400px">{{ $Objek2->uraian_objek }}</td>
                                    <td style="width: 100px; text-align: right">{{ number_format($Objek2->nilai_paguobjek, 0, '.', ',') }}</td>
                                    <td style="width: 100px; text-align: right">{{ number_format($Objek2->nilai_realisasiobjek, 0, '.', ',') }}</td>
                                </tr>

                                @foreach($RincianObjekPenerimaan as $key => $Rincian2)
                                    @if ($Rincian2->id_opd == $Opd1->id_opd)
                                    @if ($Rincian2->bulan_id == $Opd1->bulan_id)
                                    @if ($Rincian2->id_kelompok == '2')
                                    @if ($Rincian2->id_jenis == $Jenis02)
                                    @if ($Rincian2->id_objek == $Objek02)
                                    @php
                                        $Rincian02 = $Rincian2->id_rincianobjek;
                                    @endphp
                                    <tr style="background: rgb(231, 228, 228); color: #000000;">
                                        <td style="width: 10px"></td>
                                        <td style="width: 10px">{{ $Rincian2->kode_rincianobjek }}</td>
                                        <td style="width: 400px">{{ $Rincian2->uraian_rincianobjek }}</td>
                                        <td style="width: 100px; text-align: right">{{ number_format($Rincian2->nilai_pagurincian, 0, '.', ',') }}</td>
                                        <td style="width: 100px; text-align: right">{{ number_format($Rincian2->nilai_realisasirincian, 0, '.', ',') }}</td>
                                    </tr>

                                    @foreach($OPDPenerimaan as $key => $SubPenerimaan2)
                                        @if ($SubPenerimaan2->id_opd == $Opd1->id_opd)
                                        @if ($SubPenerimaan2->bulan_id == $Opd1->bulan_id)
                                        @if ($SubPenerimaan2->id_kelompok == '2')
                                        @if ($SubPenerimaan2->id_jenis == $Jenis02)
                                        @if ($SubPenerimaan2->id_objek == $Objek02)
                                        @if ($SubPenerimaan2->id_rincianobjek == $Rincian02)
                                        <tr style="background: rgb(253, 251, 251); color: #000000;">
                                            <td style="width: 10px"></td>
                                            <td style="width: 10px">{{ $SubPenerimaan2->no_rekening }}</td>
                                            <td style="width: 400px">{{ $SubPenerimaan2->uraian_subrincianobjek }}</td>
                                            <td style="width: 100px; text-align: right">{{ number_format($SubPenerimaan2->nilai_paguopd, 0, '.', ',') }}</td>
                                            <td style="width: 100px; text-align: right">{{ number_format($SubPenerimaan2->nilai_realisasiopd, 0, '.', ',') }}</td>
                                        </tr>
                                        @endif
                                        @endif
                                        @endif
                                        @endif
                                        @endif
                                        @endif
                                    @endforeach

                                    @endif
                                    @endif
                                    @endif
                                    @endif
                                    @endif
                                @endforeach

                                @endif
                                @endif
                                @endif
                                @endif
                            @endforeach
                        @endif
                        @endif
                        @endif
                    @endforeach
                @endif

                @if ($Kelompok->id_kelompok == '3')
                <tr >
                    <td style="width: 10px"></td>
                    <td style="width: 10px">4.3</td>
                    <td style="width: 400px">LAIN-LAIN PENDAPATAN DAERAH YANG SAH</td>
                    <td style="width: 100px; text-align: right">{{ number_format($Kelompok->nilai_pagukelompok, 0, '.', ',') }}</td>
                    <td style="width: 100px; text-align: right">{{ number_format($Kelompok->nilai_realisasikelompok, 0, '.', ',') }}</td>
                </tr>
                    @foreach($JenisPenerimaan as $key => $Jenis3)
                        @if ($Jenis3->id_opd == $Opd1->id_opd)
                        @if ($Jenis3->bulan_id == $Opd1->bulan_id)
                        @if ($Jenis3->id_kelompok == '3')
                            @php
                                $Jenis03 = $Jenis3->id_jenis;
                            @endphp
                            <tr >
                                <td style="width: 10px"></td>
                                <td style="width: 10px">{{ $Jenis3->kode_jenis }}</td>
                                <td style="width: 400px">{{ $Jenis3->uraian_jenis }}</td>
                                <td style="width: 100px; text-align: right">{{ number_format($Jenis3->nilai_pagujenis, 0, '.', ',') }}</td>
                                <td style="width: 100px; text-align: right">{{ number_format($Jenis3->nilai_realisasijenis, 0, '.', ',') }}</td>
                            </tr>

                            @foreach($ObjekPenerimaan as $key => $Objek3)
                                @if ($Objek3->id_opd == $Opd1->id_opd)
                                @if ($Objek3->bulan_id == $Opd1->bulan_id)
                                @if ($Objek3->id_kelompok == '3')
                                @if ($Objek3->id_jenis == $Jenis03)
                                @php
                                    $Objek03 = $Objek3->id_objek;
                                @endphp
                                <tr style="background: rgb(159, 154, 154); color: #000000;">
                                    <td style="width: 10px"></td>
                                    <td style="width: 10px">{{ $Objek3->kode_objek }}</td>
                                    <td style="width: 400px">{{ $Objek3->uraian_objek }}</td>
                                    <td style="width: 100px; text-align: right">{{ number_format($Objek3->nilai_paguobjek, 0, '.', ',') }}</td>
                                    <td style="width: 100px; text-align: right">{{ number_format($Objek3->nilai_realisasiobjek, 0, '.', ',') }}</td>
                                </tr>

                                @foreach($RincianObjekPenerimaan as $key => $Rincian3)
                                    @if ($Rincian3->id_opd == $Opd1->id_opd)
                                    @if ($Rincian3->bulan_id == $Opd1->bulan_id)
                                    @if ($Rincian3->id_kelompok == '3')
                                    @if ($Rincian3->id_jenis == $Jenis03)
                                    @if ($Rincian3->id_objek == $Objek03)
                                    @php
                                        $Rincian03 = $Rincian3->id_rincianobjek;
                                    @endphp
                                    <tr style="background: rgb(231, 228, 228); color: #000000;">
                                        <td style="width: 10px"></td>
                                        <td style="width: 10px">{{ $Rincian3->kode_rincianobjek }}</td>
                                        <td style="width: 400px">{{ $Rincian3->uraian_rincianobjek }}</td>
                                        <td style="width: 100px; text-align: right">{{ number_format($Rincian3->nilai_pagurincian, 0, '.', ',') }}</td>
                                        <td style="width: 100px; text-align: right">{{ number_format($Rincian3->nilai_realisasirincian, 0, '.', ',') }}</td>
                                    </tr>

                                    @foreach($OPDPenerimaan as $key => $SubPenerimaan3)
                                        @if ($SubPenerimaan3->id_opd == $Opd1->id_opd)
                                        @if ($SubPenerimaan3->bulan_id == $Opd1->bulan_id)
                                        @if ($SubPenerimaan3->id_kelompok == '3')
                                        @if ($SubPenerimaan3->id_jenis == $Jenis03)
                                        @if ($SubPenerimaan3->id_objek == $Objek03)
                                        @if ($SubPenerimaan3->id_rincianobjek == $Rincian03)
                                        <tr style="background: rgb(253, 251, 251); color: #000000;">
                                            <td style="width: 10px"></td>
                                            <td style="width: 10px">{{ $SubPenerimaan3->no_rekening }}</td>
                                            <td style="width: 400px">{{ $SubPenerimaan3->uraian_subrincianobjek }}</td>
                                            <td style="width: 100px; text-align: right">{{ number_format($SubPenerimaan3->nilai_pagu, 0, '.', ',') }}</td>
                                            <td style="width: 100px; text-align: right">{{ number_format($SubPenerimaan3->nilai_realisasiopd, 0, '.', ',') }}</td>
                                        </tr>
                                        @endif
                                        @endif
                                        @endif
                                        @endif
                                        @endif
                                        @endif
                                    @endforeach

                                    @endif
                                    @endif
                                    @endif
                                    @endif
                                    @endif
                                @endforeach

                                @endif
                                @endif
                                @endif
                                @endif
                            @endforeach
                        @endif
                        @endif
                        @endif
                    @endforeach

                @endif

            @endif
            @endif
            @endforeach
        @endforeach
    @endif

    <tbody style="background: rgb(103, 137, 174); color: #ffff;">
        <tr style="background: rgb(103, 137, 174); color: #ffff;">
            <td colspan="3" style="text-align: center">TOTAL</td>
            <td style="width: 100px; text-align: right">{{ number_format($BulanPenerimaantotal->sum('nilai_pagubulan'), 0, '.', ',') }}</td>
            <td style="width: 100px; text-align: right">{{ number_format($BulanPenerimaantotal->sum('nilai_realisasibulan'), 0, '.', ',') }}</td>
        </tr>
    </tbody>
</table>
</div> <!-- end card -->
</body>
</html>

