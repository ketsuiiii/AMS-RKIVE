@props(['name', 'label', 'options', 'valueId', 'valueName', 'value'])

<label class="form-label">{{ $label }}</label>

<select {{ $attributes }} name="{{ $name }}" class="form-select">
    <option value="">Select..</option>
    @foreach ($options as $option)
        <option value="{{ $option->$valueId }}" @if($value == $option->$valueId) selected @endif>{{ $option->$valueName }}</option>
    @endforeach
</select>

<span class="text-danger">
    @error($name)
        {{ $message }}
    @enderror
</span>
