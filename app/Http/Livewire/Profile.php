<?php

	namespace App\Http\Livewire;

	use Livewire\Component;
	use Livewire\WithFileUploads;

	class Profile extends Component
	{
		use WithFileUploads;

		public $user;
		public $upload;

		protected $rules
			= [
				'user.name'     => 'required|max:255',
				'user.email'    => 'required|email',
				'user.birthday' => 'sometimes|date',
				'user.about'    => 'sometimes|max:140',
				'upload'        => 'sometimes|image|max:2048',
			];

		public function mount ()
		: void
		{
			$this->user = auth()->user();
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
					'upload' => 'image|max:2048',
				]
			);
		}

		public function save ()
		: void
		{
			$this->validate();

			$this->user->update();

			$this->upload
			&& $this->user->update([
									   'avatar' => $this->upload->store('/', 'avatars'),
								   ]);

			$this->emitSelf('notify-saved');

			$this->dispatchBrowserEvent('notify', 'Profile saved!');
		}

	}
