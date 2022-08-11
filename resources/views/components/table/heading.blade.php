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
			class="flex items-center space-x-1 text-left text-xs leading-4 font-medium" {{ $attributes->except('class') }}>
			<span>{{ $slot }}</span>

			<span>
				@if($direction === 'asc')
					<svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" stroke="currentColor"
					     fill="none">
						<path fill-rule="evenodd"
						      d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
						      clip-rule="evenodd"/>
					</svg>
				@elseif($direction === 'desc')
					<svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" stroke="currentColor"
					     fill="none">
						<path fill-rule="evenodd"
						      d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
						      clip-rule="evenodd"/>
					</svg>
				@else
					<svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" stroke="currentColor"
					     fill="none">
						<path fill-rule="evenodd"
						      d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
						      clip-rule="evenodd"/>
					</svg>
				@endif
			</span>
		</button>
	@endunless
</th>
