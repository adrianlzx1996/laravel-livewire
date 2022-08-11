<!-- Mobile menu, show/hide based on menu state. -->
<div class="bg-gray-50 border-b border-gray-200 lg:hidden" id="mobile-menu">
	<div class="px-2 pt-2 pb-3 space-y-1" x-show="openMobile" x-transition>
		<!-- Current: "bg-gray-100", Default: "hover:bg-gray-100" -->
		<a href="{{ route('dashboard') }}"
		   class="{{ Route::is('dashboard') ? 'bg-gray-100' : 'hover:bg-gray-100' }} block px-3 py-2 rounded-md font-medium text-gray-900"
		   aria-current="page">Dashboard</a>

		<a href="#" class="hover:bg-gray-100 block px-3 py-2 rounded-md font-medium text-gray-900">Jobs</a>

		<a href="#"
		   class="hover:bg-gray-100 block px-3 py-2 rounded-md font-medium text-gray-900">Applicants</a>

		<a href="#" class="hover:bg-gray-100 block px-3 py-2 rounded-md font-medium text-gray-900">Company</a>
	</div>
	<div class="pt-4 pb-3 border-t border-gray-200">
		<div class="px-5 flex items-center">
			<div class="flex-shrink-0">
				<img class="rounded-full h-10 w-10"
				     src="{{ auth()->user()->avatarUrl() }}"
				     alt="Profile Photo">
			</div>
			<div class="ml-3">
				<div class="text-base font-medium text-gray-800">{{ ucwords(strtolower(auth()->user()->name)) }}</div>
				<div class="text-sm font-medium text-gray-500">{{ strtolower(auth()->user()->email) }}</div>
			</div>
			<button type="button"
			        class="ml-auto bg-gray-50 flex-shrink-0 rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-purple-500">
				<span class="sr-only">View notifications</span>
				<x-icons.notification/>
			</button>
		</div>
		<div class="mt-3 px-2 space-y-1">
			<a href="{{ route('profile') }}"
			   class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-100">Your
				Profile</a>

			<a href="#"
			   class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-100">Settings</a>

			<a href="#"
			   class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-100">Sign
				out</a>
		</div>
	</div>
</div>
