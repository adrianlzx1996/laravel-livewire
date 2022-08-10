<?php

	namespace Tests\Feature;

	use App\Http\Livewire\Profile;
	use App\Models\User;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Illuminate\Support\Str;
	use Livewire\Livewire;
	use Tests\TestCase;

	class ProfileTest extends TestCase
	{
		use RefreshDatabase;

		/**
		 * @return void
		 */
		public function test_profile_info_is_populated ()
		: void
		{
			$user = User::factory()->make(
				[ 'name' => 'foo', 'email' => 'bar@bar.com' ]
			);

			Livewire::actingAs($user)
					->test('profile')
					->assertSet('name', 'foo')
					->assertSet('email', 'bar@bar.com')
			;
		}

		/**
		 * @return void
		 */
		public function test_can_see_livewire_profile_component_on_profile_page ()
		: void
		{
			$user = User::factory()->make();

			$this->actingAs($user)
				 ->withoutExceptionHandling() // * return actual useful error message instead of error 500
				 ->get('/profile')
				 ->assertSuccessful()
				 ->assertSeeLivewire('profile')
			;
		}

		public function test_name_max_255_characters ()
		: void
		{
			$user = User::factory()->create();

			Livewire::actingAs($user)
					->test(Profile::class)
					->set('name', Str::repeat('a', 257))
					->call('save')
					->assertHasErrors([ 'name' => 'max' ])
			;
		}

		public function test_email_is_required ()
		: void
		{
			$user = User::factory()->create();

			Livewire::actingAs($user)
					->test(Profile::class)
					->set('email', '')
					->call('save')
					->assertHasErrors([ 'email' => 'required' ])
			;
		}

		public function test_email_is_valid ()
		: void
		{
			$user = User::factory()->create();

			Livewire::actingAs($user)
					->test(Profile::class)
					->set('email', 'aaa')
					->call('save')
					->assertHasErrors([ 'email' => 'email' ])
			;
		}

		public function test_can_update_profile ()
		: void
		{
			$user = User::factory()->create();

			Livewire::actingAs($user)
					->test(Profile::class)
					->set('name', 'Foo')
					->set('email', 'bar@bar.com')
					->call('save')
			;

			$user->refresh();

			$this->assertEquals('Foo', $user->name);
			$this->assertEquals('bar@bar.com', $user->email);
		}
	}
