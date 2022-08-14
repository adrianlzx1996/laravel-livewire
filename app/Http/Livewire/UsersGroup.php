<?php

	namespace App\Http\Livewire;

	use App\Models\Transaction;
	use Livewire\Component;

	class UsersGroup extends Component
	{
		public $perPage;
		public $offset;

		public function render ()
		{
			return view('livewire.users-group', [ 'users' => Transaction::limit($this->perPage)->offset($this->offset)->get() ]);
		}
	}
