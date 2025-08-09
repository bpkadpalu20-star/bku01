<link rel="stylesheet" href="../assets/libs/prismjs/themes/prism-coy.min.css">
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ URL::asset('assets/js/select2.js')}}"></script>
<div class="row gy-6">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">Tanggal</p>
        <input type="date" class="form-control" data-provide="datepicker" id="create_tanggal_bku" name="create_tanggal_bku" autocomplete="off" data-date-autoclose="true">
        <div class="alert alert-danger print-error-msg" id="alert-create_tanggal_bku" style="display:none">
            <ul></ul>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <p class="mb-2 text-muted">Tanggal Penguji</p>
        <input type="date"  class="form-control" data-provide="datepicker" id="create_tgl_penguji" name="create_tgl_penguji" autocomplete="off" data-date-autoclose="true">
        <div class="alert alert-danger print-error-msg" id="alert-create_tgl_penguji" style="display:none">
            <ul></ul>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">Bank</p>
        <select name="create_nama_bank" id="create_nama_bank" class="form-control" style="width: 400px">
            <option value="">Select Bank</option>
            @foreach($bank as $bank2)

            <option value="{{ $bank2->id }}">{{ $bank2->uraian_bank }}</option>

            @endforeach
        </select>
        <div class="alert alert-danger print-error-msg" id="alert-create_nama_bank" style="display:none">
            <ul></ul>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">Sumber Dana</p>
        <select name="create_sumber_dana" id="create_sumber_dana" class="form-control"  data-toggle="select2" data-trigger name="choices-single-default">
            <option value="">Select Dana</option>
            @foreach($dana as $row2)

            <option value="{{ $row2->id }}">{{ $row2->uraian_dana }}</option>

            @endforeach
        </select>
        <div class="alert alert-danger print-error-msg" id="alert-create_sumber_dana" style="display:none">
            <ul></ul>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">OPD</p>
        <select name="create_nama_opd" id="create_nama_opd" class="form-control  opdfilter" >

            <option value="">Select OPD</option>
            @foreach($opd as $skpd2)

            <option value="{{ $skpd2->id }}">{{ $skpd2->uraian_skpd }}</option>

            @endforeach
        </select>
        <div class="alert alert-danger print-error-msg" id="alert-create_nama_opd" style="display:none">
            <ul></ul>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">Niai</p>
        <input type="text" class="form-control" id="create_nilai_sp2d" name="create_nilai_sp2d" placeholder="Enter Kode" value="" style="text-align: right;">
        <div class="alert alert-danger print-error-msg" id="alert-create_nilai_sp2d" style="display:none">
            <ul></ul>
        </div>
    </div>

    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">No SP2D</p>
        <input type="text" class="form-control" id="create_no_bku" name="create_no_bku" placeholder="Enter Kode" value="">
        <div class="alert alert-danger print-error-msg" id="alert-create_no_bku" style="display:none">
            <ul></ul>
        </div>
    </div>

    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">No Penguji</p>
        <input type="text" class="form-control" id="create_no_penguji" name="create_no_penguji" placeholder="Enter Kode" value="">
        <div class="alert alert-danger print-error-msg" id="alert-create_no_penguji" style="display:none">
            <ul></ul>
        </div>
    </div>

    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">Rekanan</p>
        <input type="text" class="form-control" id="create_nama_rekanan" name="create_nama_rekanan" placeholder="Enter Kode" value="">
        <div class="alert alert-danger print-error-msg" id="alert-create_nama_rekanan" style="display:none">
            <ul></ul>
        </div>
    </div>
    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">Uraian</p>
        <textarea class="form-control" id="create_uraian_bku" rows="5" name="create_uraian_bku" placeholder="Enter Name" value=""></textarea>
        <div class="alert alert-danger print-error-msg" id="alert-create_uraian_bku" style="display:none">
            <ul></ul>
        </div>
    </div>
</div>
    <script type="text/javascript">
$(document).ready(function() {
	$('#create_nama_opd').select2({dropdownParent: $("#ajaxModelcreate")});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
$('#create_sumber_dana').select2({
        dropdownParent: $('#ajaxModelcreate')
});
$('#create_nama_opd').select2({
        dropdownParent: $('#ajaxModelcreate')
});
$('#create_nama_bank').select2({
        dropdownParent: $('#ajaxModelcreate')
});
});
 $(document).on('select2:close', '#create_sumber_dana', function(e) {
    var evt = "scroll.select2"
    $(e.target).parents().off(evt)
    $(window).off(evt)
  })
</script>
<script>

    var rupiah = document.getElementById('create_nilai_sp2d');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, '');
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
