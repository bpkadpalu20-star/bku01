
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ URL::asset('assets/js/select2.js')}}"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<div class="row gy-6">
    <input type="hidden" name="edit_pengeluaran_id" id="edit_pengeluaran_id" value="{{ old('name',$BkuPengeluaran->id) }}">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">Tanggal</p>
        <input type="text" class="form-control" value="{{old('tanggal_bku') ? old('tanggal_bku') : Carbon\Carbon::parse($BkuPengeluaran->tanggal_bku)->isoFormat('MM/DD/YYYY')}}" data-provide="datepicker" id="edit_tanggal_bku" name="edit_tanggal_bku" data-date-autoclose="true">
        <div class="alert alert-danger print-error-msg" id="alert-edit_tanggal_bku" style="display:none">
            <ul></ul>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <p class="mb-2 text-muted">Tanggal Penguji</p>
        <input type="text" class="form-control" value="{{old('tgl_penguji') ? old('tgl_penguji') : Carbon\Carbon::parse($BkuPengeluaran->tgl_penguji)->isoFormat('MM/DD/YYYY')}}" data-provide="datepicker" id="edit_tgl_penguji" name="edit_tgl_penguji" data-date-autoclose="true">
        <div class="alert alert-danger print-error-msg" id="alert-edit_tgl_penguji" style="display:none">
            <ul></ul>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">Bank</p>
        <select name="edit_id_bank" id="edit_id_bank" class="form-control">
            @foreach($bank as $bank1)
                <option value="{{ $bank1->id }}" {{ old('id_bank', $BkuPengeluaran->id_bank) == $bank1->id ? 'selected' : null}}
                    @if(old('edit_id_bank',$bank1->uraian_bank) == $bank1->id) selected @endif >
                    {{ $bank1->uraian_bank }}
                </option>
            @endforeach
        </select>
        <div class="alert alert-danger print-error-msg" id="alert-edit_id_bank" style="display:none">
            <ul></ul>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">Sumber Dana</p>
        <select name="edit_id_dana" id="edit_id_dana" class="form-control">
            <option value="">Select Dana</option>
            @foreach($dana as $row1)

            <option value="{{ $BkuPengeluaran->id_dana }}" {{ old('id_dana', $BkuPengeluaran->id_dana) == $row1->id ? 'selected' : null}}>{{ $row1->uraian_dana }}</option>

            @endforeach
        </select>
        <div class="alert alert-danger print-error-msg" id="alert-edit_id_dana" style="display:none">
            <ul></ul>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">OPD</p>
        <select name="edit_id_opd" id="edit_id_opd" class="form-control  opdfilter" >

            <option value="">Select OPD</option>
             @foreach($opd as $skpd1)
                <option value="{{ $skpd1->id }}" {{ old('id_opd', $BkuPengeluaran->id_opd) == $skpd1->id ? 'selected' : null}}
                    @if(old('edit_id_opd',$skpd1->uraian_skpd) == $skpd1->id) selected @endif >
                    {{ $skpd1->uraian_skpd }}
                </option>
            @endforeach
        </select>
        <div class="alert alert-danger print-error-msg" id="alert-edit_id_opd" style="display:none">
            <ul></ul>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">Niai</p>
        <input type="text" class="form-control" value="{{ old('name',number_format($BkuPengeluaran->nilai_sp2d, 0, ',', '.')) }}" id="edit_nilai_sp2d" name="edit_nilai_sp2d" placeholder="Enter Kode" value="" style="text-align: right;">
        <div class="alert alert-danger print-error-msg" id="alert-edit_nilai_sp2d" style="display:none">
            <ul></ul>
        </div>
    </div>

    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">No SP2D</p>
        <input type="hidden" class="form-control" value="{{ old('name',$BkuPengeluaran->no_bku) }}" id="edit_baru_sp2d" name="edit_baru_sp2d" placeholder="Enter Kode" value="">
        <input type="text" class="form-control" value="{{ old('name',$BkuPengeluaran->no_bku) }}" id="edit_no_bku" name="edit_no_bku" placeholder="Enter Kode" value="">
        <div class="alert alert-danger print-error-msg" id="alert-edit_no_bku" style="display:none">
            <ul></ul>
        </div>
        <div class="alert alert-danger print-error-msg" id="alert-double_no_bku" style="display:none">
            <ul></ul>
        </div>
    </div>

    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">No Penguji</p>
        <input type="text" class="form-control" value="{{ old('name',$BkuPengeluaran->no_penguji) }}" id="edit_no_penguji" name="edit_no_penguji" placeholder="Enter Kode" value="">
        <div class="alert alert-danger print-error-msg" id="alert-edit_no_penguji" style="display:none">
            <ul></ul>
        </div>
    </div>

    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">Rekanan</p>
        <input type="text" class="form-control" value="{{ old('name',$BkuPengeluaran->nama_rekanan) }}" id="edit_nama_rekanan" name="edit_nama_rekanan" placeholder="Enter Kode" value="">
        <div class="alert alert-danger print-error-msg" id="alert-edit_nama_rekanan" style="display:none">
            <ul></ul>
        </div>
    </div>
    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
        <p class="mb-2 text-muted">Uraian</p>
        <textarea class="form-control" id="edit_uraian_bku" rows="5" name="edit_uraian_bku" placeholder="Enter Name" value="">{{ old('name',$BkuPengeluaran->uraian_bku) }}</textarea>
        <div class="alert alert-danger print-error-msg" id="alert-edit_uraian_bku" style="display:none">
            <ul></ul>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
$('#edit_id_dana').select2({
        dropdownParent: $('#ajaxModelupdate')
});
$('#edit_id_opd').select2({
        dropdownParent: $('#ajaxModelupdate')
});
$('#edit_id_bank').select2({
        dropdownParent: $('#ajaxModelupdate')
});
});
 $(document).on('select2:close', '#edit_id_dana', function(e) {
    var evt = "scroll.select2"
    $(e.target).parents().off(evt)
    $(window).off(evt)
  })
</script>
<script>

    var rupiah = document.getElementById('edit_nilai_sp2d');
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
