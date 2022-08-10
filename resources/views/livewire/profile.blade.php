<div>
	<h3 class="text-lg leading-6 font-medium text-gray-900">Profile</h3>

	<form class="space-y-8 divide-y divide-gray-200" wire:submit.prevent="save">
		<div class="space-y-8 divide-gray-200 sm:space-y-5">

			<div>
				<div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

					<x-input.group label="Name" for="name" :error="$errors->first('user.name')">
						<x-input.text wire:model="user.name" name="name" id="name"/>
					</x-input.group>

					<x-input.group label="Birthday" for="birthday" :error="$errors->first('user.birthday')">
						<x-input.date wire:model="user.birthday" name="birthday" id="birthday"
						              placeholder="MM/DD/YYYY"/>
					</x-input.group>

					<x-input.group label="Email" for="email" :error="$errors->first('user.email')"
					               help-text="This is your login email">
						<x-input.text wire:model="user.email" id="email" name="email"/>
					</x-input.group>

					<x-input.group label="About" for="about" :error="$errors->first('user.about')"
					               help-text="Write a few sentences about yourself">
						<x-input.rich-text wire:model.lazy="user.about" id="about" :initial-value="$user->about"/>
					</x-input.group>

					<x-input.group label="Photo" for="upload" :error="$errors->first('upload')">
						<div class="h-24 w-24 rounded-full overflow-hidden bg-gray-100">
							@if($upload)
								<img src="{{ $upload->temporaryUrl() }}" alt="Avatar"
								     class="h-full w-full object-cover"/>
							@else
								<img src="{{ auth()->user()->avatarUrl() }}" alt="Avatar"
								     class="h-full w-full object-cover"/>
							@endif
						</div>
						<x-input.filepond wire:model="upload"/>

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
