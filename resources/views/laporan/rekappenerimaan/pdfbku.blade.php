<!DOCTYPE html>
<html>
<head>
    <title>SIBKU</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" > --}}
    <link href="{{ URL::asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
body {
  /* background-repeat: repeat; */
  background: #f9f9f9;
  font-family: "Poppins", sans-serif;
  color: #354558;
  font-size: 23px;
}
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        /* Header styling */
        th {
            background-color: rgb(103, 137, 174);
            font-weight: bold;
            text-align: center;
        }


        tr:hover {
            background-color: #ddd;
        }
        .text {
            text-align: center;
        }
        hr {
            margin: 1rem 0;
            color: inherit;
            background-color: currentColor;
            border: 0;
            opacity: 0.25;
        }

        hr:not([size]) {
            height: 1px;
        }

        h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6 {
            margin-top: 0;
            margin-bottom: 0.75rem;
            font-weight: 500;
            line-height: 0.5;
        }
        .container {
            padding: 0 15px 5px 15px;
            min-height: 80vh;
        }
        .textuppercase {
           text-transform: uppercase;
        }
    </style>
    <style>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-2 text"><img src="{{ URL::asset('assets/images/logo palu.png')}}" style="width: 90px; left: 50px;" alt="" /></div>
            <div class="col-lg-9 text textuppercase">
                <center>
                        <h4>PEMERINTAH KOTA PALU</h4>
                        <h4>BUKU KAS PENGELUARAN</h4>
                        <h4>TAHUN ANGGARAN 2025 {{ old('text',$bulan) }}</h4>

                   </center>
            </div>
        </div>
        <div class="row">
            <table class='table table-bordered dt-responsive nowrap data-table'>
                <thead style="background: rgb(103, 137, 174); color: #ffff;">
                    <tr >
                        <th>No</th>
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
                        <tr style="background: rgb(142, 171, 202); color: #ffff;">
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
                            <tr style="background: rgb(226, 166, 166); color: #ffff;">
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
                                        <tr style="background: rgb(125, 124, 124); color: #ffff;">
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
                            <tr style="background: rgb(226, 166, 166); color: #ffff;">
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
                                        <tr style="background: rgb(125, 124, 124); color: #ffff;">
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
                            <tr style="background: rgb(226, 166, 166); color: #ffff;">
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
                                        <tr style="background: rgb(125, 124, 124); color: #ffff;">
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
                                                        <td style="width: 100px; text-align: right">{{ number_format($SubPenerimaan3->nilai_paguopd, 0, '.', ',') }}</td>
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

        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
