<script src="{{ URL::asset('assets/csstable/libs/js-xlsx/xlsx.core.min.js')}}"></script>
<script src="{{ URL::asset('assets/csstable/libs/FileSaver/FileSaver.min.js')}}"></script>
<script src="{{ URL::asset('assets/csstable/tableExport.js')}}"></script>
<div id="content" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <div class="row">
        <div class="col">
            <img src="{{ URL::asset('assets/images/logo palu.png')}}" style="margin-top: 20px; margin-left: 40px; width: 60px; left: 60px;" alt="" />
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
    $('body').on('click', '.pdfbaru', function () {
        var cari_id_opd = $("#cari_id_opd").val();
        var cari_id_bank = $("#cari_id_bank").val();
        var cari_bulan = $("#cari_bulan").val();
        var cari_bku = $("#cari_bku").val();
        var cari_id_dana = $("#cari_id_dana").val();
        var tampil = '1';
        $.ajax({
            url: "{{ route('laporan.rincianbku.index') }}" +'/' + tampil +'/generatePDF',
            type: "GET",
            data: 'cari_id_opd=' + cari_id_opd + '&cari_id_bank=' + cari_id_bank + '&cari_bulan=' + cari_bulan + '&cari_bku=' + cari_bku + '&cari_id_dana=' + cari_id_dana,
            success: function (data) {
             $('.pdfbku').html(data);//menampilkan data ke dalam modal
            }
         });

    });
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
