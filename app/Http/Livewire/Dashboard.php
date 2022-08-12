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

		public $search        = '';
		public $sortField     = 'title';
		public $sortDirection = 'asc';

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
	}
