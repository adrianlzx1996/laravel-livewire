<?php

	namespace App\Http\Livewire;

	use Livewire\Component;

	class UsersListPage extends Component
	{
		public $offset  = 0;
		public $count   = 10;
		public $perPage = 10;

		public function render ()
		{
			return view('livewire.users-list-page');
		}

		public function showMore ()
		{
			$this->count += $this->perPage;
		}
	}
