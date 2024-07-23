@props(['name'])

<button {{ $attributes->merge(['class' => 'btn']) }}>
    {{ $name }}
</button>
