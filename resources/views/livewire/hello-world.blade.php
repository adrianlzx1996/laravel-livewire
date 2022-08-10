<div>
	@foreach($names as $name)
		<livewire:say-hi :name="$name" :key="$name"/>
	@endforeach

	{{ now() }}

	<button wire:click="refreshChildren">Refresh Children</button>
</div>
