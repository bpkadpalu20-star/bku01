
<input type="hidden" name="create_id" id="create_id" value="{{ old('name',$rincian->id) }}">
<input type="hidden" name="create_bulan_id" id="create_bulan_id" value="{{ old('name',$rincian->bulan_id) }}">
<input type="hidden" name="create_id_opd" id="create_id_opd" value="{{ old('name',$rincian->id_opd) }}">
<input type="hidden" name="create_akun" id="create_akun" value="{{ old('name',$rincian->id_akun) }}">
<input type="hidden" name="create_kelompok" id="create_kelompok" value="{{ old('name',$rincian->id_kelompok) }}">
<input type="hidden" name="create_jenis" id="create_jenis" value="{{ old('name',$rincian->kd_jenis) }}">
<input type="hidden" name="create_Objek" id="create_Objek" value="{{ old('name',$rincian->kd_objek) }}">
<input type="hidden" name="create_rincianObjek" id="create_rincianObjek" value="{{ old('name',$rincian->kd_rincianobjek) }}">
<input type="hidden" name="create_subrincianObjek" id="create_subrincianObjek" value="{{ old('name',$rincian->kd_subrincianobjek) }}">
<div class="col-xl-12 mb-3">
    <p class="lh-1 text-break mb-0" style="text-align: justify">{{ old('name',$subrincianobjek->kode_subrincianobjek) }} : {{ old('name',$subrincianobjek->uraian_subrincianobjek) }}</p>
</div>
<div class="col-xl-12 mb-3">
    <label for="input-label" class="form-label">Niai Pagu Penerimaan:</label>
    <input type="text" class="form-control" id="create_nilapagu" name="create_nilapagu" placeholder="Enter Kode" value="{{ number_format($rincian->nilai_paguopd, 0, '.', ',') }}" style="text-align: right;">
    <div class="alert alert-danger print-error-msg" id="alert-create_nilapagu" style="display:none">
        <ul></ul>
    </div>
</div>
<div class="col-xl-12 mb-3">
    <label for="input-label" class="form-label">Niai Realisasi Penerimaan:</label>
    <input type="text" class="form-control" id="create_nilai_realisasi" name="create_nilai_realisasi" placeholder="Enter Kode" value="{{ number_format($rincian->nilai_realisasiopd, 0, '.', ',') }}" style="text-align: right;" readonly>
    <div class="alert alert-danger print-error-msg" id="alert-create_nilai_realisasi" style="display:none">
        <ul></ul>
    </div>
</div>
<script type="text/javascript">

var input = document.getElementById('create_nilapagu');
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

    $('#create_nilapagu').val(bilangan);


});
var nialimines = $("#create_nilapagu").val();
var tanpa_rupiah = document.getElementById('create_nilapagu');
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
