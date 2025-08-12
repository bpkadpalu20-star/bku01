<script src="{{ URL::asset('assets/csstable/libs/js-xlsx/xlsx.core.min.js')}}"></script>
<script src="{{ URL::asset('assets/csstable/libs/FileSaver/FileSaver.min.js')}}"></script>
<script src="{{ URL::asset('assets/csstable/tableExport.js')}}"></script>
<script src="{{ URL::asset('assets/libs/html2pdf/dist/html2pdf.bundle.min.js')}}"></script>
  <script>
    function viewPDF() {
      // Select the element to convert to PDF
      const element = document.getElementById('print');
      // Define PDF formatting options
      var opt = {
        margin: 1,
        filename: 'Rincian-BKU.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'legal', orientation: 'landscape' }
      };
      // Create and open the PDF
      let worker = html2pdf().set(opt).from(element).toPdf().output('blob')
        .then((data) => {
          let fileURL = URL.createObjectURL(data);
          window.open(fileURL);
        });
    }
  </script>
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
        <div id="print">

<div id="content" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <div class="row">
        <div class="col">
            <img src="{{ URL::asset('assets/images/logo Palu.png')}}" style="margin-top: 20px; margin-left: 40px; width: 60px; left: 60px;" alt="logo" class="desktop-logo">
        </div>
        <div class="col align-middle fw-bold text-center text-uppercase" style=" margin-top: 25px; text-align: center; font-size: 16px; font-weight: bold;">
            PEMERINTAH KOTA PALU BUKU KAS PENERIMAAN TAHUN ANGGARAN 2025 {{ old('text',$bulan) }}
        </div>
        <div class="col">
        </div>
    </div>
    <br/>

    <table id="countries">
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
</div> <!-- end card -->
<script type="text/javascript">


    $('body').on('click', '.printbaru', function (e) {
        e.preventDefault();
        var cari_bulan = $("#cari_bulan").val();
        var tampil = '1';
        $.ajax({
            url: "{{ route('laporan.rincianbku.index') }}" +'/' + tampil +'/tampilcetak',
            type: "GET",
            data: 'cari_bulan=' + cari_bulan,
            success: function (data) {

            var contents = data;


            var idname = name;


            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-2000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            frameDoc.document.write('<html><head><title></title>');

            frameDoc.document.write('<style>table {  border-collapse: collapse; border-spacing: 0; width: 100%; size: Legal landscape;} .table td, .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th{ padding:8px 18px;  } .table-bordered, .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {     border: 1px solid #e2e2e2;} </style>');

            // your title
            frameDoc.document.title = "SIBKU";


            frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
            $('.cetakbku').html(data);//menampilkan data ke dalam modal

            }
         });

    });
    // $('body').on('click', '.pdfbaru', function () {
    //     var cari_bulan = $("#cari_bulan").val();
    //     var tampil = '1';
    //     $.ajax({
    //         url: "{{ route('laporan.rincianbku.index') }}" +'/' + tampil +'/cetakpdf',
    //         type: "GET",
    //         data: 'cari_bulan=' + cari_bulan,
    //         contentType: 'application/pdf',
    //         success: function (data) {
    //             // $('.cetakbku').html(data);//menampilkan data ke dalam modal
    //             // window.open(data, '_blank');
    //             // var pdfContent = document.getElementById("pdf-content").innerHTML;
    //             // var WinPrint = window.open("data:application/pdf,", '', 'width=900,height=650');
    //             // var WinPrint = window.open();
    //             // WinPrint.document.write(data);
    //             // WinPrint.document.close();
    //             // WinPrint.focus();
    //             // WinPrint.print();
    //             // WinPrint.close();



    //                 }
    //      });

    // });
    const download_button =
            document.getElementById('download_Btn');
        const content =
            document.getElementById('content');

        download_button.addEventListener
            ('click', async function () {
                const filename = 'table_data.pdf';

                try {
                    const opt = {
                        margin: 1,
                        filename: filename,
                        // image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2 },
                        jsPDF: {
                            unit: 'in', format: 'legal',
                            orientation: 'landscape'
                        }
                    };
                    await html2pdf().set(opt).
                        from(content).save();
                } catch (error) {
                    console.error('Error:', error.message);
                }
            });
</script>
