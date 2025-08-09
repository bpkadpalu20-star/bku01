<select class="form-control" name="edit_Objek" id="edit_Objek" style="width: 400px">
            <option value="">Select objek</option>
            @foreach($data3 as $row7)
                <option value="{{ $row7->id }}" {{ old('id', $KodeRekening->kd_objek) == $row7->id ? 'selected' : null}}
                    @if(old('edit_objek',$row7->uraian_objek) == $row7->id) selected @endif >
                    {{ $row7->kode_objek }}  |  {{ $row7->uraian_objek }}
                </option>
            @endforeach
</select>
