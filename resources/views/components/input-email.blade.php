@props(['name', 'label'])

<label class="form-label">{{ $label }}</label>

<div class="input-group">
    <span class="input-group-text">@</span>
    <input type="email" name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }}
        id="{{ $name }}" value="{{ old($name) }}"/>
</div>

<span class="text-danger">
    @error($name)
        {{ $message }}
    @enderror
</span>

