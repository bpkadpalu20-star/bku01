<link rel="stylesheet" href="../assets/libs/prismjs/themes/prism-coy.min.css">
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('assets/js/select2.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<div class="row gy-6">
    <div class="col-xl-6">
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Tanggal Kas</label>
            <input type="text" class="form-control" data-provide="datepicker" id="create_tanggal_bku" name="create_tanggal_bku" data-date-autoclose="true">
            <div class="alert alert-danger print-error-msg" id="alert-create_tanggal_bku" style="display:none">
                <ul></ul>
            </div>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Tanggal STS</label>
            <input type="text"  class="form-control" data-provide="datepicker" id="create_tgl_sts" name="create_tgl_sts" data-date-autoclose="true">
            <div class="alert alert-danger print-error-msg" id="alert-create_tgl_sts" style="display:none">
                <ul></ul>
            </div>

        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">OPD</label>
            <select name="create_id_opd" id="create_id_opd" class="form-control" style="width: 400px">
                <option value="">Select OPD</option>
                @foreach($opd as $skpd2)

                <option value="{{ $skpd2->id }}">{{ $skpd2->uraian_skpd }}</option>

                @endforeach
            </select>
            <div class="alert alert-danger print-error-msg" id="alert-create_id_opd" style="display:none">
                <ul></ul>
            </div>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Bank</label>
            <select name="create_id_bank" id="create_id_bank" class="form-control" style="width: 400px">
                <option value="">Select Bank</option>
                @foreach($bank as $bank2)

                <option value="{{ $bank2->id }}">{{ $bank2->uraian_bank }}</option>

                @endforeach
            </select>
            <div class="alert alert-danger print-error-msg" id="alert-create_id_bank" style="display:none">
                <ul></ul>
            </div>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">No STS</label>
            <input type="text" class="form-control" id="create_no_bku" name="create_no_bku" placeholder="Enter Kode" value="">
            <div class="alert alert-danger print-error-msg" id="alert-create_no_bku" style="display:none">
                <ul></ul>
            </div>
            <div class="alert alert-danger print-error-msg" id="alert-double_no_bku" style="display:none">
                <ul></ul>
            </div>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Niai</label>
            <input type="text" class="form-control" id="create_nilai_sts" name="create_nilai_sts" placeholder="Enter Kode" value="" style="text-align: right;">
            <div class="alert alert-danger print-error-msg" id="alert-create_nilai_sts" style="display:none">
                <ul></ul>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Rekening Akun</label>

            <select name="create_akun" id="create_akun" class="form-control" style="width: 400px">
                <option value="">Select Akun</option>
                @foreach($BkuAkun as $row3)

                <option value="{{ $row3->id_akun }}">{{ $row3->uraian_akun }}</option>

                @endforeach
            </select>
            <div class="alert alert-danger print-error-msg" id="alert-create_akun" style="display:none">
                <ul></ul>
            </div>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Rekening kelompok</label>
                <select class="form-control" name="create_kelompok" id="create_kelompok" style="width: 400px">
                    <option>Select Kelompok</option>
                </select>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Rekening Jenis</label>
                <select class="form-control" name="create_jenis" id="create_jenis" style="width: 400px">
                    <option>Select Jenis</option>
                </select>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Rekening Objek</label>
                <select class="form-control" name="create_Objek" id="create_Objek" style="width: 400px">
                    <option>Select Objek</option>
                </select>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Rekening Rincian Objek</label>
                <select class="form-control" name="create_rincianObjek" id="create_rincianObjek" style="width: 400px">
                    <option>Select Rincian Objek</option>
                </select>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Rekening Sub Rincian Objek</label>
                <select class="form-control" name="create_subrincianObjek" id="create_subrincianObjek" style="width: 400px">
                    <option value="">Select Sub Rincian Objek</option>
                </select>
                <div class="alert alert-danger print-error-msg" id="alert-create_subrincianObjek" style="display:none">
                    <ul></ul>
                </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
        <label for="input-label"  class="control-label">Uraian</label>
        <textarea class="form-control" id="create_uraian_bku" rows="5" name="create_uraian_bku" placeholder="Enter Name" value=""></textarea>
        <div class="alert alert-danger print-error-msg" id="alert-create_uraian_bku" style="display:none">
            <ul></ul>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
$('#create_kode_subrincianobjek').select2({
        dropdownParent: $('#ajaxModelcreate')
});
$('#create_id_opd').select2({
        dropdownParent: $('#ajaxModelcreate')
});
$('#create_id_bank').select2({
        dropdownParent: $('#ajaxModelcreate')
});
$('#create_akun').select2({
        dropdownParent: $('#ajaxModelcreate')
});
$('#create_kelompok').select2({
        dropdownParent: $('#ajaxModelcreate')
});
$('#create_jenis').select2({
        dropdownParent: $('#ajaxModelcreate')
});
$('#create_Objek').select2({
        dropdownParent: $('#ajaxModelcreate')
});
$('#create_rincianObjek').select2({
        dropdownParent: $('#ajaxModelcreate')
});
$('#create_subrincianObjek').select2({
        dropdownParent: $('#ajaxModelcreate')
});
$('#create_kode_subrincianobjek').select2({
        dropdownParent: $('#ajaxModelcreate')
});
});
</script>
<script>

    var rupiah = document.getElementById('create_nilai_sts');
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

<script type="text/javascript">
$(document).ready(function () {
    $('#create_akun').on('change', function () {
                var kelompok_id = this.value;
                $("#create_kelompok").html('');
                $.ajax({
                    url: "{{ route('bku-penerimaan.index') }}" +'/' + kelompok_id +'/kelompok',
                    type: "GET",
                    data: {
                        kelompok_id: kelompok_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (response) {
                        $('select[name="create_kelompok"]').empty();
                        $('select[name="create_kelompok"]').append('<option value="Choose">Select Kelompok</option>');
                        $.each(response.kelompok, function (key, value) {
                            $('select[name="create_kelompok"]').append('<option value="' + value.id + '">' + value.kode_kelompok + " | " + value.uraian_kelompok  + '</option>');
                        });
                        $('select[name="create_jenis"]').empty();
                        $('select[name="create_jenis"]').append('<option value="Choose">Select Jenis</option>');
                        $('select[name="create_Objek"]').empty();
                        $('select[name="create_Objek"]').append('<option value="Choose">Select Objek</option>');
                        $('select[name="create_rincianObjek"]').empty();
                        $('select[name="create_rincianObjek"]').append('<option value="Choose">Select Rincian Objek</option>');
                        $('select[name="create_subrincianObjek"]').empty();
                        $('select[name="create_subrincianObjek"]').append('<option value="Choose">Select Sub Rincian Objek</option>');
                    }
                });
    });
    $('#create_kelompok').on('change', function () {
                var jenis_id = this.value;
                $("#create_jenis").html('');
                $.ajax({
                    url: "{{ route('bku-penerimaan.index') }}" +'/' + jenis_id +'/jenis',
                    type: "GET",
                    data: {
                        jenis_id: jenis_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (response) {
                        $('select[name="create_jenis"]').empty();
                        $('select[name="create_jenis"]').append('<option value="Choose">Select Jenis</option>');
                        $.each(response.jenis, function (key, value) {
                            $('select[name="create_jenis"]').append('<option value="' + value.id + '">' + value.kode_jenis + " | " + value.uraian_jenis  + '</option>');
                        });
                        $('select[name="create_Objek"]').empty();
                        $('select[name="create_Objek"]').append('<option value="Choose">Select Objek</option>');
                        $('select[name="create_rincianObjek"]').empty();
                        $('select[name="create_rincianObjek"]').append('<option value="Choose">Select Rincian Objek</option>');
                        $('select[name="create_subrincianObjek"]').empty();
                        $('select[name="create_subrincianObjek"]').append('<option value="Choose">Select Sub Rincian Objek</option>');
                    }
                });
    });
    $('#create_jenis').on('change', function () {
                var Objek_id = this.value;
                $("#create_Objek").html('');
                $.ajax({
                    url: "{{ route('bku-penerimaan.index') }}" +'/' + Objek_id +'/objek',
                    type: "GET",
                    data: {
                        Objek_id: Objek_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (response) {
                        $('select[name="create_Objek"]').empty();
                        $('select[name="create_Objek"]').append('<option value="Choose">Select Objek</option>');
                        $.each(response.objek, function (key, value) {
                            $('select[name="create_Objek"]').append('<option value="' + value.id + '">' + value.kode_objek + " | " + value.uraian_objek  + '</option>');
                        });
                        $('select[name="create_rincianObjek"]').empty();
                        $('select[name="create_rincianObjek"]').append('<option value="Choose">Select Rincian Objek</option>');
                        $('select[name="create_subrincianObjek"]').empty();
                        $('select[name="create_subrincianObjek"]').append('<option value="Choose">Select Sub Rincian Objek</option>');
                    }
                });
    });
    $('#create_Objek').on('change', function () {
                var rincian_objek_id = this.value;
                $("#create_rincianObjek").html('');
                $.ajax({
                    url: "{{ route('bku-penerimaan.index') }}" +'/' + rincian_objek_id +'/rincian_objek',
                    type: "GET",
                    data: {
                        rincian_objek_id: rincian_objek_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (response) {
                        $('select[name="create_rincianObjek"]').empty();
                        $('select[name="create_rincianObjek"]').append('<option value="Choose">Select Objek</option>');
                        $.each(response.rincian_objek, function (key, value) {
                            $('select[name="create_rincianObjek"]').append('<option value="' + value.id + '">' + value.kode_rincianobjek + " | " + value.uraian_rincianobjek  + '</option>');
                        });
                        $('select[name="create_subrincianObjek"]').empty();
                        $('select[name="create_subrincianObjek"]').append('<option value="Choose">Select Sub Rincian Objek</option>');
                    }
                });
    });
    $('#create_rincianObjek').on('change', function () {
                var sub_rincian_objek_id = this.value;
                $("#create_subrincianObjek").html('');
                $.ajax({
                    url: "{{ route('bku-penerimaan.index') }}" +'/' + sub_rincian_objek_id +'/sub_rincian_objek',
                    type: "GET",
                    data: {
                        sub_rincian_objek_id: sub_rincian_objek_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (response) {
                        $('select[name="create_subrincianObjek"]').empty();
                        $('select[name="create_subrincianObjek"]').append('<option value="Choose">Select Objek</option>');
                        $.each(response.sub_rincianobjek, function (key, value) {
                            $('select[name="create_subrincianObjek"]').append('<option value="' + value.id + '">' + value.kode_subrincianobjek + " | " + value.uraian_subrincianobjek  + '</option>');
                        });

                    }
                });
    });
});
</script>
