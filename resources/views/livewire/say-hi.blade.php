<div>
	<input type="text" wire:model.debounce="name">

	Hello {{ $name }} {{ now() }}

	<button wire:click="emitFoo">refresh</button>
</div>
