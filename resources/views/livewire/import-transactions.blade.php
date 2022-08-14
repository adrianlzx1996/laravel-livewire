<div>
	<x-button wire:click="$toggle('showImportModal')" class="bg-gray-100 text-black hover:bg-gray-700 hover:text-white">
		Import
	</x-button>

	<form wire:submit.prevent="import">
		<x-modal.dialog wire:model="showImportModal">
			<x-slot name="title">Import Transactions</x-slot>

			<x-slot name="content">
				@unless($upload)
					<div class="py-12 flex flex-col items-center justify-center">
						<div class="flex items-center space-x-2 text-xl">
							<x-input.file-upload id="upload" wire:model="upload">
								<span class="text-gray-500 font-bold">CSV File</span>
							</x-input.file-upload>
						</div>
						@error('upload')
						<div class="mt-3 text-red-500 text-sm">{{ $message }}</div>
						@enderror
					</div>
				@else
					<div>
						<x-input.group for="title" label="Title" :error="$errors->first('fieldColumnMap.title')">
							<select wire:model="fieldColumnMap.title" id="title">
								<option value="" disabled>Select Column...</option>
								@foreach($columns as $column)
									<option>{{ $column }}</option>
								@endforeach
							</select>
						</x-input.group>

						<x-input.group for="amount" label="Amount" :error="$errors->first('fieldColumnMap.amount')">
							<select wire:model="fieldColumnMap.amount" id="amount">
								<option value="" disabled>Select Column...</option>
								@foreach($columns as $column)
									<option>{{ $column }}</option>
								@endforeach
							</select>
						</x-input.group>

						<x-input.group for="status" label="Status" :error="$errors->first('fieldColumnMap.status')">
							<select wire:model="fieldColumnMap.status" id="status">
								<option value="" disabled>Select Column...</option>
								@foreach($columns as $column)
									<option>{{ $column }}</option>
								@endforeach
							</select>
						</x-input.group>

						<x-input.group for="date" label="Date" :error="$errors->first('fieldColumnMap.date')">
							<select wire:model="fieldColumnMap.date" id="date">
								<option value="" disabled>Select Column...</option>
								@foreach($columns as $column)
									<option>{{ $column }}</option>
								@endforeach
							</select>
						</x-input.group>
					</div>
				@endif
			</x-slot>

			<x-slot name="footer">
				<x-button wire:click="$set('showImportModal', false)"
				          class="bg-gray-100 text-black hover:bg-gray-700 hover:text-white">
					Cancel
				</x-button>
				<x-button type="submit">
					Import
				</x-button>
			</x-slot>
		</x-modal.dialog>
	</form>
</div>
