@props([
	'label',
	'for',
	'error' => false,
	'inline' => false,
	'helpText' => '',
	'borderless' => false,
	'paddingless' => false,
])

<div
	class="sm:items-start {{ $borderless ? '' : 'sm:border-t sm:border-gray-200' }} {{ $paddingless ? '' : 'sm:pt-5' }} {{ $inline ? 'inline-flex' : 'sm:grid sm:grid-cols-3 sm:gap-4' }}">
	<label for="{{ $for }}" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
		{{ $label }} </label>
	<div class="mt-1 sm:mt-0 sm:col-span-2">
		{{ $slot }}

		@if($error)
			<div class="mt-1 text-red-500 text-sm">{{ $error }}</div>
		@endif

		@if($helpText)
			<div class="mt-1 text-gray-500 text-xs">{{ $helpText }}</div>
		@endif
	</div>
</div>
