@props(['name', 'label', 'value' => ''])
<label class="form-label">{{ $label }}</label>

<textarea name="{{ $name }}" {{ $attributes }} class="form-control" id="{{ $name }}"  value="{{ old($name) }} rows="4">{{$value}}</textarea>

<span class="text-danger">
    @error( $name )
        {{ $message }}
    @enderror
</span>
