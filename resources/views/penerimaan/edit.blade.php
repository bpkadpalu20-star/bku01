<link rel="stylesheet" href="../assets/libs/prismjs/themes/prism-coy.min.css">
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('assets/js/select2.js')}}"></script>

<div class="row gy-6">
<input type="hidden" name="edit_BKUAkun1" id="edit_BKUAkun1" value="{{ old('name',$KodeRekening->kd_akun) }}">
<input type="hidden" name="edit_BKUKelompok1" id="edit_BKUKelompok1" value="{{ old('name',$KodeRekening->kd_kelompok) }}">
<input type="hidden" name="edit_BKUJenis1" id="edit_BKUJenis1" value="{{ old('name',$KodeRekening->kd_jenis) }}">
<input type="hidden" name="edit_BKUObjek1" id="edit_BKUObjek1" value="{{ old('name',$KodeRekening->kd_objek) }}">
<input type="hidden" name="edit_BKURincianobjek1" id="edit_BKURincianobjek1" value="{{ old('name',$KodeRekening->kd_rincianobjek) }}">
<input type="hidden" name="edit_Subrincianobjek1" id="edit_Subrincianobjek1" value="{{ old('name',$KodeRekening->id) }}">

<input type="hidden" name="edit_id_opd1" id="edit_id_opd1" value="{{ old('name',$BkuPenerimaan->id_opd) }}">
<input type="hidden" name="edit_bulan_id" id="edit_bulan_id" value="{{ old('name',$BkuPenerimaan->bulan_id) }}">
<input type="hidden" name="edit_bulan1" id="edit_bulan1" value="{{ old('name',$BkuPenerimaan->bulan) }}">
<input type="hidden" name="edit_penerimaan_id" id="edit_penerimaan_id" value="{{ old('name',$BkuPenerimaan->id) }}">
    <div class="col-xl-6">
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Tanggal Kas</label>
            <input type="text" class="form-control" data-provide="datepicker" value="{{old('tanggal_bku') ? old('tanggal_bku') : Carbon\Carbon::parse($BkuPenerimaan->tanggal_bku)->isoFormat('MM/DD/YYYY')}}" id="edit_tanggal_bku" name="edit_tanggal_bku" data-date-autoclose="true">
            <div class="alert alert-danger print-error-msg" id="alert-edit_tanggal_bku" style="display:none">
                <ul></ul>
            </div>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">No STS</label>
            <input type="hidden" class="form-control" value="{{ old('name',$BkuPenerimaan->no_bku) }}" id="edit_baru_sts" name="edit_baru_sts" placeholder="Enter Kode" value="">
            <input type="text" class="form-control" value="{{ old('name',$BkuPenerimaan->no_bku) }}" id="edit_no_bku" name="edit_no_bku" placeholder="Enter Kode" value="">
            <div class="alert alert-danger print-error-msg" id="alert-edit_no_bku" style="display:none">
                <ul></ul>
            </div>
            <div class="alert alert-danger print-error-msg" id="alert-double_no_bku" style="display:none">
                <ul></ul>
            </div>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Tanggal STS</label>
            <input type="text"  class="form-control" data-provide="datepicker" value="{{old('tgl_sts') ? old('tgl_sts') : Carbon\Carbon::parse($BkuPenerimaan->tgl_sts)->isoFormat('MM/DD/YYYY')}}" id="edit_tgl_sts" name="edit_tgl_sts" data-date-autoclose="true">
            <div class="alert alert-danger print-error-msg" id="alert-edit_tgl_sts" style="display:none">
                <ul></ul>
            </div>

        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">OPD:</label>
            <select class="form-control" name="edit_id_opd" id="edit_id_opd" style="width: 400px">
                @foreach($opd as $skpd1)
                    <option value="{{ $skpd1->id }}" {{ old('id_opd', $BkuPenerimaan->id_opd) == $skpd1->id ? 'selected' : null}}
                        @if(old('edit_id_opd',$skpd1->uraian_skpd) == $skpd1->id) selected @endif >
                        {{ $skpd1->uraian_skpd }}
                    </option>
                @endforeach
            </select>
            <div class="alert alert-danger print-error-msg" id="alert-edit_id_opd" style="display:none">
                <ul></ul>
            </div>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Bank:</label>
            <select class="form-control" name="edit_id_bank" id="edit_id_bank" style="width: 400px">
                @foreach($bank as $bank1)
                    <option value="{{ $bank1->id }}" {{ old('id_bank', $BkuPenerimaan->id_bank) == $bank1->id ? 'selected' : null}}
                        @if(old('edit_id_bank',$bank1->uraian_bank) == $bank1->id) selected @endif >
                        {{ $bank1->uraian_bank }}
                    </option>
                @endforeach
            </select>
            <div class="alert alert-danger print-error-msg" id="alert-edit_id_bank" style="display:none">
                <ul></ul>
            </div>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Niai:</label>
            <input type="text" class="form-control" value="{{ old('name',number_format($BkuPenerimaan->nilai_sts, 0, ',', '.')) }}" id="edit_nilai_sts" name="edit_nilai_sts" placeholder="Enter Kode" value="" style="text-align: right;">
            <div class="alert alert-danger print-error-msg" id="alert-edit_nilai_sts" style="display:none">
                <ul></ul>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Rekening Akun</label>
            <select name="edit_akun" id="edit_akun" class="form-control"  style="width: 400px">
                <option value="">Select Akun</option>
                @foreach($BkuAkun as $row3)
                    <option value="{{ $row3->id_akun }}" {{ old('id_akun', $Subrincianobjek->id_akun) == $row3->id_akun ? 'selected' : null}}
                        @if(old('edit_akun',$row3->uraian_akun) == $row3->id_akun) selected @endif >
                        {{ $row3->uraian_akun }}
                    </option>
                @endforeach
            </select>
            <div class="alert alert-danger print-error-msg" id="alert-edit_akun" style="display:none">
                <ul></ul>
            </div>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Rekening kelompok</label>
                <select class="form-control" name="edit_kelompok" id="edit_kelompok" style="width: 400px">
                    <option value="">Select Kelompok</option>
                </select>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Rekening Jenis</label>
                <select class="form-control" name="edit_jenis" id="edit_jenis" style="width: 400px">
                    <option>Select Jenis</option>
                </select>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Rekening Objek</label>
                <select class="form-control" name="edit_Objek" id="edit_Objek" style="width: 400px">
                    <option>Select Objek</option>
                </select>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Rekening Rincian Objek</label>
                <select class="form-control" name="edit_rincianobjek" id="edit_rincianobjek" style="width: 400px">
                    <option>Select Rincian Objek</option>
                </select>
        </div>
        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
            <label for="input-label" class="form-label">Rekening Sub Rincian Objek</label>
                <select class="form-control" name="edit_subrincianObjek" id="edit_subrincianObjek" style="width: 400px">
                    <option value="">Select Sub Rincian Objek</option>
                </select>
                <div class="alert alert-danger print-error-msg" id="alert-edit_subrincianObjek" style="display:none">
                    <ul></ul>
                </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mb-3">
        <label for="input-label" class="form-label">Uraian:</label>
        <textarea class="form-control" id="edit_uraian_bku" rows="2" name="edit_uraian_bku" placeholder="Enter Name" value="">{{ old('name',$BkuPenerimaan->uraian_bku) }}</textarea>
        <div class="alert alert-danger print-error-msg" id="alert-edit_uraian_bku" style="display:none">
            <ul></ul>
        </div>
    </div>
</div>
<script type="text/javascript">
$('#edit_kode_subrincianobjek').select2({
        dropdownParent: $('#ajaxModelupdate')
});
$('#edit_id_opd').select2({
        dropdownParent: $('#ajaxModelupdate')
});
$('#edit_id_bank').select2({
        dropdownParent: $('#ajaxModelupdate')
});
$('#edit_akun').select2({
        dropdownParent: $('#ajaxModelupdate')
});
$('#edit_kelompok').select2({
        dropdownParent: $('#ajaxModelupdate')
});
$('#edit_jenis').select2({
        dropdownParent: $('#ajaxModelupdate')
});
$('#edit_Objek').select2({
        dropdownParent: $('#ajaxModelupdate')
});
$('#edit_rincianobjek').select2({
        dropdownParent: $('#ajaxModelupdate')
});
$('#edit_subrincianObjek').select2({
        dropdownParent: $('#ajaxModelupdate')
});
$('#edit_kode_subrincianobjek').select2({
        dropdownParent: $('#ajaxModelupdate')
});
</script>
<script>

    var rupiah = document.getElementById('edit_nilai_sts');
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
    $(document).ready(function () {
        var penerimaan_id = $('#edit_penerimaan_id').val();
        $.ajax({
            url: "{{ route('bku-penerimaan.index') }}" +'/' + penerimaan_id +'/kelompok',
            type: "GET",
            data: 'penerimaan_id=' + penerimaan_id,
            success: function (response) {
                $('#edit_kelompok').html(response);//menampilkan data ke dalam modal
                $('select[name="edit_jenis"]').empty();
                        $('select[name="edit_jenis"]').append('<option value="Choose">Select Jenis</option>');
                        $('select[name="edit_Objek"]').empty();
                        $('select[name="edit_Objek"]').append('<option value="Choose">Select Objek</option>');
                        $('select[name="edit_rincianobjek"]').empty();
                        $('select[name="edit_rincianobjek"]').append('<option value="Choose">Select Rincian Objek</option>');
                        $('select[name="edit_subrincianObjek"]').empty();
                        $('select[name="edit_subrincianObjek"]').append('<option value="Choose">Select Sub Rincian Objek</option>');
            }
        });
    });

    $('#edit_akun').on('keyup change', function () {
                var kelompok_id = this.value;
                $("#edit_kelompok").html('');
                $("#edit_jenis").html('');
                $("#edit_Objek").html('');
                $("#edit_rincianobjek").html('');
                $("#edit_subrincianObjek").html('');
                $.ajax({
                    url: "{{ route('bku-penerimaan.index') }}" +'/' + kelompok_id +'/kelompok',
                    type: "GET",
                    // data: 'kelompok_id=' + kelompok_id,
                    data: {
                        kelompok_id: kelompok_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (response) {
                        // $('#edit_kelompok').html(data);//menampilkan data ke dalam modal
                        $('select[name="edit_kelompok"]').empty();
                        $('select[name="edit_kelompok"]').append('<option value="Choose">Select Kelompok</option>');
                        $.each(response.kelompok, function (key, value) {
                            $('select[name="edit_kelompok"]').append('<option value="' + value.id + '">' + value.kode_kelompok + " | " + value.uraian_kelompok  + '</option>');
                        });
                        $('select[name="edit_jenis"]').empty();
                        $('select[name="edit_jenis"]').append('<option value="Choose">Select Jenis</option>');
                        $('select[name="edit_Objek"]').empty();
                        $('select[name="edit_Objek"]').append('<option value="Choose">Select Objek</option>');
                        $('select[name="edit_rincianobjek"]').empty();
                        $('select[name="edit_rincianobjek"]').append('<option value="Choose">Select Rincian Objek</option>');
                        $('select[name="edit_subrincianObjek"]').empty();
                        $('select[name="edit_subrincianObjek"]').append('<option value="Choose">Select Sub Rincian Objek</option>');
                    }
                });
    });
    $(document).ready(function () {
        var penerimaan_id = $('#edit_penerimaan_id').val();
        $.ajax({
            url: "{{ route('bku-penerimaan.index') }}" +'/' + penerimaan_id +'/jenis',
            type: "GET",
            data: 'penerimaan_id=' + penerimaan_id,
            success: function (response) {
                $('#edit_jenis').html(response);//menampilkan data ke dalam modal
            }
        });
    });
    $('#edit_kelompok').on('change', function () {
        var kelompok_id = $('select[name=edit_kelompok]').val();
        var jenis_id = this.value;
        $("#edit_jenis").html('');
        $("#edit_Objek").html('');
        $("#edit_rincianobjek").html('');
        $("#edit_subrincianObjek").html('');
        $.ajax({
            url: "{{ route('bku-penerimaan.index') }}" +'/' + jenis_id +'/jenis',
            type: "GET",
            data: {
                jenis_id: jenis_id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (response) {
                $('select[name="edit_jenis"]').empty();
                $('select[name="edit_jenis"]').append('<option value="Choose">Select Jenis</option>');
                $.each(response.jenis, function (key, value) {
                    $('select[name="edit_jenis"]').append('<option value="' + value.id + '">' + value.kode_jenis + " | " + value.uraian_jenis  + '</option>');
                });
                $('select[name="edit_Objek"]').empty();
                $('select[name="edit_Objek"]').append('<option value="Choose">Select Objek</option>');
                $('select[name="edit_rincianobjek"]').empty();
                $('select[name="edit_rincianobjek"]').append('<option value="Choose">Select Rincian Objek</option>');
                $('select[name="edit_subrincianObjek"]').empty();
                $('select[name="edit_subrincianObjek"]').append('<option value="Choose">Select Sub Rincian Objek</option>');
            }
        });
    });
    $(document).ready(function () {
        var penerimaan_id = $('#edit_penerimaan_id').val();
        $.ajax({
            url: "{{ route('bku-penerimaan.index') }}" +'/' + penerimaan_id +'/objek',
            type: "GET",
            data: 'penerimaan_id=' + penerimaan_id,
            success: function (response) {
                $('#edit_Objek').html(response);//menampilkan data ke dalam modal
            }
        });
    });
    $('#edit_jenis').on('change', function () {
        var Objek_id = this.value;
        $("#edit_Objek").html('');
        $("#edit_rincianobjek").html('');
        $("#edit_subrincianObjek").html('');
        $.ajax({
            url: "{{ route('bku-penerimaan.index') }}" +'/' + Objek_id +'/objek',
            type: "GET",
            data: {
                Objek_id: Objek_id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (response) {
                $('select[name="edit_Objek"]').empty();
                $('select[name="edit_Objek"]').append('<option value="Choose">Select Objek</option>');
                $.each(response.objek, function (key, value) {
                    $('select[name="edit_Objek"]').append('<option value="' + value.id + '">' + value.kode_objek + " | " + value.uraian_objek  + '</option>');
                });
                $('select[name="edit_rincianobjek"]').empty();
                $('select[name="edit_rincianobjek"]').append('<option value="Choose">Select Rincian Objek</option>');
                $('select[name="edit_subrincianObjek"]').empty();
                $('select[name="edit_subrincianObjek"]').append('<option value="Choose">Select Sub Rincian Objek</option>');
            }
        });
    });
    $(document).ready(function () {
        var penerimaan_id = $('#edit_penerimaan_id').val();
        $.ajax({
            url: "{{ route('bku-penerimaan.index') }}" +'/' + penerimaan_id +'/rincian_objek',
            type: "GET",
            data: 'penerimaan_id=' + penerimaan_id,
            success: function (response) {
                $('#edit_rincianobjek').html(response);//menampilkan data ke dalam modal
            }
        });
    });
    $('#edit_Objek').on('change', function () {
        var rincian_objek_id = this.value;
        $("#edit_rincianobjek").html('');
        $("#edit_subrincianObjek").html('');
        $.ajax({
            url: "{{ route('bku-penerimaan.index') }}" +'/' + rincian_objek_id +'/rincian_objek',
            type: "GET",
            data: {
                rincian_objek_id: rincian_objek_id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (response) {
                $('select[name="edit_rincianobjek"]').empty();
                $('select[name="edit_rincianobjek"]').append('<option value="Choose">Select Rincian Objek</option>');
                $.each(response.rincian_objek, function (key, value) {
                    $('select[name="edit_rincianobjek"]').append('<option value="' + value.id + '">' + value.kode_rincianobjek + " | " + value.uraian_rincianobjek  + '</option>');
                });
                $('select[name="edit_subrincianObjek"]').empty();
                $('select[name="edit_subrincianObjek"]').append('<option value="Choose">Select Sub Rincian Objek</option>');
            }
        });
    });
    $(document).ready(function () {
        var penerimaan_id = $('#edit_penerimaan_id').val();
        $.ajax({
            url: "{{ route('bku-penerimaan.index') }}" +'/' + penerimaan_id +'/sub_rincian_objek',
            type: "GET",
            data: 'penerimaan_id=' + penerimaan_id,
            success: function (response) {
                $('#edit_subrincianObjek').html(response);//menampilkan data ke dalam modal
            }
        });
    });
    $('#edit_rincianObjek').on('change', function () {
        var sub_rincian_objek_id = this.value;
        $("#edit_subrincianObjek").html('');
        $.ajax({
            url: "{{ route('bku-penerimaan.index') }}" +'/' + sub_rincian_objek_id +'/sub_rincian_objek',
            type: "GET",
            data: {
                sub_rincian_objek_id: sub_rincian_objek_id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (response) {
                $('select[name="edit_subrincianObjek"]').empty();
                $('select[name="edit_subrincianObjek"]').append('<option value="Choose">Select Sub Rincian Objek</option>');
                $.each(response.sub_rincianobjek, function (key, value) {
                    $('select[name="edit_subrincianObjek"]').append('<option value="' + value.id + '">' + value.kode_subrincianobjek + " | " + value.uraian_subrincianobjek  + '</option>');
                });

            }
        });
    });
});
</script>
