<script src="{{ URL::asset('assets/csstable/libs/js-xlsx/xlsx.core.min.js')}}"></script>
<script src="{{ URL::asset('assets/csstable/libs/FileSaver/FileSaver.min.js')}}"></script>
<script src="{{ URL::asset('assets/csstable/tableExport.js')}}"></script>
<script src=
"https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js">
    </script>
    <style>
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
</style>
<script src="{{ URL::asset('assets/csstable/libs/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ URL::asset('assets/csstable/libs/pdfmake/vfs_fonts.js')}}"></script>
<div id="content">
<div class="row">
    <div class="col">
        <img src="{{ URL::asset('assets/images/logo palu.png')}}" style="width: 90px; left: 50px;" alt="" />
    </div>
    <div class="col align-middle fw-bold text-center text-uppercase" style=" margin-top: 15px; text-align: center; font-size: 17px; font-weight: bold;">
        PEMERINTAH KOTA PALU BUKU KAS PENGELUARAN TAHUN ANGGARAN 2025 {{ old('text',$bulan) }}
    </div>
    <div class="col">
    </div>
  </div>
  <br/>
<table id="countries" class='table table-bordered dt-responsive nowrap' style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th width="60px">No</th>
            <th width="30px">Nomer SP2D</th>
            <th width="260px">Uraian SP2D</th>
            <th width="80px">Sumber Dana</th>
            <th width="80px">OPD</th>
            <th width="80px">Pihak Ketiga</th>
            <th width="80px">Bank</th>
            <th width="80px">Nilai</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total = 0;
        @endphp
        @if ($BkuPengeluaran->isNotEmpty())
        @foreach ($BkuPengeluaran as $Pengeluaran)
        @php
        // $total = $total + $Pengeluaran->sum('nilai_sp2d');
        @endphp
        <tr>
            <td width="60px">{{ $Pengeluaran->id_sp2d }}</td>
            <td width="30px">{{ $Pengeluaran->no_sp2d }}</td>
            <td width="260px">{{ $Pengeluaran->uraian_sp2d }}</td>
            <td width="60px">{{ $Pengeluaran->kode_dana }}</td>
            <td width="60px">{{ $Pengeluaran->singkatan }}</td>
            <td width="60px">{{ $Pengeluaran->nama_rekanan }}</td>
            <td width="60px">{{ $Pengeluaran->kode_bank }}</td>
            <td width="60px" style="text-align: right">{{ number_format($Pengeluaran->nilai_sp2d, 0, '.', ',') }}</td>

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
<script type="text/javascript">


    $('body').on('click', '.printbaru', function () {
        var cari_id_opd = $("#cari_id_opd").val();
        var cari_id_bank = $("#cari_id_bank").val();
        var cari_bulan = $("#cari_bulan").val();
        var tampil = '1';
        $.ajax({
            url: "{{ route('laporan.bkupengeluaran.index') }}" +'/' + tampil +'/tampilcetak',
            type: "GET",
            data: 'cari_id_opd=' + cari_id_opd + '&cari_id_bank=' + cari_id_bank + '&cari_bulan=' + cari_bulan,
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
            }
         });

    });
    $('body').on('click', '.pdfbaru', function () {
        var cari_id_opd = $("#cari_id_opd").val();
        var cari_id_bank = $("#cari_id_bank").val();
        var cari_bulan = $("#cari_bulan").val();
        var tampil = '1';
        $.ajax({
            url: "{{ route('laporan.bkupengeluaran.index') }}" +'/' + tampil +'/generatePDF',
            type: "GET",
            data: '&cari_id_opd=' + cari_id_opd + '&cari_id_bank=' + cari_id_bank + '&cari_bulan=' + cari_bulan,
            success: function (data) {
             $('.pdfpengeluaran').html(data);//menampilkan data ke dalam modal
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
