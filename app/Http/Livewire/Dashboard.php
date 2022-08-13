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

		public $sortField       = 'title';
		public $sortDirection   = 'asc';
		public $showDeleteModal = false;
		public $showEditModal   = false;
		public $showFilters     = false;
		public $selectedAll     = false;
		public $selectPage      = [];
		public $selected        = [];
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

		public function getTransactionsQueryProperty ()
		{
			return Transaction::query()
							  ->when($this->filters['search'], fn ( $query, $search ) => $query->where('title', 'like', '%' . $search . '%'))
							  ->when($this->filters['status'], fn ( $query, $status ) => $query->where('status', $status))
							  ->when($this->filters['amount-min'], fn ( $query, $amount ) => $query->where('amount', '>=', $amount))
							  ->when($this->filters['amount-max'], fn ( $query, $amount ) => $query->where('amount', '<=', $amount))
							  ->when($this->filters['date-min'], fn ( $query, $date ) => $query->where('date', '>=', Carbon::parse($date)))
							  ->when($this->filters['date-max'], fn ( $query, $date ) => $query->where('date', '<=', Carbon::parse($date)))
							  ->orderBy($this->sortField, $this->sortDirection)
			;
		}

		public function getTransactionsProperty ()
		{
			return $this->transactionsQuery->paginate(10);
		}

		public function render ()
		: Factory|View|Application
		{
			if ( $this->selectedAll ) {
				$this->selected = $this->transactions->pluck('id')->toArray();
			}

			return view('livewire.dashboard', [
				'transactions' => $this->transactions,
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

		public function updatedSelected ()
		{
			$this->selectedAll = false;
			$this->selectPage  = [];
		}

		public function updatedSelectPage ( $value )
		{
			$this->selected = $value
				? $this->transactions->pluck('id')->map(fn ( $id ) => (string)$id)
				: [];
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

		public function selectAll ()
		{
			$this->selectedAll = true;
		}

		public function resetFilters ()
		{
			$this->reset('filters');
		}

		public function exportSelected ()
		{
			return response()->streamDownload(function () {
				echo $this->transactionsQuery
					->unless($this->selectedAll, fn ( $query ) => $query->whereKey($this->selected))
					->toCsv()
				;
			}, "transactions-" . now() . ".csv");
		}

		public function deleteSelected ()
		{
			( clone $this->transactionsQuery )
				->unless($this->selectedAll, fn ( $query ) => $query->whereKey($this->selected))
				->delete()
			;

			$this->showDeleteModal = false;

			$this->dispatchBrowserEvent('notify', 'Deleted Transactions');
			$this->reset('selected');
			$this->reset('selectedAll');
			$this->reset('selectPage');

		}
	}
