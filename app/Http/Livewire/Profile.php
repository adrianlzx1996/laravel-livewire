<?php

	namespace App\Http\Livewire;

	use Livewire\Component;

	class Profile extends Component
	{
		public $name;
		public $email;
		public $birthday = null;
		public $about;

		public function mount ()
		{
			$this->name     = auth()->user()?->name;
			$this->email    = auth()->user()?->email;
			$this->birthday = auth()->user()?->birthday?->format("m/d/Y");
			$this->about    = auth()->user()?->about;
		}

		public function save ()
		: void
		{
			$profileData = $this->validate(
				[
					'name'     => 'required|max:255',
					'email'    => 'required|email',
					'birthday' => 'sometimes|nullable|date',
					'about'    => 'sometimes|nullable',
				]
			);

			auth()->user()?->update(
				[
					'name'     => $profileData['name'],
					'email'    => $profileData['email'],
					'birthday' => $profileData['birthday'],
					'about'    => $profileData['about'],
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
