

<input type="hidden" name="create_saldo_id" id="create_saldo_id" value="{{ old('name',$bulan) }}">
<div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
    <label for="input-label" class="form-label">Niai</label>
    <input type="text" class="form-control" id="create_nilai_saldokoran" name="create_nilai_saldokoran" placeholder="Enter Kode" value="" style="text-align: right;">
    <div class="alert alert-danger print-error-msg" id="alert-create_nilai_saldokoran" style="display:none">
        <ul></ul>
    </div>
</div>


<script type="text/javascript">
    var rupiah2 = document.getElementById('create_nilai_saldokoran');
            rupiah2.addEventListener('keyup', function(e){
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah2.value = formatRupiah(this.value, '');
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

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }

    function harusHuruf(evt){
             var charCode = (evt.which) ? evt.which : event.keyCode
             if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
                 return false;
             return true;
    }
</script>
