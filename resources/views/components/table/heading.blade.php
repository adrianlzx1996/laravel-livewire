@props([
	'sortable' => null,
	'direction' => null,
	'multiColumn' => null,
])

<th {{ $attributes->merge(['class'=>'px-6 py-3 bg-gray-50'])->only('class') }}>

	@unless($sortable)
		<span
			class="text-left text-xs leading-4 font-medium text-cool-gray-500 uppercase tracking-wider">{{ $slot }}</span>
	@else
		<button
			class="flex items-center space-x-1 text-left text-xs leading-4 font-medium group uppercase" {{ $attributes->except('class') }}>
			<span>{{ $slot }}</span>

			<span class="relative flex items-center">
				@if ($multiColumn)
					@if ($direction === 'asc')
						<svg class="w-3 h-3 group-hover:opacity-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
						     xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round"
						                                              stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
						<svg class="w-3 h-3 opacity-0 group-hover:opacity-100 absolute" fill="none"
						     stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path
								stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M19 9l-7 7-7-7"></path></svg>
					@elseif ($direction === 'desc')
						<div class="opacity-0 group-hover:opacity-100 absolute">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M5 15l7-7 7 7"></path></svg>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M19 9l-7 7-7-7"></path></svg>
                        </div>
						<svg class="w-3 h-3 group-hover:opacity-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
						     xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round"
						                                              stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
					@else
						<svg class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
						     fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path
								stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M5 15l7-7 7 7"></path></svg>
					@endif
				@else
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
				@endif

			</span>
		</button>
	@endunless
</th>
