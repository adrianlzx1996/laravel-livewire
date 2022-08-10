<div class="flex items-center">
	{{ $slot }}

	<div x-data="{ focused: false }">
		<span class="ml-5 rounded-md shadow-sm">
			<input @focus="focused = true" @blur="focused = false" type="file"
			       {{ $attributes }}
			       class="sr-only">
			<label for="{{ $attributes['id'] }}"
			       class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50"
			       :class="{ 'outline-none ring-2 ring-offset-2 ring-indigo-500': focused }">
				Change
			</label>
		</span>
	</div>
</div>
