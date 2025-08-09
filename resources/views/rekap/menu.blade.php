<script type="text/javascript">
    $(document).ready(function () {
        $(".tbtn").click(function () {
            $(this).parents(".custom-table").find(".toggler1").removeClass("toggler1");
            $(this).parents("tbody").find(".toggler").addClass("toggler1");
            $(this).parents(".custom-table").find(".fa-minus-circle").removeClass("fa-minus-circle");
            $(this).parents("tbody").find(".fa-plus-circle").addClass("fa-minus-circle");
        });

        $(".tbtnrincian").click(function () {
           $(this).parents(".custom-tablerincian").find(".togglerrincian1").removeClass("togglerrincian1");
           $(this).parents(".tbodyrincian").find(".togglerrincian").addClass("togglerrincian1");
         });

    });
</script>
<table class="table table-bordered mb-0 custom-table">
    <thead style="background: rgb(121, 115, 115); color: #ffff;">
        <tr>
            <th colspan="4">Saldo Rek. Koran Per {{ old('text',$SaldoRekKoran->tgl_saldo) }}</th>
            <th style="text-align: right; font-size: 14px;">{{ number_format($SaldoRekKoran->nilai_saldorekkoran, 0, '.', ',') }}</th>
            <th  style="width: 10px; text-align: right"><button type="button" data-id="{{$bulan}}" class="btn btn-primary waves-effect waves-light buatsaldokoran">Input</button></th>
        </tr>
    </thead>
    <tbody>
        <tr style="background: rgb(125, 124, 124); color: #ffff; font-size: 14px;">
            <td></td>
            <td>Total Penerimaan</td>
            <td></td>
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
            <td></td>
        </tr>
    </tbody>
    <thead style="background: rgb(121, 115, 115); color: #ffff;">
        <tr>
            <th colspan="4">Rekonsiliasi</th>
            <th></th>
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
                            @if ($Nilai11 == 'Y')
                            <td style="width: 10px; text-align: right"><button type="button" data-id="{{$tigaa->id}}" class="btn btn-primary waves-effect waves-light buatrincian">Input</button></td>
                            @else
                            <td style="width: 10px; text-align: right"></td>
                            @endif
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
                                <td style="text-align: right"><button type="button" data-id="{{$itemmA->id}}" data-name="{{$itemmA->uraian_rekaprincian}}" data-bulan="{{$itemmA->bulan}}" class="btn btn-danger waves-effect waves-light btn-deleterincian">Hapus</button></td>
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
                                    <td style="text-align: right"><button type="button" data-id="{{$itemm->id}}" class="btn btn-primary waves-effect waves-light buatrinciansub">Input</button></td>
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
                                    <td style="text-align: right"><button type="button" data-id="{{$itemms->id}}" data-name="{{$itemms->uraian_rekaprincianc}}" data-bulan="{{$itemms->bulan}}" class="btn btn-danger waves-effect waves-light btn-deleterinciansub">Hapus</button></td>
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
    <tbody>
        <tr style="background: rgb(121, 115, 115); color: #ffff;">
            <th style="10px"></th>
            <td colspan="3">Saldo Rek. Koran Per {{ old('text',$SaldoRekKoran->tgl_saldo) }}</td>
            <td style="text-align: right"> {{ number_format($total1 = $SaldoRekKoran->nilai_saldorekkoran + $countdebet->sum('nilai_rincian') - $countkredit->sum('nilai_rincian') + $countdebet->sum('nilai_rinciansub') - $countkredit->sum('nilai_rinciansub'), 0, '.', ',') }}</td>
            <td></td>
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
            <td></td>
        </tr>
        <tr style="background: rgb(121, 115, 115); color: #ffff;">
            <th style="10px"></th>
            <td colspan="3">Selisih</td>

            <td style="text-align: right"> {{ number_format($total = $total1 - $total2, 0, '.', ',') }}</td>

            <td></td>
        </tr>
    </tbody>
</table>
<style>
    .tbtn{border:0;outline:0;background-color:transparent;font-size:15px;cursor:pointer}
    .toggler{display:none}
    .toggler1{display:table-row;}
    </style>
