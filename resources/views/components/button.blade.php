@props([
	'type' => 'button',
	'color' => 'default',
	'size' => 'default',
	])
@php $color = $color === 'default' ? 'text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500' : $color @endphp
<button
	type="{{ $type }}"
	{{ $attributes->class(["w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium focus:outline-none $color transition duration-300"]) }}
>
	{{ $slot }}
</button>
