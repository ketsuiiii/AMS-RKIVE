@props(['name', 'label', 'options', 'valueId', 'valueName'])

<label class="form-label">{{ $label }}</label>

<select id="select{{ $name }}" {{ $attributes }} name="{{ $name }}" class="form-select">
    <option value="">Select..</option>
    @foreach ($options as $option)
        <option value="{{ $option->$valueId }}" @if(old($name) == $option->$valueId) selected @endif>{{ $option->$valueName }}</option>
    @endforeach
</select>

<script>
    var select{{ $name }} = document.getElementById('select{{ $name }}');
    var input{{ $name }} = document.getElementById('input{{ $name }}');
    select{{ $name }}.onchange = function () {
        if (select{{ $name }}.value == 'C9') {
            input{{ $name }}.style.display = 'block';
        } else {
            input{{ $name }}.style.display = 'none';
        }
    }
</script>

<input id="input{{ $name }}" style="display:none" type="text" name="{{ $name }}" class="form-control">

<span class="text-danger">
    @error($name)
        {{ $message }}
    @enderror
</span>

