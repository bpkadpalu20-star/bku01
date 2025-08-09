
<input type="hidden" name="create_bulan" id="create_bulan" value="{{ old('name',$bulan) }}">
<input type="hidden" name="create_rincian_id" id="create_rincian_id" value="{{ old('name',$rincian->id) }}">


<div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
    <label for="input-label" class="form-label">Uraian</label>
    <textarea class="form-control" id="create_uraian_bkurincian" rows="5" name="create_uraian_bkurincian" placeholder="Enter Name" value=""></textarea>
    <div class="alert alert-danger print-error-msg" id="alert-create_uraian_bkurincian" style="display:none">
        <ul></ul>
    </div>
</div>
<div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
    <label for="input-label" class="form-label">Niai</label>
    <input type="text" class="form-control" id="create_nilai_rincian" name="create_nilai_rincian" placeholder="Enter Kode" value="" style="text-align: right;">
    <div class="alert alert-danger print-error-msg" id="alert-create_nilai_rincian" style="display:none">
        <ul></ul>
    </div>
</div>


<script type="text/javascript">
var input = document.getElementById('create_nilai_rincian');
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
    var nialimines = $("#create_nilai_rincian").val();
    var rupiah = document.getElementById('create_nilai_rincian');
            rupiah.addEventListener('keyup', function(e){
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah.value = formatRupiah(this.value);
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
