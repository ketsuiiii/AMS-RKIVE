
@props(['name', 'label', 'options', 'valueId'])

<label class="form-label">{{ $label }}</label>

<select {{ $attributes }} name="{{ $name }}" class="form-select">
    @foreach ($options as $option)
        <option value="{{ $option->$valueId }}">{{ $option->first_name.' '. $option->last_name }}</option>
    @endforeach
</select>

<span class="text-danger">
    @error($name)
        {{ $message }}
    @enderror
</span>
