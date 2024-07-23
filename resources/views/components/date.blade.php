@props(['name', 'label'])

<label class="form-label">{{ $label }}</label>

<div class="input-group" >
    <input type="text" {{ $attributes->merge(['class' => ' datepicker-here form-control digits ']) }}
        data-language="en" name="{{ $name }}" value="{{ old($name) }}"/>
</div>

<span class="text-danger">
    @error($name)
        {{ $message }}
    @enderror
</span>

