<?php

	namespace App\Http\Livewire\Auth;

	use App\Models\User;
	use Illuminate\Support\Facades\Hash;
	use Livewire\Component;

	class Register extends Component
	{
		public $name                 = '';
		public $email                = '';
		public $password             = '';
		public $passwordConfirmation = '';

		public function register ()
		{
			$data = $this->validate([
										'name'                 => [ 'required', 'string', 'max:255' ],
										'email'                => [ 'required', 'email', 'unique:users' ],
										'password'             => [ 'required', 'min:8', 'same:passwordConfirmation' ],
										'passwordConfirmation' => [ 'required', 'min:8', 'same:password' ],
									]);
			User::create([
							 'name'     => $data['name'],
							 'email'    => $data['email'],
							 'password' => Hash::make($data['password']),
						 ]);

			return redirect('/');

		}

		public function render ()
		{
			return view('livewire.auth.register');
		}
	}
