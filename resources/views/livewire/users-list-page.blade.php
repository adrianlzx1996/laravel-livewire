<div class="p-8 flex flex-col items-center space-y-4">
	<div class="w-96 bg-white border border-gray-300 rounded shadow divide-y divide-gray-300">
		@for($offset = 0; $offset < $count; $offset += $perPage)
			<livewire:users-group :per-page="$perPage" :offset="$offset" wire:key="users-group-{{ $offset }}"/>
		@endfor
	</div>

	<button wire:click="showMore"
	        class="w-96 px-4 py-2 flex items-center justify-center bg-white border border-gray-300 shadow rounded ">
		<span>Show More</span>


	</button>
</div>
