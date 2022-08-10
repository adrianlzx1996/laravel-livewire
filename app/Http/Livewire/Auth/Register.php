<?php

	namespace App\Http\Livewire\Auth;

	use App\Models\User;
	use Illuminate\Contracts\Foundation\Application;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Routing\Redirector;
	use Illuminate\Support\Facades\Hash;
	use Livewire\Component;

	class Register extends Component
	{
		public $name                 = '';
		public $email                = '';
		public $password             = '';
		public $passwordConfirmation = '';

		protected $rules
			= [
				'name'                 => [ 'required', 'string', 'max:255' ],
				'email'                => [ 'required', 'email', 'unique:users' ],
				'password'             => [ 'required', 'min:8', 'same:passwordConfirmation' ],
				'passwordConfirmation' => [ 'required', 'min:8', 'same:password' ],
			];

		public function updatedEmail ()
		{
			$this->validate([ 'email' => 'unique:users' ]);
		}

		public function register ()
		: Redirector|Application|RedirectResponse
		{
			$data = $this->validate();

			$user = User::create([
									 'name'     => $data['name'],
									 'email'    => $data['email'],
									 'password' => Hash::make($data['password']),
								 ]);

			auth()->login($user);
			return redirect('/');
		}

		public function render ()
		{
			return view('livewire.auth.register')
				->layout('layouts.auth')
			;
		}
	}
