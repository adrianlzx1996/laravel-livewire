<?php

	namespace App\Http\Livewire\Auth;

	use Livewire\Component;

	class Login extends Component
	{
		public $email;
		public $password;
		public $remember;

		public function login ()
		{
			$this->validate([
								'email'    => 'required|email|exists:users',
								'password' => 'required|min:8',
							]);

			auth()->attempt(
				[
					'email'    => $this->email,
					'password' => $this->password,
				],
				$this->remember
			);

			return redirect()->intended(route('dashboard'));
		}

		public function render ()
		{
			return view('livewire.auth.login');
		}
	}
