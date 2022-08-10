<?php

	namespace App\Http\Livewire;

	use Livewire\Component;

	class Profile extends Component
	{
		public $name;
		public $email;

		public function mount ()
		{
			$this->name  = auth()->user()?->name;
			$this->email = auth()->user()?->email;
		}

		public function save ()
		: void
		{
			$profileData = $this->validate(
				[
					'name'  => 'required|max:255',
					'email' => 'required|email',
				]
			);

			auth()->user()?->update(
				[
					'name'  => $profileData['name'],
					'email' => $profileData['email'],
				]
			);

			$this->emitSelf('notify-saved');

			$this->dispatchBrowserEvent('notify', 'Profile saved!');
		}

		public function render ()
		{
			return view('livewire.profile');
		}
	}
