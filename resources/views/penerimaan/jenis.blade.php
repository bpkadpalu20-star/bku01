<select class="form-control" name="edit_jenis" id="edit_jenis" style="width: 400px">
            <option value="">Select Jenis</option>
            @foreach($data2 as $row7)
                <option value="{{ $row7->id }}" {{ old('id', $KodeRekening->kd_jenis) == $row7->id ? 'selected' : null}}
                    @if(old('edit_jenis',$row7->uraian_jenis) == $row7->id) selected @endif >
                    {{ $row7->kode_jenis }}  |  {{ $row7->uraian_jenis }}
                </option>
            @endforeach
</select>
