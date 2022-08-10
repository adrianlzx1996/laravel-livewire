<?php

	namespace Tests\Feature;

	use App\Http\Livewire\Profile;
	use App\Models\User;
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Illuminate\Http\UploadedFile;
	use Illuminate\Support\Facades\Storage;
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
					->assertSet('user.name', 'foo')
					->assertSet('user.email', 'bar@bar.com')
			;
		}

		public function test_message_is_shown_on_save ()
		: void
		{
			$user = User::factory()->make(
				[ 'name' => 'foo', 'email' => 'bar@bar.com' ]
			);

			Livewire::actingAs($user)
					->test('profile')
					->call('save')
					->assertEmitted('notify-saved')
					->assertDispatchedBrowserEvent('notify')
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
					->set('user.name', Str::repeat('a', 257))
					->call('save')
					->assertHasErrors([ 'user.name' => 'max' ])
			;
		}

		public function test_email_is_required ()
		: void
		{
			$user = User::factory()->create();

			Livewire::actingAs($user)
					->test(Profile::class)
					->set('user.email', '')
					->call('save')
					->assertHasErrors([ 'user.email' => 'required' ])
			;
		}

		public function test_email_is_valid ()
		: void
		{
			$user = User::factory()->create();

			Livewire::actingAs($user)
					->test(Profile::class)
					->set('user.email', 'aaa')
					->call('save')
					->assertHasErrors([ 'user.email' => 'email' ])
			;
		}

		public function test_can_upload_avatar ()
		: void
		{
			$user = User::factory()->create();

			$file = UploadedFile::fake()->image('avatar.png');
			Storage::fake('avatars');
			Livewire::actingAs($user)
					->test(Profile::class)
					->set('upload', $file)
					->call('save')
			;

			$user->refresh();

			$this->assertNotNull($user->avatar);
			Storage::disk('avatars')->assertExists($user->avatar);
		}

		public function test_can_update_profile ()
		: void
		{
			$user = User::factory()->create();

			Livewire::actingAs($user)
					->test(Profile::class)
					->set('user.name', 'Foo')
					->set('user.email', 'bar@bar.com')
					->call('save')
			;

			$this->assertEquals('Foo', $user->name);
			$this->assertEquals('bar@bar.com', $user->email);
		}
	}
