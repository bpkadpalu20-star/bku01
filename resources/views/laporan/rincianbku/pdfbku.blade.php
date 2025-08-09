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
            background-color: rgb(121, 115, 115);
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
            <table class="table">
                <thead style="background: rgb(121, 115, 115); color: #ffff;">
                    <tr >
                        <th colspan="4" style="text-align:left;">Saldo Rek. Koran Per {{ old('text',$SaldoRekKoran->tgl_saldo) }}</th>
                        <th style="text-align: right; font-size: 14px;">{{ number_format($SaldoRekKoran->nilai_saldorekkoran, 0, '.', ',') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="background: rgb(125, 124, 124); color: #ffff; font-size: 14px;">
                        <td></td>
                        <td>Total Penerimaan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr style="background: rgb(125, 124, 124); color: #ffff; font-size: 14px;">
                        <td></td>
                        <td>Total Penerimaan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
                <thead style="background: rgb(121, 115, 115); color: #ffff;">
                    <tr>
                        <th colspan="4" style="text-align:left;">Rekonsiliasi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total1 = 0;
                    $total2 = 0;
                    $total3 = 0;
                    @endphp
                    @if ($rekapa->isNotEmpty())
                        @foreach ($rekapa as $key => $tigaa)
                            <tbody>
                                @php
                                    $Nilai1 = $tigaa->id;
                                    $Nilai11 = $tigaa->aktif;
                                @endphp
                                @foreach($NilaiHasilRekapB as $key => $Bulanbarurekap)
                                    @if ($Nilai1 == $Bulanbarurekap->id_rekap )
                                    <tr class="tbtn" style="background: rgb(125, 124, 124); color: #ffff;">
                                        <td style="width: 10px"></td>
                                        <td style="width: 400px">{{ $tigaa->uraian_rekap }}</td>
                                        <td style="width: 100px"></td>
                                        <td style="width: 100px"></td>
                                        <td style="width: 100px; text-align: right">{{ number_format($Bulanbarurekap->nilai_rincian, 0, '.', ',') }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                                @php
                                    $itemss = $tigaa->id;
                                @endphp
                                @foreach($HasilRekapA as $key => $itemmA)
                                    @if ($itemss == $itemmA->id_rekap )
                                        <tr class=" toggler">
                                            <td></td>
                                            <td>{{ $itemmA->uraian_rekaprincian  }}</td>
                                            <td></td>
                                            <td style="text-align: right">{{ number_format($itemmA->nilai_a, 0, '.', ',') }}</td>
                                            <td></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            @foreach($rekapb as $key => $itemm)
                                @if ($itemss == $itemm->id_rekap )
                                    <tbody>
                                        @php
                                            $Nilai2 = $itemm->id;
                                        @endphp
                                            @foreach($NilaiHasilRekapB as $key => $Bulanbaru)
                                            @if ($Nilai2 == $Bulanbaru->id_rekaprincian )
                                            <tr class=" tbtn" style="background: darkgray; color: #ffff;">
                                                <td></td>
                                                <td>{{ $itemm->uraian_rekaprincian  }}</td>
                                                <td></td>
                                                <td style="text-align: right">{{ number_format($Bulanbaru->nilai_rinciansub, 0, '.', ',') }}</td>
                                                <td></td>
                                            </tr>
                                            @endif
                                            @endforeach

                                        @php
                                            $itemssa = $itemm->id;
                                        @endphp
                                    @foreach($HasilRekapB as $key => $itemms)
                                        @if ($itemssa == $itemms->id_rekaprincian )
                                            <tr class="toggler">
                                                <td></td>
                                                <td>{{ $itemms->kode_rekaprincianc  }}, {{ $itemms->uraian_rekaprincianc  }}</td>
                                                <td style="text-align: right">{{ number_format($itemms->nilai_sp2d, 0, '.', ',') }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                @endif
                            @endforeach
                            {{-- </tbody> --}}
                        @endforeach
                    @endif
                </tbody>
                <tbody style="background: rgb(121, 115, 115); color: #ffff;">
                    <tr style="background: rgb(121, 115, 115); color: #ffff;">
                        <th style="10px"></th>
                        <td colspan="3">Saldo Rek. Koran Per {{ old('text',$SaldoRekKoran->tgl_saldo) }}</td>
                        <td style="text-align: right"> {{ number_format($total1 = $SaldoRekKoran->nilai_saldorekkoran + $countdebet->sum('nilai_rincian') - $countkredit->sum('nilai_rincian') + $countdebet->sum('nilai_rinciansub') - $countkredit->sum('nilai_rinciansub'), 0, '.', ',') }}</td>
                    </tr>
                    <tr style="background: rgb(121, 115, 115); color: #ffff;">
                        <th style="10px"></th>
                        <td colspan="3">Saldo Buku Per {{ old('text',$SaldoRekKoran->tgl_saldo) }}</td>
                        @if ($bulan == 'January')
                        <td style="text-align: right"> {{ number_format($total2 = $SaldoRekKoranJanuary->nilai_saldoawal + $bkudebetJanuary->sum('nilai_sts') - $bkukreditJanuary->sum('nilai_sp2d'), 0, '.', ',') }}</td>
                        @elseif ($bulan == 'February')
                        <td style="text-align: right"> {{ number_format($total2 = $SaldoRekKoranJanuary->nilai_saldoawal + $bkudebetJanuary->sum('nilai_sts') - $bkukreditJanuary->sum('nilai_sp2d') + $bkudebetFebruary->sum('nilai_sts') - $bkukreditFebruary->sum('nilai_sp2d'), 0, '.', ',') }}</td>
                        @elseif ($bulan == 'March')
                        <td style="text-align: right"> {{ number_format($total2 = $SaldoRekKoranJanuary->nilai_saldoawal + $bkudebetJanuary->sum('nilai_sts') - $bkukreditJanuary->sum('nilai_sp2d') + $bkudebetFebruary->sum('nilai_sts') - $bkukreditFebruary->sum('nilai_sp2d') + $bkudebetMarch->sum('nilai_sts') - $bkukreditMarch->sum('nilai_sp2d'), 0, '.', ',') }}</td>
                        @elseif ($bulan == 'April')
                        <td style="text-align: right"> {{ number_format($total2 = $SaldoRekKoranJanuary->nilai_saldoawal + $bkudebetJanuary->sum('nilai_sts') - $bkukreditJanuary->sum('nilai_sp2d') + $bkudebetFebruary->sum('nilai_sts') - $bkukreditFebruary->sum('nilai_sp2d') + $bkudebetMarch->sum('nilai_sts') - $bkukreditMarch->sum('nilai_sp2d') + $bkudebetApril->sum('nilai_sts') - $bkukreditApril->sum('nilai_sp2d'), 0, '.', ',') }}</td>
                        @elseif ($bulan == 'May')
                        <td style="text-align: right"> {{ number_format($total2 = $SaldoRekKoranJanuary->nilai_saldoawal + $bkudebetJanuary->sum('nilai_sts') - $bkukreditJanuary->sum('nilai_sp2d') + $bkudebetFebruary->sum('nilai_sts') - $bkukreditFebruary->sum('nilai_sp2d') + $bkudebetMarch->sum('nilai_sts') - $bkukreditMarch->sum('nilai_sp2d') + $bkudebetApril->sum('nilai_sts') - $bkukreditApril->sum('nilai_sp2d') + $bkudebetMay->sum('nilai_sts') - $bkukreditMay->sum('nilai_sp2d'), 0, '.', ',') }}</td>
                        @elseif ($bulan == 'June')
                        <td style="text-align: right"> {{ number_format($total2 = $SaldoRekKoranJanuary->nilai_saldoawal + $bkudebetJanuary->sum('nilai_sts') - $bkukreditJanuary->sum('nilai_sp2d') + $bkudebetFebruary->sum('nilai_sts') - $bkukreditFebruary->sum('nilai_sp2d') + $bkudebetMarch->sum('nilai_sts') - $bkukreditMarch->sum('nilai_sp2d') + $bkudebetApril->sum('nilai_sts') - $bkukreditApril->sum('nilai_sp2d') + $bkudebetMay->sum('nilai_sts') - $bkukreditMay->sum('nilai_sp2d') + $bkudebetJune->sum('nilai_sts') - $bkukreditJune->sum('nilai_sp2d'), 0, '.', ',') }}</td>
                        @elseif ($bulan == 'July')
                        <td style="text-align: right"> {{ number_format($total2 = $SaldoRekKoranJanuary->nilai_saldoawal + $bkudebetJanuary->sum('nilai_sts') - $bkukreditJanuary->sum('nilai_sp2d') + $bkudebetFebruary->sum('nilai_sts') - $bkukreditFebruary->sum('nilai_sp2d') + $bkudebetMarch->sum('nilai_sts') - $bkukreditMarch->sum('nilai_sp2d') + $bkudebetApril->sum('nilai_sts') - $bkukreditApril->sum('nilai_sp2d') + $bkudebetMay->sum('nilai_sts') - $bkukreditMay->sum('nilai_sp2d') + $bkudebetJune->sum('nilai_sts') - $bkukreditJune->sum('nilai_sp2d') + $bkudebetAugust->sum('nilai_sts') - $bkukreditAugust->sum('nilai_sp2d'), 0, '.', ',') }}</td>
                        @elseif ($bulan == 'September')
                        <td style="text-align: right"> {{ number_format($total2 = $SaldoRekKoranJanuary->nilai_saldoawal + $bkudebetJanuary->sum('nilai_sts') - $bkukreditJanuary->sum('nilai_sp2d') + $bkudebetFebruary->sum('nilai_sts') - $bkukreditFebruary->sum('nilai_sp2d') + $bkudebetMarch->sum('nilai_sts') - $bkukreditMarch->sum('nilai_sp2d') + $bkudebetApril->sum('nilai_sts') - $bkukreditApril->sum('nilai_sp2d') + $bkudebetMay->sum('nilai_sts') - $bkukreditMay->sum('nilai_sp2d') + $bkudebetJune->sum('nilai_sts') - $bkukreditJune->sum('nilai_sp2d') + $bkudebetAugust->sum('nilai_sts') - $bkukreditAugust->sum('nilai_sp2d') + $bkudebetSeptember->sum('nilai_sts') - $bkukreditSeptember->sum('nilai_sp2d'), 0, '.', ',') }}</td>
                        @elseif ($bulan == 'October')
                        <td style="text-align: right"> {{ number_format($total2 = $SaldoRekKoranJanuary->nilai_saldoawal + $bkudebetJanuary->sum('nilai_sts') - $bkukreditJanuary->sum('nilai_sp2d') + $bkudebetFebruary->sum('nilai_sts') - $bkukreditFebruary->sum('nilai_sp2d') + $bkudebetMarch->sum('nilai_sts') - $bkukreditMarch->sum('nilai_sp2d') + $bkudebetApril->sum('nilai_sts') - $bkukreditApril->sum('nilai_sp2d') + $bkudebetMay->sum('nilai_sts') - $bkukreditMay->sum('nilai_sp2d') + $bkudebetJune->sum('nilai_sts') - $bkukreditJune->sum('nilai_sp2d') + $bkudebetAugust->sum('nilai_sts') - $bkukreditAugust->sum('nilai_sp2d') + $bkudebetSeptember->sum('nilai_sts') - $bkukreditSeptember->sum('nilai_sp2d') + $bkudebetOctober->sum('nilai_sts') - $bkukreditOctober->sum('nilai_sp2d'), 0, '.', ',') }}</td>
                        @elseif ($bulan == 'November')
                        <td style="text-align: right"> {{ number_format($total2 = $SaldoRekKoranJanuary->nilai_saldoawal + $bkudebetJanuary->sum('nilai_sts') - $bkukreditJanuary->sum('nilai_sp2d') + $bkudebetFebruary->sum('nilai_sts') - $bkukreditFebruary->sum('nilai_sp2d') + $bkudebetMarch->sum('nilai_sts') - $bkukreditMarch->sum('nilai_sp2d') + $bkudebetApril->sum('nilai_sts') - $bkukreditApril->sum('nilai_sp2d') + $bkudebetMay->sum('nilai_sts') - $bkukreditMay->sum('nilai_sp2d') + $bkudebetJune->sum('nilai_sts') - $bkukreditJune->sum('nilai_sp2d') + $bkudebetAugust->sum('nilai_sts') - $bkukreditAugust->sum('nilai_sp2d') + $bkudebetSeptember->sum('nilai_sts') - $bkukreditSeptember->sum('nilai_sp2d') + $bkudebetOctober->sum('nilai_sts') - $bkukreditOctober->sum('nilai_sp2d') + $bkudebetNovember->sum('nilai_sts') - $bkukreditNovember->sum('nilai_sp2d'), 0, '.', ',') }}</td>
                        @elseif ($bulan == 'December')
                        <td style="text-align: right"> {{ number_format($total2 = $SaldoRekKoranJanuary->nilai_saldoawal + $bkudebetJanuary->sum('nilai_sts') - $bkukreditJanuary->sum('nilai_sp2d') + $bkudebetFebruary->sum('nilai_sts') - $bkukreditFebruary->sum('nilai_sp2d') + $bkudebetMarch->sum('nilai_sts') - $bkukreditMarch->sum('nilai_sp2d') + $bkudebetApril->sum('nilai_sts') - $bkukreditApril->sum('nilai_sp2d') + $bkudebetMay->sum('nilai_sts') - $bkukreditMay->sum('nilai_sp2d') + $bkudebetJune->sum('nilai_sts') - $bkukreditJune->sum('nilai_sp2d') + $bkudebetAugust->sum('nilai_sts') - $bkukreditAugust->sum('nilai_sp2d') + $bkudebetSeptember->sum('nilai_sts') - $bkukreditSeptember->sum('nilai_sp2d') + $bkudebetOctober->sum('nilai_sts') - $bkukreditOctober->sum('nilai_sp2d') + $bkudebetNovember->sum('nilai_sts') - $bkukreditNovember->sum('nilai_sp2d') + $bkudebetDecember->sum('nilai_sts') - $bkukreditDecember->sum('nilai_sp2d'), 0, '.', ',') }}</td>
                        @else
                        <td style="text-align: right"> {{ number_format($total2, 0, '.', ',') }}</td>
                        @endif
                    </tr>
                    <tr style="background: rgb(121, 115, 115); color: #ffff;">
                        <th style="10px"></th>
                        <td colspan="3">Selisih</td>
                        <td style="text-align: right"> {{ number_format($total = $total1 - $total2, 0, '.', ',') }}</td>
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
