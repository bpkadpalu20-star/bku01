    <!-- Internal Datatables JS -->
    <script src="{{ URL::asset('assets/js/datatables.js')}}"></script>
    <!-- Datatables Cdn -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
     <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<input type="hidden" name="create_bulan" id="create_bulan" value="{{ old('name',$bulan) }}">
<input type="hidden" name="create_id_rekap" id="create_id_rekap" value="{{ old('name',$rincian->id_rekap) }}">
<input type="hidden" name="create_rincian_id" id="create_rincian_id" value="{{ old('name',$rincian->id) }}">
<div class="mb-3">
<table id="scroll-horizontal" class="table table-bordered text-nowrap w-100">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>SP2D</th>
            <th>Uraian</th>
            <th>OPD</th>
            <th>Rekanan</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        @if ($Bkus->isNotEmpty())
        @foreach ($Bkus as $Bku)
            <tr class='pilihbku' data-no_bku="{{$Bku->no_bku}}"  data-nama_bku="{{$Bku->uraian_bku}}" data-nilai_sp2d="{{number_format($Bku->nilai_sp2d, 2, ',', '.')}}" data-tanggal_bku="{{$Bku->tanggal_bku}}" data-nama_rekanan="{{$Bku->nama_rekanan}}" data-uraian_skpd="{{$Bku->uraian_skpd}}">
                <td>{{ $Bku->id_bku }}</td>
                <td>{{ \Carbon\Carbon::parse($Bku->tanggal_bku)->format('d M, Y')  }}</td>
                <td>{{ $Bku->no_bku }}</td>
                <td>{{ $Bku->uraian_bku }}</td>
                <td>{{ $Bku->uraian_skpd }}</td>
                <td>{{ $Bku->nama_rekanan }}</td>
                <td width="60px" style="text-align: right">{{ number_format($Bku->nilai_sp2d, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        @endif
    </tbody>
</table>
</div>
<div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
    <label for="input-label" class="form-label">No SP2D</label>
    <input type="text" class="form-control" id="create_no_bkurinciansub" name="create_no_bkurinciansub" placeholder="Enter Kode" value="">
    <div class="alert alert-danger print-error-msg" id="alert-create_no_bkurinciansub" style="display:none">
        <ul></ul>
    </div>
    <div class="alert alert-danger print-error-msg" id="alert-double_no_bkurinciansub" style="display:none">
        <ul></ul>
    </div>
</div>
<div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
    <label for="input-label" class="form-label">Uraian</label>
    <textarea class="form-control" id="create_uraian_bkurinciansub" rows="5" name="create_uraian_bkurinciansub" placeholder="Enter Name" value=""></textarea>
    <div class="alert alert-danger print-error-msg" id="alert-create_uraian_bkurinciansub" style="display:none">
        <ul></ul>
    </div>
</div>
<div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
    <label for="input-label" class="form-label">Niai</label>
    <input type="text" class="form-control" id="create_nilai_sp2drincian" name="create_nilai_sp2drincian" placeholder="Enter Kode" value="" style="text-align: right;">
    <div class="alert alert-danger print-error-msg" id="alert-create_nilai_sp2drincian" style="display:none">
        <ul></ul>
    </div>
</div>
<script type="text/javascript">

var input = document.getElementById('create_nilai_sp2drincian');
input.addEventListener('keydown', function(event) {
{
	key = event.which || event.keyCode;
	if ( 	key != 188 // Comma
		 && key != 8 // Backspace
         && key != 189 // Backspace
		 && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
		 && (key < 48 || key > 57) // Non digit
		 // Dan masih banyak lagi seperti tombol del, panah kiri dan kanan, tombol tab, dll
		)
	{
		event.preventDefault();
		return;
	}
}
});
$(document).on('click', '.pilihbku', function (e) {
    document.getElementById("create_no_bkurinciansub").value = $(this).attr('data-no_bku');
    // var nama_bku = $(this).attr('data-nama_bku');
    var nama_rekanan = $(this).attr('data-nama_rekanan');
    var uraian_skpd = $(this).attr('data-uraian_skpd');
	var tanggal_bku = $(this).attr('data-tanggal_bku');
    var tanggal_bku1 = moment(tanggal_bku).format('DD MMMM YYYY');
    var tanggal_bku2 = "tanggal" + " " + tanggal_bku1 + ", an. " + nama_rekanan + " " + "(" + uraian_skpd + ")";
    // $('#create_uraian_bkurinciansub').val(moment(tanggal_bku).format('DD MMMM YYYY'));
    $('#create_uraian_bkurinciansub').val(tanggal_bku2);
    ', tanggal 23 Desember 2024, Pajak Pertambahan Nilai an.  TOKO "PERKASA JAYA" (Dinas Perhubungan)'
    var bilangan = $(this).attr('data-nilai_sp2d');

    $('#create_nilai_sp2drincian').val(bilangan);


});
var nialimines = $("#create_nilai_sp2drincian").val();
var tanpa_rupiah = document.getElementById('create_nilai_sp2drincian');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
        tanpa_rupiah.value = formatRupiah(this.value);
    });


           /* Fungsi formatRupiah */
		function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');

        }
        if (nialimines == (key != 189)) {
            nilai = '-' + rupiah;
            nilai = split[1] != undefined ? nilai + ',' + split[1] : nilai;
            // rupiah2 == undefined ? '-' + rupiah1 : rupiah1;
            return prefix == undefined ? nilai : (nilai ? '' + nilai : '');
        } else {
            nilai = '' + rupiah;
            nilai = split[1] != undefined ? nilai + ',' + split[1] : nilai;
            // rupiah2 == undefined ? '-' + rupiah1 : rupiah1;
            return prefix == undefined ? nilai : (nilai ? '' + nilai : '');
        }


    }

    function harusHuruf(evt){
             var charCode = (evt.which) ? evt.which : event.keyCode
             if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
                 return false;
             return true;
    }
</script>
