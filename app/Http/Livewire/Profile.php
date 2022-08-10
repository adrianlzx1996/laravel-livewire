<?php

	namespace App\Http\Livewire;

	use Livewire\Component;
	use Livewire\WithFileUploads;

	class Profile extends Component
	{
		use WithFileUploads;

		public $name;
		public $email;
		public $birthday = null;
		public $about;
		public $newAvatar;

		public function mount ()
		{
			$this->name     = auth()->user()?->name;
			$this->email    = auth()->user()?->email;
			$this->birthday = auth()->user()?->birthday?->format("m/d/Y");
			$this->about    = auth()->user()?->about;
		}

		/**
		 * Realtime Avatar validation
		 *
		 * @return void
		 */
		public function updatedNewAvatar ()
		: void
		{
			$this->validate(
				[
					'newAvatar' => 'image|max:2048',
				]
			);
		}

		public function save ()
		: void
		{
			$profileData = $this->validate(
				[
					'name'      => 'required|max:255',
					'email'     => 'required|email',
					'birthday'  => 'sometimes|nullable|date',
					'about'     => 'sometimes|nullable',
					'newAvatar' => 'image|max:2048|mimes:png,jpeg,jpg,gif',
				]
			);

			$fileName = $this->newAvatar->store('/', 'avatars');

			auth()->user()?->update(
				[
					'name'     => $profileData['name'],
					'email'    => $profileData['email'],
					'birthday' => $profileData['birthday'],
					'about'    => $profileData['about'],
					'avatar'   => $fileName,
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
