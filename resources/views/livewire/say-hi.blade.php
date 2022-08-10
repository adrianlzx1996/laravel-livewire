<div>
	<input type="text" wire:model.debounce="name">

	Hello {{ $name }} {{ now() }}

	<button wire:click="$refresh">refresh</button>
</div>
