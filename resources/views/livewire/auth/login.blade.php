<div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
	<div class="sm:mx-auto sm:w-full sm:max-w-md">
		<x-icons.app class="mx-auto h-12 w-auto"/>
	</div>

	<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
		<div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
			<form class="space-y-6" wire:submit.prevent="login">
				<x-forms.input value="email" type="email" label="Email Address" placeholder="e.g. johndoe@gmail.com"
				               required/>
				<x-forms.input value="password" type="password" label="Password"
				               placeholder="e.g. Your Very Strong Password"
				               required/>

				<div class="flex items-center justify-between">
					<div class="flex items-center">
						<input id="remember-me" name="remember-me" type="checkbox"
						       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
						<label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
					</div>

					<div class="text-sm">
						<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> Forgot your
							password? </a>
					</div>
				</div>

				<div>
					<x-button wire:click="login">Sign In</x-button>
				</div>
			</form>

			<div class="mt-6">
				<p class="mt-2 text-center text-sm text-gray-600">
					<a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
						Don't have an account? </a>
				</p>
			</div>
		</div>
	</div>
</div>
