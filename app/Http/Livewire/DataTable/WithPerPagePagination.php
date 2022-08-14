<?php

	namespace App\Http\Livewire\DataTable;

	use Livewire\WithPagination;

	trait WithPerPagePagination
	{
		use WithPagination;

		public $perPage = 10;

		public function renderingWithPerPagePagination ()
		: void
		{
			$this->perPage = session()->get('perPage', $this->perPage);
		}

		public function updatedPerPage ( $value )
		: void {
			session([ 'perPage' => $value ]);
		}

		public function applyPagination ( $query )
		{
			return $query->paginate($this->perPage);
		}
	}
