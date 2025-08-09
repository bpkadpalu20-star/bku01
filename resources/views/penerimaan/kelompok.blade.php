
            <select class="form-control" name="edit_kelompok" id="edit_kelompok" style="width: 400px">
            <option value="">Select Kelompok</option>
            @foreach($data as $row6)
                <option value="{{ $row6->id }}" {{ old('id', $KodeRekening->kd_kelompok) == $row6->id ? 'selected' : null}}
                    @if(old('edit_kelompok',$row6->uraian_kelompok) == $row6->id) selected @endif >
                    {{ $row6->kode_kelompok }}  |  {{ $row6->uraian_kelompok }}
                </option>
            @endforeach
</select>
