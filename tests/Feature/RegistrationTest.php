<?php

	namespace Tests\Feature;

	use App\Models\User;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Livewire\Livewire;
	use Tests\TestCase;

	class RegistrationTest extends TestCase
	{
		use RefreshDatabase;

		/**
		 * A basic feature test example.
		 *
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
