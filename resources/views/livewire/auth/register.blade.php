<div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
	<div class="sm:mx-auto sm:w-full sm:max-w-md">
		<img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
		     alt="Workflow">
	</div>

	<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
		<div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
			<form class="space-y-6" wire:submit.prevent="register">
				<div>
					<label for="name" class="block text-sm font-medium text-gray-700"> Your name </label>
					<div class="mt-1 relative rounded-md shadow-sm">
						<input wire:model.lazy="name" type="text" id="name" name="name" placeholder="e.g. John Doe"
						       value="{{ old('name') }}"
						       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror">
						@error('name')
						<div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
							<svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
							     fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd"
								      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
								      clip-rule="evenodd"/>
							</svg>
						</div>
						@enderror
					</div>
					@error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
				</div>
				<div>
					<label for="email" class="block text-sm font-medium text-gray-700"> Email address </label>
					<div class="mt-1 relative rounded-md shadow-sm">
						<input wire:model="email" type="email" id="email" name="email"
						       placeholder="e.g. johndoe@gmail.com"
						       value="{{ old('email') }}" autocomplete="email" required
						       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror">
						@error('email')
						<div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
							<svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
							     fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd"
								      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
								      clip-rule="evenodd"/>
							</svg>
						</div>
						@enderror
					</div>
					@error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
				</div>

				<div>
					<label for="password" class="block text-sm font-medium text-gray-700"> Password </label>
					<div class="mt-1 relative rounded-md shadow-sm">
						<input wire:model.lazy="password" type="password" id="password"
						       name="password"
						       placeholder="e.g. Very Strong Password" autocomplete="current-password" required
						       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('password') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror">
						@error('password')
						<div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
							<svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
							     fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd"
								      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
								      clip-rule="evenodd"/>
							</svg>
						</div>
						@enderror
					</div>
					@error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
				</div>

				<div>
					<label for="passwordConfirmation" class="block text-sm font-medium text-gray-700"> Confirm
						Password </label>
					<div class="mt-1 relative rounded-md shadow-sm">
						<input wire:model.lazy="passwordConfirmation" type="password" id="passwordConfirmation"
						       name="passwordConfirmation"
						       placeholder="e.g. Very Strong Password" autocomplete="confirm-password" required
						       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('passwordConfirmation') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror">
						@error('passwordConfirmation')
						<div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
							<svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
							     fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd"
								      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
								      clip-rule="evenodd"/>
							</svg>
						</div>
						@enderror
					</div>
					@error('passwordConfirmation') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
				</div>

				<div>
					<button wire:click="register" type="submit"
					        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
						Register
					</button>
				</div>
			</form>

			<div class="mt-6">
				<p class="mt-2 text-center text-sm text-gray-600">
					<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> Already have an account? </a>
				</p>
			</div>
		</div>
	</div>
</div>
