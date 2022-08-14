<div class="divide-y divide-gray-300">
	@foreach($users as $user)
		<div wire:key="{{ $user['id'] }}" class="px-4 py-2">
			<span>{{ $user['title'] }}</span>
		</div>
	@endforeach
</div>
