<div>
	<h3 class="text-lg leading-6 font-medium text-gray-900">Profile</h3>

	<form class="space-y-8 divide-y divide-gray-200" wire:submit.prevent="save">
		<div class="space-y-8 divide-gray-200 sm:space-y-5">

			<div>
				<div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

					<x-input.group label="Name" for="name" :error="$errors->first('name')">
						<x-input.text wire:model="name" name="name" id="name"/>
					</x-input.group>

					<x-input.group label="Birthday" for="birthday" :error="$errors->first('birthday')">
						<x-input.date wire:model="birthday" name="birthday" id="birthday"
						              placeholder="MM/DD/YYYY"/>
					</x-input.group>

					<x-input.group label="Email" for="email" :error="$errors->first('email')"
					               help-text="This is your login email">
						<x-input.text wire:model="email" id="email" name="email"/>
					</x-input.group>

					<x-input.group label="About" for="about" :error="$errors->first('about')"
					               help-text="Write a few sentences about yourself">
						<x-input.rich-text wire:model.lazy="about" id="about" :initial-value="$about"/>
					</x-input.group>

					<x-input.group label="Photo" for="newAvatar" :error="$errors->first('newAvatar')">
						<div class="flex items-center">
							<span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
								<img src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
							</span>


							<span class="ml-5 rounded-md shadow-sm">
								<input type="file" wire:model="newAvatar">
							</span>
							{{--							<button type="button"--}}
							{{--							        class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">--}}
							{{--								Change--}}
							{{--							</button>--}}
						</div>
					</x-input.group>

				</div>
			</div>
		</div>

		<div class="pt-5">
			<div class="flex justify-end items-center space-x-3">

				<span>
					<span
						x-cloak
						x-data="{ open: false }"
						x-show.transition.out.duration.1000ms="open"
						x-init="
							@this.on('notify-saved', () => {
								open = true;
								setTimeout(() => open = false, 2500)
							});
						"
						class="text-gray-400"
					>Saved!</span>
				</span>

				<button type="button"
				        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
					Cancel
				</button>

				<button type="submit"
				        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
					Save
				</button>
			</div>
		</div>
	</form>
</div>
