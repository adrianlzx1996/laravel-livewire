<?php

	namespace App\Http\Livewire\Auth;

	use Illuminate\Http\RedirectResponse;
	use Illuminate\Support\MessageBag;
	use Livewire\Component;

	class Login extends Component
	{
		public $email;
		public $password;
		public $remember;

		protected $rules
			= [
				'email'    => 'required|email|exists:users',
				'password' => 'required|min:8',
			];

		public function login ()
		: RedirectResponse|MessageBag
		{
			$credentials = $this->validate($this->rules);

			return auth()->attempt($credentials)
				? redirect()->intended('/')
				: $this->addError('email', trans('auth.failed'));
		}

		public function render ()
		{
			return view('livewire.auth.login')
				->layout('layouts.auth')
			;
		}
	}
