@props([
	'sortable' => null,
	'direction' => null,
])

<th {{ $attributes->class('px-6 py-3 bg-cool-gray-50') }}>

	@unless($sortable)
		<span
			class="text-left text-xs leading-4 font-medium text-cool-gray-500 uppercase tracking-wider">{{ $slot }}</span>
	@else
		<button
			class="flex items-center space-x-1 text-left text-xs leading-4 font-medium group" {{ $attributes->except('class') }}>
			<span>{{ $slot }}</span>

			<span>
				@if($direction === 'asc')
					<svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
						<path fill-rule="evenodd"
						      d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
						      clip-rule="evenodd"/>
					</svg>
				@elseif($direction === 'desc')
					<svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
					     aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                      </svg>
				@else
					<svg class="h-3 w-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
					     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" stroke="currentColor"
					     fill="none">
						<path fill-rule="evenodd"
						      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
						      clip-rule="evenodd"/>
					</svg>
				@endif
			</span>
		</button>
	@endunless
</th>
