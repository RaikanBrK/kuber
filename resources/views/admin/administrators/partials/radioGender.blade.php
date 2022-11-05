<div class="form-group pb-2">
    <legend>Gênero</legend>

    @foreach($genders as $gender)
    <div class="form-check form-check-inline">
        @php ($id = str_replace(' ', '_', strtolower($gender->gender)))
        <input 
            class="form-check-input"
            type="radio" name="gender"
            id="{{ $id }}"
            value="{{ $gender->id }}"
            @if(isset($genderId))
                @checked($genderId == $gender->id)
            @elseif(isset($user))
                @checked($user->gender->id == $gender->id)
            @endif
        >
        <label class="form-check-label" for="{{ $id }}">{{ $gender->gender }}</label>
    </div>
    @endforeach
</div>
