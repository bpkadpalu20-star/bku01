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
            background-color: #f2f2f2;
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
                <thead class="thead-dark">
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
                    @if ($Bku->isNotEmpty())
                    @foreach ($Bku as $bkusatu)
                        <tr>
                            <td width="60px">{{ $bkusatu->id_bku }}</td>
                            <td width="30px">{{ $bkusatu->no_bku }}</td>
                            <td width="30px">{{ $bkusatu->tanggal_bku }}</td>
                            <td width="260px">{{ $bkusatu->uraian_bku }}</td>
                            <td width="60px">{{ $bkusatu->kode_dana }}</td>
                            <td width="60px">{{ $bkusatu->singkatan }}</td>
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

        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
