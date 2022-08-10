<?php

	namespace App\Http\Livewire;

	use Livewire\Component;

	class Profile extends Component
	{
		public $name;
		public $email;
		public $birthday = null;
		public $about;
		public $avatar;

		public function mount ()
		{
			$this->name     = auth()->user()?->name;
			$this->email    = auth()->user()?->email;
			$this->birthday = auth()->user()?->birthday?->format("m/d/Y");
			$this->about    = auth()->user()?->about;
			$this->avatar   = auth()->user()?->avatar;
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
					'avatar'   => 'sometimes|nullable|image',
				]
			);

			auth()->user()?->update(
				[
					'name'     => $profileData['name'],
					'email'    => $profileData['email'],
					'birthday' => $profileData['birthday'],
					'about'    => $profileData['about'],
					'avatar'   => $profileData['avatar'],
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
