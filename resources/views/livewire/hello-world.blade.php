<div>
	<input type="text" wire:model.debounce="name">
	<input type="checkbox" wire:model="loud">
	<select wire:model="greeting" multiple>
		<option value="Hello">Hello</option>
		<option value="Goodbye">Goodbye</option>
		<option value="Adios">Adios</option>
	</select>

	{{ implode(', ', $greeting) }} {{ $name }} @if($loud)
		!
	@endif

	<button wire:click="resetName('Adrian')">Reset Name</button>
</div>
