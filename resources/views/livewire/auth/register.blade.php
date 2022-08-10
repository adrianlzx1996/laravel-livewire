<div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
	<div class="sm:mx-auto sm:w-full sm:max-w-md">
		<img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
		     alt="Workflow">
	</div>

	<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
		<div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
			<form class="space-y-6" wire:submit.prevent="register">
				<x-forms.input value="name" label="Your Name" placeholder="e.g. John Doe"/>

				<x-forms.input value="email" type="email" label="Email Address" placeholder="e.g. johndoe@gmail.com"
				               required/>
				<x-forms.input value="password" type="password" label="Password" placeholder="e.g. Very Strong Password"
				               required/>

				<x-forms.input value="passwordConfirmation" type="password" label="Confirm
						Password"
				               placeholder="e.g. Very Strong Password"
				               required/>

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
