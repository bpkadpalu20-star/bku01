<select class="form-control" name="edit_subrincianObjek" id="edit_subrincianObjek" style="width: 400px">
            <option value="">Select Sub Rincian objek</option>
            @foreach($data5 as $row8)
                <option value="{{ $row8->id }}" {{ old('id', $KodeRekening->id) == $row8->id ? 'selected' : null}}
                    @if(old('edit_subrincianObjek',$row8->uraian_subrincianobjek) == $row8->id) selected @endif >
                    {{ $row8->kode_subrincianobjek }}  |  {{ $row8->uraian_subrincianobjek }}
                </option>
            @endforeach
</select>
