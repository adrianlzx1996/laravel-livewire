<?php

	namespace App\Http\Livewire;

	use App\Models\Transaction;
	use Illuminate\Contracts\Foundation\Application;
	use Illuminate\Contracts\View\Factory;
	use Illuminate\Contracts\View\View;
	use Livewire\Component;
	use Livewire\WithPagination;

	class Dashboard extends Component
	{
		use WithPagination;

		public             $search        = '';
		public             $sortField     = 'title';
		public             $sortDirection = 'asc';
		public             $showEditModal = false;
		public Transaction $editing;

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
				'transactions' => Transaction::search('title', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10),
			]);
		}

		public function mount ()
		{
			$this->editing = $this->makeBlankTransaction();

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
	}
