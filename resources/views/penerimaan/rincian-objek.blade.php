<select class="form-control" name="edit_rincianobjek" id="edit_rincianobjek" style="width: 400px">
            <option value="">Select Rincian Objek</option>
            @foreach($data4 as $row7)
                <option value="{{ $row7->id }}" {{ old('id', $KodeRekening->kd_rincianobjek) == $row7->id ? 'selected' : null}}
                    @if(old('edit_rincianobjek',$row7->uraian_rincianobjek) == $row7->id) selected @endif >
                    {{ $row7->kode_rincianobjek }}  |  {{ $row7->uraian_rincianobjek }}
                </option>
            @endforeach
</select>
