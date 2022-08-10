<?php

	namespace Tests\Feature;

	use App\Models\User;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Livewire\Livewire;
	use Tests\TestCase;

	class LoginTest extends TestCase
	{
		use RefreshDatabase;

		/**
		 * @return void
		 */
		public function test_can_view_login_page ()
		: void
		{
			$this->get(route('login'))
				 ->assertSuccessful()
				 ->assertSeeLivewire('auth.login')
			;
		}

		/**
		 * "If the user is already logged in, they should be redirected to the home page."
		 *
		 * The first line of the function is a docblock. It's a comment that describes the function. It's not required,
		 * but it's a good idea to include it
		 */
		public function test_is_redirected_if_already_logged_in ()
		: void
		{
			auth()->login(User::factory()->create());

			$this->get(route('login'))
				 ->assertRedirect('/')
			;
		}

		/**
		 * "When a user logs in, they should be redirected to the home page."
		 *
		 * The first thing we do is create a user. We use the `factory()` method to create a user. This is a Laravel
		 * feature that allows us to create a user without having to fill in all the fields
		 */
		public function test_can_login ()
		: void
		{
			$user = User::factory()->create();

			Livewire::test('auth.login')
					->set('email', $user->email)
					->set('password', 'password')
					->call('login')
					->assertRedirect('/')
			;
		}
	}
