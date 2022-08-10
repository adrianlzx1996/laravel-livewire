<?php

	namespace Tests\Feature;

	use App\Models\User;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Illuminate\Support\Facades\Hash;
	use Livewire\Livewire;
	use Tests\TestCase;

	class RegistrationTest extends TestCase
	{
		use RefreshDatabase;

		public function test_registration_contains_livewire_component ()
		{
			$this->get('register')
				 ->assertSeeLivewire('auth.register')
			;
		}

		/**
		 * @return void
		 */
		public function test_name_is_required ()
		: void
		{
			Livewire::test('auth.register')
					->set('name', '')
					->set('email', 'john@gmail.com')
					->set('password', '123456789')
					->set('passwordConfirmation', '123456789')
					->call('register')
					->assertHasErrors('name')
			;
		}

		/**
		 * @return void
		 */
		public function test_email_is_required ()
		: void
		{
			Livewire::test('auth.register')
					->set('email', '')
					->set('password', '123456789')
					->set('passwordConfirmation', '123456789')
					->call('register')
					->assertHasErrors([ 'email' => 'required' ])
			;
		}

		/**
		 * @return void
		 */
		public function test_email_is_valid ()
		: void
		{
			Livewire::test('auth.register')
					->set('email', 'johnemail.com')
					->set('password', '123456789')
					->set('passwordConfirmation', '123456789')
					->call('register')
					->assertHasErrors([ 'email' => 'email' ])
			;
		}

		/**
		 * @return void
		 */
		public function test_email_is_unique ()
		: void
		{
			User::create([
							 'name'     => 'John',
							 'email'    => 'john@gmail.com',
							 'password' => Hash::make('123456789'),
						 ]);
			Livewire::test('auth.register')
					->set('email', 'john@gmail.com')
					->set('password', '123456789')
					->set('passwordConfirmation', '123456789')
					->call('register')
					->assertHasErrors([ 'email' => 'unique' ])
			;
		}

		/**
		 * @return void
		 */
		public function test_email_is_unique_as_user_type ()
		: void
		{
			User::create([
							 'name'     => 'John',
							 'email'    => 'john@gmail.com',
							 'password' => Hash::make('123456789'),
						 ]);
			Livewire::test('auth.register')
					->set('email', 'john@gmail.co')
					->assertHasNoErrors()
					->set('email', 'john@gmail.com')
					->assertHasErrors([ 'email' => 'unique' ])
			;
		}

		/**
		 * @return void
		 */
		public function test_password_is_required ()
		: void
		{
			Livewire::test('auth.register')
					->set('email', 'john@email.com')
					->set('password', '')
					->set('passwordConfirmation', '123456789')
					->call('register')
					->assertHasErrors([ 'password' => 'required' ])
			;
		}

		/**
		 * @return void
		 */
		public function test_password_is_valid ()
		: void
		{
			Livewire::test('auth.register')
					->set('email', 'john@email.com')
					->set('password', '1234567')
					->set('passwordConfirmation', '123456789')
					->call('register')
					->assertHasErrors([ 'password' => 'min:8' ])
			;
		}

		/**
		 * @return void
		 */
		public function test_passwordConfirmation_is_required ()
		: void
		{
			Livewire::test('auth.register')
					->set('email', 'john@email.com')
					->set('password', '123456789')
					->set('passwordConfirmation', '')
					->call('register')
					->assertHasErrors([ 'passwordConfirmation' => 'required' ])
			;
		}

		/**
		 * @return void
		 */
		public function test_passwordConfirmation_is_valid ()
		: void
		{
			Livewire::test('auth.register')
					->set('email', 'john@email.com')
					->set('password', '')
					->set('passwordConfirmation', '1234567')
					->call('register')
					->assertHasErrors([ 'passwordConfirmation' => 'min' ])
			;
		}

		/**
		 * @return void
		 */
		public function test_password_match_with_passwordConfirmation ()
		: void
		{
			Livewire::test('auth.register')
					->set('email', 'john@email.com')
					->set('password', 'secret')
					->set('passwordConfirmation', 'non-secret')
					->call('register')
					->assertHasErrors([ 'password' => 'same' ])
			;
		}

		/**
		 * @return void
		 */
		public function test_can_register ()
		: void
		{
			Livewire::test('auth.register')
					->set('name', 'John Doe')
					->set('email', 'john@gmail.com')
					->set('password', '123456789')
					->set('passwordConfirmation', '123456789')
					->call('register')
					->assertRedirect('/')
			;

			$this->assertTrue(User::whereEmail('john@gmail.com')->exists());
			$this->assertEquals('john@gmail.com', auth()->user()->email);
		}
	}
