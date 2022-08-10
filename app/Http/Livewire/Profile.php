<?php

	namespace App\Http\Livewire;

	use Livewire\Component;

	class Profile extends Component
	{
		public $name;
		public $email;

		public function save ()
		: void
		{
			$profileData = $this->validate(
				[
					'name'  => 'required|max:255',
					'email' => 'required|email',
				]
			);

			$user = auth()->user()?->update(
				[
					'name'  => $profileData['name'],
					'email' => $profileData['email'],
				]
			);

		}

		public function render ()
		{
			return view('livewire.profile');
		}
	}
