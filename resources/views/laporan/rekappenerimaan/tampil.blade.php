<script src="{{ URL::asset('assets/csstable/libs/js-xlsx/xlsx.core.min.js')}}"></script>
<script src="{{ URL::asset('assets/csstable/libs/FileSaver/FileSaver.min.js')}}"></script>
<script src="{{ URL::asset('assets/csstable/tableExport.js')}}"></script>
<script src=
"https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js">
    </script>
    <style>
.tampilan {
    padding: 0 15px 5px 15px;
    min-height: 30vh;
    font-size: 10px;
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
</style>
<script src="{{ URL::asset('assets/csstable/libs/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ URL::asset('assets/csstable/libs/pdfmake/vfs_fonts.js')}}"></script>
<div id="content" class="tampilan">
    <div class="row">
        <div class="col">
            <img src="{{ URL::asset('assets/images/logo palu.png')}}" style="width: 50px; left: 60px;" alt="" />
        </div>
        <div class="col align-middle fw-bold text-center text-uppercase" style=" margin-top: 15px; text-align: center; font-size: 13px; font-weight: bold;">
            PEMERINTAH KOTA PALU BUKU KAS PENERIMAAN TAHUN ANGGARAN 2025 {{ old('text',$bulan) }}
        </div>
        <div class="col">
        </div>
    </div>
    <br/>

    <table id="countries">
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
            @if ($Opd1->nilai_pagubulan > 0)
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
                    @if ($Kelompok->nilai_pagukelompok  > 0)
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
                            @if ($Jenis1->nilai_pagujenis  > 0)
                                @php
                                    $Jenis01 = $Jenis1->kd_jenis;
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
                                    @if ($Objek1->kd_jenis == $Jenis01)
                                    @if ($Objek1->nilai_paguobjek > 0)
                                    @php
                                        $Objek01 = $Objek1->kd_objek;
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
                                        @if ($Rincian1->kd_jenis == $Jenis01)
                                        @if ($Rincian1->kd_objek == $Objek01)
                                        @if ($Rincian1->nilai_pagurincian > 0)
                                        @php
                                            $Rincian01 = $Rincian1->kd_rincianobjek;
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
                                            @if ($SubPenerimaan1->kd_jenis == $Jenis01)
                                            @if ($SubPenerimaan1->kd_objek == $Objek01)
                                            @if ($SubPenerimaan1->kd_rincianobjek == $Rincian01)
                                            @if ($SubPenerimaan1->nilai_paguopd > 0)
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
                                            @endif
                                        @endforeach
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

                    @if ($Kelompok->id_kelompok == '2')
                    @if ($Kelompok->nilai_pagukelompok  > 0)
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
                            @if ($Jenis2->nilai_pagujenis > 0 )
                                @php
                                    $Jenis02 = $Jenis2->kd_jenis;
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
                                    @if ($Objek2->kd_jenis == $Jenis02)
                                    @if ($Objek2->nilai_paguobjek > 0 )
                                    @php
                                        $Objek02 = $Objek2->kd_objek;
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
                                        @if ($Rincian2->kd_jenis == $Jenis02)
                                        @if ($Rincian2->kd_objek == $Objek02)
                                        @if ($Rincian2->nilai_pagurincian > 0 )
                                        @php
                                            $Rincian02 = $Rincian2->kd_rincianobjek;
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
                                            @if ($SubPenerimaan2->kd_jenis == $Jenis02)
                                            @if ($SubPenerimaan2->kd_objek == $Objek02)
                                            @if ($SubPenerimaan2->kd_rincianobjek == $Rincian02)
                                            @if ($SubPenerimaan2->nilai_paguopd > 0 )
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
                                            @endif
                                        @endforeach

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

                    @if ($Kelompok->id_kelompok == '3')
                    @if ($Kelompok->nilai_pagukelompok  > 0)
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
                            @if ($Jenis3->nilai_pagujenis > 0)
                                @php
                                    $Jenis03 = $Jenis3->kd_jenis;
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
                                    @if ($Objek3->kd_jenis == $Jenis03)
                                    @if ($Objek3->nilai_paguobjek > 0)
                                    @php
                                        $Objek03 = $Objek3->kd_objek;
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
                                        @if ($Rincian3->kd_jenis == $Jenis03)
                                        @if ($Rincian3->kd_objek == $Objek03)
                                        @if ($Rincian3->nilai_pagurincian > 0)
                                        @php
                                            $Rincian03 = $Rincian3->kd_rincianobjek;
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
                                            @if ($SubPenerimaan3->kd_jenis == $Jenis03)
                                            @if ($SubPenerimaan3->kd_objek == $Objek03)
                                            @if ($SubPenerimaan3->kd_rincianobjek == $Rincian03)
                                            @if ($SubPenerimaan3->nilai_paguopd > 0)

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
                                            @endif
                                        @endforeach

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
                @endif
                @endforeach
            @endif
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
<script type="text/javascript">


    $('body').on('click', '.printbaru', function (e) {
        e.preventDefault();
        var cari_id_opd = $("#cari_id_opd").val();
        var cari_id_bank = $("#cari_id_bank").val();
        var cari_bulan = $("#cari_bulan").val();
        var cari_bku = $("#cari_bku").val();
        var cari_id_dana = $("#cari_id_dana").val();
        var tampil = '1';
        $.ajax({
            url: "{{ route('laporan.rekappenerimaan.index') }}" +'/' + tampil +'/tampilcetak',
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
            url: "{{ route('laporan.rekappenerimaan.index') }}" +'/' + tampil +'/generatePDF',
            type: "GET",
            data: 'cari_bulan=' + cari_bulan,
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
<script type="text/javascript">
    $(function () {

      /*------------------------------------------
       --------------------------------------------
       Pass Header Token
       --------------------------------------------
       --------------------------------------------*/
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      /*------------------------------------------
      --------------------------------------------
      Render DataTable
      --------------------------------------------
      --------------------------------------------*/
      var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        paging:   false,
      ordering: false,
          info:     false,
          searching: false,
        // ajax: "{{ route('laporan.rekappenerimaan.index') }}",
        ajax: {
                url: "{{ route('laporan.rekappenerimaan.index') }}",
                data: function (d) {
                    d.cari_id_opd = $('.opdfilter').val(),
                    d.cari_bulan = $('.bulanfilter').val(),
                    d.search = $('input[type="search"]').val()
                    }
            },
        columns: [
            {data: 'kode', name: 'kode'},
            {data: 'no_rekening', name: 'no_rekening'},
            {data: 'tanggal_bku', name: 'tanggal_bku'},
            {data: 'uraian_bku', name: 'uraian_bku'},
            {data: 'uraian_dana', name: 'uraian_dana'},
            {data: 'uraian_skpd', name: 'uraian_skpd'},
            // {data: 'nilai_sts',  render: $.fn.dataTable.render.number( ',', '.', 0, '' ), className: 'text-right'},
            // {data: 'nilai_sp2d',  render: $.fn.dataTable.render.number( ',', '.', 0, '' ), className: 'text-right'},
            {data: "nilai_sts", "width": "20px", "orderable": false, "render": function (data, type, row) {
                               if (row.aktif == 'Y') //Check column value "Yes"
                                return  '';
                               else
                                   return data === 0 ? 0 : $.fn.dataTable.render.number( '.', ',', 0, '','' ).display( data );
                           }
            ,className: 'text-right'},
            {data: "nilai_sp2d", "width": "20px", "orderable": false, "render": function (data, type, row) {
                               if (row.aktif == 'Y') //Check column value "Yes"
                                return  '';
                               else
                                   return data === 0 ? 0 : $.fn.dataTable.render.number( '.', ',', 0, '','' ).display( data );
                           }
            ,className: 'text-right'},
        ]
    });
});
  </script>

