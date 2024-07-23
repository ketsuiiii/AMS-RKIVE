@props(['name', 'label'])

<div class="form-check">
    <div class="checkbox p-0">
        <input type="checkbox" id="{{ $name }}" name="{{ $name }}"
            {{ $attributes->merge(['class' => 'form-check-input']) }} />
        <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
    </div>
</div>

<span class="text-danger">
    @error($name)
        {{ $message }}
    @enderror
</span>
