<div>
	<ul wire:sortable="reorder" drag-root="reorder" class="bg-white rounded shadow divide-y">
		@foreach($things as $thing)
			<li wire:sortable.item="{{ $thing['id'] }}" drag-item="{{ $thing['id'] }}" draggable="true"
			    wire:key="{{ $thing['id'] }}"
			    animate-move
			    class="w-full p-4">
				<div class="flex justify-between">
					<span>{{ $thing['title'] }}</span>
					<span wire:sortable.handle>*</span>
				</div>
			</li>
		@endforeach
	</ul>

	<button wire:click="shuffle" class="w-full py-4 mt-4 bg-gray-200 rounded focus:outline-none">Shuffle</button>
</div>
