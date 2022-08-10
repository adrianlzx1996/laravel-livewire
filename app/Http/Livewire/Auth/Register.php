<?php

	namespace App\Http\Livewire\Auth;

	use App\Models\User;
	use Illuminate\Contracts\Foundation\Application;
	use Illuminate\Contracts\View\Factory;
	use Illuminate\Contracts\View\View;
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

		public function updatedEmail ()
		{
			$this->validateOnly('email', [
				'email' => 'required|email|unique:users,email',
			]);
		}

		public function register ()
		: Redirector|Application|RedirectResponse
		{
			$data = $this->validate([
										'name'                 => [ 'required', 'string', 'max:255' ],
										'email'                => [ 'required', 'email', 'unique:users' ],
										'password'             => [ 'required', 'min:8', 'same:passwordConfirmation' ],
										'passwordConfirmation' => [ 'required', 'min:8', 'same:password' ],
									]);
			$user = User::create([
									 'name'     => $data['name'],
									 'email'    => $data['email'],
									 'password' => Hash::make($data['password']),
								 ]);

			auth()->login($user);
			return redirect('/');
		}

		public function render ()
		: Factory|View|Application
		{
			return view('livewire.auth.register');
		}
	}
