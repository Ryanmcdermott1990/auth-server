@props(['value'])

<label {{ $attributes->merge(['class' => 'max-w-md block font-medium text-sm text-gray-500']) }}>
    {{ $value ?? $slot }}
</label>
