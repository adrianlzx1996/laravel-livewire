<?php

	namespace App\Http\Livewire;

	use App\Models\Transaction;
	use Carbon\Carbon;
	use Illuminate\Contracts\Foundation\Application;
	use Illuminate\Contracts\View\Factory;
	use Illuminate\Contracts\View\View;
	use Livewire\Component;
	use Livewire\WithPagination;

	class Dashboard extends Component
	{
		use WithPagination;

		public Transaction $editing;

		public $sortField     = 'title';
		public $sortDirection = 'asc';
		public $showEditModal = false;
		public $showFilters   = false;
		public $selected      = [];
		public $filters
							  = [
				'search'     => '',
				'status'     => '',
				'amount-min' => null,
				'amount-max' => null,
				'date-min'   => null,
				'date-max'   => null,
			];

		protected $queryString = [ 'sortField', 'sortDirection' ];
		protected $guarded     = [];

		public function rules ()
		{
			return [
				'editing.title'  => [ 'required', 'string' ],
				'editing.amount' => [ 'required', 'integer' ],
				'editing.status' => [ 'required', 'in:' . collect(Transaction::STATUSES)->keys()->implode(',') ],
				'editing.date'   => [ 'required' ],
			];
		}

		public function sortBy ( $field )
		: void {
			if ( $this->sortField === $field ) {
				$this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
			}
			else {
				$this->sortField     = $field;
				$this->sortDirection = 'asc';
			}
		}

		public function render ()
		: Factory|View|Application
		{
			return view('livewire.dashboard', [
				'transactions' => Transaction::query()
											 ->when($this->filters['search'], fn ( $query, $search ) => $query->where('title', 'like', '%' . $search . '%'))
											 ->when($this->filters['status'], fn ( $query, $status ) => $query->where('status', $status))
											 ->when($this->filters['amount-min'], fn ( $query, $amount ) => $query->where('amount', '>=', $amount))
											 ->when($this->filters['amount-max'], fn ( $query, $amount ) => $query->where('amount', '<=', $amount))
											 ->when($this->filters['date-min'], fn ( $query, $date ) => $query->where('date', '>=', Carbon::parse($date)))
											 ->when($this->filters['date-max'], fn ( $query, $date ) => $query->where('date', '<=', Carbon::parse($date)))
											 ->orderBy($this->sortField, $this->sortDirection)
											 ->paginate(10),
			]);
		}

		public function mount ()
		{
			$this->editing = $this->makeBlankTransaction();

		}

		public function updatedFilters ()
		{
			$this->resetPage();
		}

		public function makeBlankTransaction ()
		{
			return Transaction::make([ 'date' => now(), 'status' => 'new' ]);
		}

		public function create ()
		{
			if ( $this->editing->getKey() ) {
				$this->editing = $this->makeBlankTransaction();
			}
			$this->showEditModal = true;
		}

		public function edit ( Transaction $transaction )
		: void {
			if ( $this->editing->isNot($transaction) ) {
				$this->editing = $transaction;
			}

			$this->showEditModal = true;
		}

		public function save ()
		: void
		{
			$this->validate();

			$this->editing->save();

			$this->showEditModal = false;

			$this->dispatchBrowserEvent('notify', 'Updated Transaction');
		}

		public function resetFilters ()
		{
			$this->reset('filters');
			$this->reset('search');
		}

		public function exportSelected ()
		{
			return response()->streamDownload(function () {
				echo Transaction::whereKey($this->selected)->toCsv();
			}, "transactions-" . now() . ".csv");
		}

		public function deleteSelected ()
		{
			$transactions = Transaction::whereKey($this->selected);

			$transactions->delete();

			$this->dispatchBrowserEvent('notify', 'Deleted Transactions');
		}
	}
