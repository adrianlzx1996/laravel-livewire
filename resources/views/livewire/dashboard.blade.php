<div>
	<h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>

	<div class="py-4 space-y-4">
		<div class="flex justify-between">
			<div class="w-2/4 flex space-x-4">
				<x-input.text wire:model.debounce="filters.search" placeholder="Search Transactions..."/>

				<x-button wire:click="$toggle('showFilters')">
					@if($showFilters)
						Hide
					@endif
					Advanced Search...
				</x-button>
			</div>

			<div class="flex space-x-2">
				<x-dropdown label="Bulk Actions">
					<x-dropdown.item type="button" class="flex items-center space-x-2" wire:click="exportSelected">
						<span>Export</span>
					</x-dropdown.item>
					<x-dropdown.item type="button" class="flex items-center space-x-2" wire:click="deleteSelected">
						<span>Delete</span>
					</x-dropdown.item>
				</x-dropdown>
				<x-button wire:click="create">+ New</x-button>
			</div>
		</div>

		<div>
			@if($showFilters)
				<div class="bg-gray-200 p-4 rounded shadow-inner flex relative">
					<div class="w-1/2 pl-2 space-y-4">
						<x-input.group inline for="filter-status" label="Status">
							<select wire:model.lazy="filters.status" id="filter-status">
								<option value="" disabled>Select status...</option>
								@foreach(\App\Models\Transaction::STATUSES as $status)
									<option value="{{ $status }}">{{ $status }}</option>
								@endforeach
							</select>
						</x-input.group>

						<x-input.group inline for="filter-amount-min" label="Minimum Amount">
							<x-input.text wire:model.lazy="filters.amount-min" id="filter-amount-min"/>
						</x-input.group>

						<x-input.group inline for="filter-amount-max" label="Maximum Amount">
							<x-input.text wire:model.lazy="filters.amount-max" id="filter-amount-max"/>
						</x-input.group>
					</div>

					<div class="w-1/2 pl-2 space-y-4">
						<x-input.group inline for="filter-date-min" label="Minimum Date">
							<x-input.date wire:model.lazy="filters.date-min" id="filter-date-min"
							              placeholder="MM/DD/YYYY"/>
						</x-input.group>

						<x-input.group inline for="filter-date-max" label="Maximum Date">
							<x-input.date wire:model.lazy="filters.date-max" id="filter-date-max"
							              placeholder="MM/DD/YYYY"/>
						</x-input.group>

						<x-button wire:click="resetFilters" class="absolute right-0 bottom-0 p-4">Reset Filters
						</x-button>
					</div>
				</div>
			@endif
		</div>

		<div class="flex-col space-y-4">
			<x-table>
				<x-slot name="head">
					<x-table.heading class="pr-0 w-8">
						<input type="checkbox">
					</x-table.heading>
					<x-table.heading sortable wire:click="sortBy('title')"
					                 class="w-full"
					                 :direction="$sortField === 'title' ? $sortDirection : null">Title
					</x-table.heading>
					<x-table.heading sortable wire:click="sortBy('amount')"
					                 :direction="$sortField === 'amount' ? $sortDirection : null">Amount
					</x-table.heading>
					<x-table.heading sortable wire:click="sortBy('status')"
					                 :direction="$sortField === 'status' ? $sortDirection : null">Status
					</x-table.heading>
					<x-table.heading sortable wire:click="sortBy('date')"
					                 :direction="$sortField === 'date' ? $sortDirection : null">Date
					</x-table.heading>
					<x-table.heading/>
				</x-slot>

				<x-slot name="body">
					@forelse($transactions as $transaction)
						<x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $transaction->id }}">
							<x-table.cell class="pr-0">
								<input type="checkbox" wire:model="selected" value="{{ $transaction->id }}"/>
							</x-table.cell>
							<x-table.cell>
							<span class="inline-flex space-x-2 truncate text-sm">
								<x-icons.cash/>
								<p class="text-cool-gray-600 truncate">{{ $transaction->title }}</p>
							</span>
							</x-table.cell>

							<x-table.cell class="text-slate-500">
							<span class="text-slate-900 font-medium">
								${{ $transaction->amount }}
							</span>
								USD
							</x-table.cell>

							<x-table.cell>
							<span
								class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $transaction->status_color }}-100 text-{{ $transaction->status_color }}-800 capitalize">
								{{ $transaction->status }}
							</span>
							</x-table.cell>

							<x-table.cell>
								<time datetime="{{ $transaction->date }}">
									{{ $transaction->date_for_humans }}
								</time>
							</x-table.cell>

							<x-table.cell>
								<x-button wire:click="edit({{ $transaction->id }})">Edit</x-button>
							</x-table.cell>
						</x-table.row>
					@empty
						<x-table.row wire:loading.class.delay="opacity-50">
							<x-table.cell colspan="6">
								<div class="flex justify-center items-center space-x-2">
									<x-icons.inbox class="text-slate-400"/>
									<span class="py-8 text-slate-400 text-xl font-medium">
										No Transactions Found...
									</span>
								</div>
							</x-table.cell>
						</x-table.row>
					@endforelse
				</x-slot>
			</x-table>

			<div>
				{{ $transactions->links() }}
			</div>
		</div>
	</div>

	<form wire:submit.prevent="save">
		<x-modal.dialog wire:model.defer="showEditModal">
			<x-slot name="title">Edit Transaction</x-slot>
			<x-slot name="content">
				<x-input.group for="title" label="Title" :error="$errors->first('editing.title')">
					<x-input.text wire:model.defer="editing.title" id="title" placeholder="e.g. Groceries"/>
				</x-input.group>

				<x-input.group for="amount" label="Amount" :error="$errors->first('editing.amount')">
					<x-input.text wire:model.defer="editing.amount" id="amount"/>
				</x-input.group>

				<x-input.group for="status" label="Status" :error="$errors->first('editing.status')">
					<select wire:model="editing.status" id="status">
						@foreach(\App\Models\Transaction::STATUSES as $value => $label)
							<option value="{{ $value }}">{{ $label }}</option>
						@endforeach
					</select>
				</x-input.group>

				<x-input.group for="editing_date" label="Date" :error="$errors->first('editing.editing_date')">
					<x-input.date wire:model.defer="editing.date" id="editing_date"/>
				</x-input.group>
			</x-slot>
			<x-slot name="footer">
				<x-button
					wire:click="$emit('showEditModal', false)"
					color="bg-slate-200 hover:bg-slate-700 focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 hover:text-white">
					Cancel
				</x-button>
				<x-button type="submit">Save</x-button>
			</x-slot>
		</x-modal.dialog>
	</form>
</div>
