<?php

	namespace App\Http\Livewire;

	use App\Http\Livewire\DataTable\WithBulkActions;
	use App\Http\Livewire\DataTable\WithSorting;
	use App\Models\Transaction;
	use Carbon\Carbon;
	use Illuminate\Contracts\Foundation\Application;
	use Illuminate\Contracts\View\Factory;
	use Illuminate\Contracts\View\View;
	use Livewire\Component;
	use Livewire\WithPagination;

	class Dashboard extends Component
	{
		use WithPagination, WithSorting, WithBulkActions;

		public Transaction $editing;

		public $showDeleteModal = false;
		public $showEditModal   = false;
		public $showFilters     = false;

		public $filters
			= [
				'search'     => '',
				'status'     => '',
				'amount-min' => null,
				'amount-max' => null,
				'date-min'   => null,
				'date-max'   => null,
			];

		protected $queryString = [];
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

		public function getRowsQueryProperty ()
		{
			$query = Transaction::query()
								->when($this->filters['search'], fn ( $query, $search ) => $query->where('title', 'like', '%' . $search . '%'))
								->when($this->filters['status'], fn ( $query, $status ) => $query->where('status', $status))
								->when($this->filters['amount-min'], fn ( $query, $amount ) => $query->where('amount', '>=', $amount))
								->when($this->filters['amount-max'], fn ( $query, $amount ) => $query->where('amount', '<=', $amount))
								->when($this->filters['date-min'], fn ( $query, $date ) => $query->where('date', '>=', Carbon::parse($date)))
								->when($this->filters['date-max'], fn ( $query, $date ) => $query->where('date', '<=', Carbon::parse($date)))
			;

			return $this->applySorting($query);
		}

		public function getRowsProperty ()
		{
			return $this->rowsQuery->paginate(10);
		}

		public function render ()
		: Factory|View|Application
		{

			return view('livewire.dashboard', [
				'transactions' => $this->rows,
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
		}

		public function exportSelected ()
		{
			return response()->streamDownload(function () {
				$this->getSelectedRowsQuery
					->toCsv()
				;
			}, "transactions-" . now() . ".csv");
		}

		public function deleteSelected ()
		{
			$this->getSelectedRowsQuery
				->delete()
			;

			$this->showDeleteModal = false;

			$this->dispatchBrowserEvent('notify', 'Deleted Transactions');
			$this->reset('selected');
			$this->reset('selectedAll');
			$this->reset('selectPage');

		}
	}
