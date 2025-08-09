<!DOCTYPE html>
<html>
<head>
    <title>Laporan BKU</title>
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
                    <th >No Kas</th>
                    <th width="60px">Nomer SP2D</th>
                    <th width="560px">Uraian SP2D</th>
                    <th >Sumber Dana</th>
                    <th width="30px">OPD</th>
                    <th width="200px">Pihak Ketiga</th>
                    <th >Bank</th>
                    <th >Nilai</th>
                  </tr>
                </thead>
                <tbody>
                    @if ($BkuPengeluaran->isNotEmpty())
                    @foreach ($BkuPengeluaran as $Pengeluaran)
                        <tr>
                            <td>{{ $Pengeluaran->id_sp2d }}</td>
                            <td>{{ $Pengeluaran->no_sp2d }}</td>
                            <td>{{ $Pengeluaran->uraian_sp2d }}</td>
                            <td>{{ $Pengeluaran->kode_dana }}</td>
                            <td>{{ $Pengeluaran->singkatan }}</td>
                            <td>{{ $Pengeluaran->nama_rekanan }}</td>
                            <td>{{ $Pengeluaran->kode_bank }}</td>
                            <td style="text-align: right">{{ number_format($Pengeluaran->nilai_sp2d, 0, '.', ',') }}</td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7" style="text-align: right">Total</th>

                        <td style="text-align: right"> {{ number_format($total = $count->sum('nilai_sp2d'), 0, '.', ',') }}</td>
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
