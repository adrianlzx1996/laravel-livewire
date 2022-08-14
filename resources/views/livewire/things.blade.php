<div>
	<ul drag-root="reorder" class="bg-white rounded shadow divide-y">
		@foreach($things as $thing)
			<li drag-item="{{ $thing['id'] }}" draggable="true" wire:key="{{ $thing['id'] }}" animate-move
			    class="w-full p-4">
				{{ $thing['title'] }}
			</li>
		@endforeach
	</ul>

	<button wire:click="shuffle" class="w-full py-4 mt-4 bg-gray-200 rounded focus:outline-none">Shuffle</button>
</div>
