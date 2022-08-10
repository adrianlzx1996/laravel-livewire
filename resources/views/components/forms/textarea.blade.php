@props([
	'label' => '',
	'value' => '',
	'placeholder' => '',
	'type' => 'text'
])
<div>
	@if($label)
		<label for="{{ $value }}" class="block text-sm font-medium text-gray-700"> {{ $label }} </label>
	@endif
	<div class="mt-1 relative rounded-md shadow-sm">
		<textarea wire:model.lazy="{{ $value }}" type="{{ $type }}" id="{{ $value }}" name="{{ $value }}"
		          placeholder="{{ $placeholder }}"
		          value="{{ old($value) }}"
			{{ $attributes->class(["appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm", "border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500" => $errors->has($value)]) }}
		>
			</textarea>
		@error($value)
		<div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
			<x-icons.error/>
		</div>
		@enderror
	</div>
	@error($value) <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
</div>
