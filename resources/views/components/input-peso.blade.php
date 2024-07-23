@props(['name', 'label'])

<label class="form-label">{{ $label }} (PHP)</label>

<input type="text" name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }}
    id="{{ $name }}" value="{{ old($name) }}" onkeyup="formatPeso(this)" />

<span class="text-danger">
    @error($name)
        {{ $message }}
    @enderror
</span>
